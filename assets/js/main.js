/* Health Expert — interactions & motion
   GSAP + ScrollTrigger + Lenis when available; graceful fallback without them. */
(function () {
  'use strict';

  var doc = document.documentElement;
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var finePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  var hasGsap = typeof window.gsap !== 'undefined' && typeof window.ScrollTrigger !== 'undefined';
  var $ = function (s, c) { return (c || document).querySelector(s); };
  var $$ = function (s, c) { return Array.prototype.slice.call((c || document).querySelectorAll(s)); };

  if (reduced) doc.classList.add('reduced');
  if (!hasGsap) doc.classList.add('no-gsap');
  if (hasGsap) gsap.registerPlugin(ScrollTrigger);

  var store = {
    get: function (k) { try { return window.localStorage.getItem(k); } catch (e) { return null; } },
    set: function (k, v) { try { window.localStorage.setItem(k, v); } catch (e) {} },
    sget: function (k) { try { return window.sessionStorage.getItem(k); } catch (e) { return null; } },
    sset: function (k, v) { try { window.sessionStorage.setItem(k, v); } catch (e) {} }
  };

  /* ------------------------------------------------------------------ */
  /* Smooth scroll                                                        */
  /* ------------------------------------------------------------------ */
  var lenis = null;
  if (!reduced && typeof window.Lenis !== 'undefined') {
    lenis = new Lenis({ lerp: 0.1, wheelMultiplier: 1, smoothWheel: true });
    if (hasGsap) {
      lenis.on('scroll', ScrollTrigger.update);
      gsap.ticker.add(function (time) { lenis.raf(time * 1000); });
      gsap.ticker.lagSmoothing(0);
    } else {
      var raf = function (time) { lenis.raf(time); requestAnimationFrame(raf); };
      requestAnimationFrame(raf);
    }
  }
  function scrollToEl(el) {
    if (lenis) lenis.scrollTo(el, { offset: -90, duration: 1.4 });
    else el.scrollIntoView({ behavior: reduced ? 'auto' : 'smooth', block: 'start' });
  }

  // Same-page anchors
  $$('a[href*="#"]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      var url = new URL(a.href, location.href);
      if (url.pathname !== location.pathname || !url.hash || url.hash === '#') return;
      var target = document.getElementById(url.hash.slice(1));
      if (!target) return;
      e.preventDefault();
      closeMenu();
      scrollToEl(target);
      history.replaceState(null, '', url.hash);
    });
  });

  /* ------------------------------------------------------------------ */
  /* Loader + page transitions                                            */
  /* ------------------------------------------------------------------ */
  var loader = $('.loader');
  var firstVisit = !store.sget('he-visited');
  var fromTransition = store.sget('he-trans') === '1';
  store.sset('he-visited', '1');
  store.sset('he-trans', '0');

  function hideLoader() {
    doc.classList.remove('is-loading');
    if (loader) { loader.classList.remove('is-on'); loader.removeAttribute('style'); }
  }

  function playIntro(done) {
    if (!loader || !hasGsap || reduced) { hideLoader(); done(); return; }
    loader.classList.add('is-on');
    doc.classList.remove('is-loading');
    var tl = gsap.timeline({ onComplete: function () { hideLoader(); done(); } });
    tl.from('.loader__mark rect', { scaleY: 0, transformOrigin: '50% 100%', duration: .55, stagger: .07, ease: 'power3.out' })
      .to('.loader__bar i', { scaleX: 1, duration: .7, ease: 'power2.inOut' }, '-=.3')
      .to(loader, { clipPath: 'inset(0 0 100% 0)', duration: .8, ease: 'power4.inOut' }, '+=.1');
    setTimeout(function () { if (tl.progress() < 1) tl.progress(1); }, 4500);
  }

  function playEnter(done) {
    if (!loader || !hasGsap || reduced) { hideLoader(); done(); return; }
    loader.classList.add('is-on');
    doc.classList.remove('is-loading');
    gsap.set('.loader__bar i', { scaleX: 1 });
    gsap.fromTo(loader, { clipPath: 'inset(0 0 0% 0)' }, { clipPath: 'inset(0 0 100% 0)', duration: .7, ease: 'power4.inOut', delay: .05, onComplete: function () { hideLoader(); } });
    setTimeout(done, 250);
  }

  function leaveTo(href) {
    if (!loader || !hasGsap || reduced) { location.href = href; return; }
    store.sset('he-trans', '1');
    loader.classList.add('is-on');
    gsap.fromTo(loader, { clipPath: 'inset(100% 0 0 0)' }, {
      clipPath: 'inset(0% 0 0 0)', duration: .55, ease: 'power3.inOut',
      onComplete: function () { location.href = href; }
    });
  }

  $$('a[href]').forEach(function (a) {
    a.addEventListener('click', function (e) {
      if (e.defaultPrevented || e.metaKey || e.ctrlKey || e.shiftKey || e.button !== 0) return;
      if (a.target === '_blank' || a.hasAttribute('download')) return;
      var url = new URL(a.href, location.href);
      if (url.origin !== location.origin) return;
      if (url.pathname === location.pathname && url.search === location.search) return;
      if (!/\.php$|\/$/.test(url.pathname)) return;
      e.preventDefault();
      leaveTo(url.href);
    });
  });
  window.addEventListener('pageshow', function (e) {
    if (e.persisted && loader) { loader.classList.remove('is-on'); loader.removeAttribute('style'); }
  });

  /* ------------------------------------------------------------------ */
  /* Navigation                                                           */
  /* ------------------------------------------------------------------ */
  var nav = $('[data-nav]');
  var lastY = 0;
  function onScroll() {
    var y = window.scrollY;
    if (nav) {
      nav.classList.toggle('is-scrolled', y > 30);
      var hide = y > 400 && y > lastY + 4 && !document.body.classList.contains('menu-open');
      if (hide) nav.classList.add('is-hidden');
      else if (y < lastY - 4 || y < 400) nav.classList.remove('is-hidden');
    }
    lastY = y;
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  if (lenis) lenis.on('scroll', onScroll);
  onScroll();

  var megaToggle = $('[data-mega-toggle]');
  if (megaToggle) {
    var megaItem = megaToggle.parentElement;
    megaToggle.addEventListener('click', function () {
      var open = megaItem.classList.toggle('is-open');
      megaToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    document.addEventListener('click', function (e) {
      if (!megaItem.contains(e.target)) { megaItem.classList.remove('is-open'); megaToggle.setAttribute('aria-expanded', 'false'); }
    });
  }

  var burger = $('[data-burger]');
  var drawer = $('[data-drawer]');
  function closeMenu() {
    if (!document.body.classList.contains('menu-open')) return;
    document.body.classList.remove('menu-open');
    if (burger) burger.setAttribute('aria-expanded', 'false');
    if (drawer) drawer.setAttribute('aria-hidden', 'true');
    if (lenis) lenis.start();
  }
  if (burger && drawer) {
    burger.addEventListener('click', function () {
      var open = !document.body.classList.contains('menu-open');
      if (!open) { closeMenu(); return; }
      document.body.classList.add('menu-open');
      burger.setAttribute('aria-expanded', 'true');
      drawer.setAttribute('aria-hidden', 'false');
      if (lenis) lenis.stop();
      if (hasGsap && !reduced) {
        gsap.fromTo($$('.drawer__countries a, .drawer__links a, .drawer__foot .btn', drawer),
          { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: .6, stagger: .035, ease: 'power3.out', delay: .25 });
      }
    });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeMenu(); });
  }

  /* ------------------------------------------------------------------ */
  /* Text splitting                                                       */
  /* ------------------------------------------------------------------ */
  function splitWords(el) {
    var frag = document.createDocumentFragment();
    function walk(node, parent) {
      Array.prototype.slice.call(node.childNodes).forEach(function (child) {
        if (child.nodeType === 3) {
          child.textContent.split(/(\s+)/).forEach(function (part) {
            if (!part) return;
            if (/^\s+$/.test(part)) { parent.appendChild(document.createTextNode(' ')); return; }
            var line = document.createElement('span'); line.className = 'split-line';
            line.style.display = 'inline-block';
            var w = document.createElement('span'); w.className = 'split-word'; w.textContent = part;
            line.appendChild(w); parent.appendChild(line);
          });
        } else if (child.nodeName === 'BR') {
          parent.appendChild(document.createElement('br'));
        } else if (child.nodeType === 1) {
          var clone = child.cloneNode(false);
          walk(child, clone);
          parent.appendChild(clone);
        }
      });
    }
    walk(el, frag);
    el.innerHTML = '';
    el.appendChild(frag);
    el.classList.add('is-split');
    return $$('.split-word', el);
  }

  $$('[data-split]').forEach(function (el) {
    if (!hasGsap || reduced) { el.classList.add('is-split'); return; }
    var words = splitWords(el);
    var inHero = !!el.closest('.hero, .phero');
    gsap.set(words, { yPercent: 115 });
    var play = function () {
      gsap.to(words, { yPercent: 0, duration: 1.1, ease: 'power4.out', stagger: 0.045, delay: inHero ? 0.15 : 0 });
    };
    if (inHero) el._play = play;
    else ScrollTrigger.create({ trigger: el, start: 'top 88%', once: true, onEnter: play });
  });

  /* ------------------------------------------------------------------ */
  /* Reveal on scroll                                                     */
  /* ------------------------------------------------------------------ */
  var revealEls = $$('[data-reveal]');
  if (reduced || !('IntersectionObserver' in window)) {
    revealEls.forEach(function (el) { el.classList.add('is-revealed'); });
  } else {
    var queue = [], timer = null;
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (!en.isIntersecting) return;
        io.unobserve(en.target);
        queue.push(en.target);
      });
      if (!timer) timer = setTimeout(function flush() {
        queue.forEach(function (el, i) { el.style.transitionDelay = (i * 0.08) + 's'; el.classList.add('is-revealed'); });
        queue = []; timer = null;
      }, 30);
    }, { rootMargin: '0px 0px -8% 0px' });
    revealEls.forEach(function (el) {
      if (el.closest('.hero, .phero')) return; // heroes handled by intro timeline
      io.observe(el);
    });
  }

  /* ------------------------------------------------------------------ */
  /* Hero intro                                                           */
  /* ------------------------------------------------------------------ */
  function heroIn() {
    var hero = $('.hero') || $('.phero') || $('.notfound');
    if (!hero) return;
    $$('[data-split]', hero).forEach(function (el) { if (el._play) el._play(); });
    // Failsafe: if the animation ticker is throttled (background tab, slow device),
    // jump every intro tween to its end state so content is never left hidden.
    if (hasGsap && !reduced) setTimeout(function () {
      gsap.getTweensOf($$('.split-word, [data-reveal], .hero__globe, .chip-card', hero)).forEach(function (t) { if (t.progress() < 1) t.progress(1); });
    }, 4000);
    var bits = $$('[data-reveal]', hero);
    if (!hasGsap || reduced) { bits.forEach(function (el) { el.classList.add('is-revealed'); }); return; }
    gsap.fromTo(bits, { y: 28, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: 'power3.out', stagger: .09, delay: .35,
      onComplete: function () { bits.forEach(function (el) { el.classList.add('is-revealed'); el.style.transform = ''; }); } });
    var globe = $('.hero__globe');
    if (globe) gsap.fromTo(globe, { opacity: 0, scale: .85 }, { opacity: 1, scale: 1, duration: 2, ease: 'power3.out' });
    var chips = $$('.chip-card');
    if (chips.length) gsap.fromTo(chips, { y: 30, opacity: 0 }, { y: 0, opacity: 1, duration: 1, ease: 'power3.out', stagger: .15, delay: .9 });
  }

  /* ------------------------------------------------------------------ */
  /* Scroll-driven effects (GSAP)                                         */
  /* ------------------------------------------------------------------ */
  function scrollFx() {
    if (!hasGsap || reduced) return;

    var hero = $('.hero');
    if (hero) {
      gsap.to('.hero__globe', { yPercent: -10, scale: 1.08, ease: 'none', scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true } });
      gsap.to('.hero__copy', { y: -80, opacity: 0.2, ease: 'none', scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true } });
      $$('.chip-card').forEach(function (c, i) {
        gsap.to(c, { y: -60 - i * 40, ease: 'none', scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true } });
      });
    }

    // Statement: words light up as you scroll
    $$('[data-words]').forEach(function (el) {
      var words = [];
      (function wrap(node) {
        Array.prototype.slice.call(node.childNodes).forEach(function (child) {
          if (child.nodeType === 3) {
            var f = document.createDocumentFragment();
            child.textContent.split(/(\s+)/).forEach(function (part) {
              if (!part) return;
              if (/^\s+$/.test(part)) { f.appendChild(document.createTextNode(part)); return; }
              var s = document.createElement('span'); s.className = 'w'; s.textContent = part; f.appendChild(s); words.push(s);
            });
            child.parentNode.replaceChild(f, child);
          } else if (child.nodeType === 1) wrap(child);
        });
      })(el);
      ScrollTrigger.create({
        trigger: el, start: 'top 80%', end: 'bottom 45%', scrub: true,
        onUpdate: function (self) {
          var n = Math.round(self.progress * words.length);
          for (var i = 0; i < words.length; i++) words[i].classList.toggle('is-on', i < n);
        }
      });
    });

    // Stacking journey cards
    var cards = $$('.jcard');
    cards.forEach(function (card, i) {
      var next = cards[i + 1];
      if (!next) return;
      gsap.to(card, {
        scale: 0.94, ease: 'none',
        scrollTrigger: { trigger: next, start: 'top bottom-=80', end: 'top top+=160', scrub: true }
      });
    });

    // Generic parallax
    $$('[data-parallax]').forEach(function (el) {
      var amt = parseFloat(el.getAttribute('data-parallax')) || 60;
      gsap.fromTo(el, { y: amt }, { y: -amt, ease: 'none', scrollTrigger: { trigger: el, start: 'top bottom', end: 'bottom top', scrub: true } });
    });

    // Footer giant word
    var word = $('.footer__word');
    if (word) gsap.fromTo(word, { yPercent: 40, opacity: 0 }, { yPercent: 0, opacity: 1, ease: 'none', scrollTrigger: { trigger: word, start: 'top bottom', end: 'bottom bottom', scrub: true } });
  }

  /* ------------------------------------------------------------------ */
  /* Counters                                                             */
  /* ------------------------------------------------------------------ */
  function fmt(n) { return Math.round(n).toLocaleString('en-US'); }
  $$('[data-counter]').forEach(function (el) {
    var to = parseFloat(el.getAttribute('data-counter')) || 0;
    if (reduced || !('IntersectionObserver' in window)) { el.textContent = fmt(to); return; }
    el.textContent = '0';
    var o = new IntersectionObserver(function (en) {
      if (!en[0].isIntersecting) return;
      o.disconnect();
      var start = performance.now(), dur = 1800;
      (function tick(now) {
        var p = Math.min(1, (now - start) / dur), e = 1 - Math.pow(1 - p, 4);
        el.textContent = fmt(to * e);
        if (p < 1) requestAnimationFrame(tick);
      })(start);
    }, { threshold: .5 });
    o.observe(el);
  });

  /* ------------------------------------------------------------------ */
  /* Pointer effects: magnetic, glow, spotlight, tilt, cursor             */
  /* ------------------------------------------------------------------ */
  if (finePointer && !reduced) {
    $$('[data-magnetic]').forEach(function (el) {
      el.addEventListener('pointermove', function (e) {
        var r = el.getBoundingClientRect();
        var x = e.clientX - r.left - r.width / 2, y = e.clientY - r.top - r.height / 2;
        el.style.transform = 'translate(' + x * 0.18 + 'px,' + y * 0.28 + 'px)';
      });
      el.addEventListener('pointerleave', function () {
        el.style.transition = 'transform .6s cubic-bezier(.22,1,.36,1)';
        el.style.transform = '';
        setTimeout(function () { el.style.transition = ''; }, 600);
      });
    });

    document.addEventListener('pointermove', function (e) {
      var t = e.target.closest && e.target.closest('.btn, .svc');
      if (!t) return;
      var r = t.getBoundingClientRect();
      t.style.setProperty('--mx', (e.clientX - r.left) + 'px');
      t.style.setProperty('--my', (e.clientY - r.top) + 'px');
    }, { passive: true });

    $$('[data-tilt]').forEach(function (el) {
      el.addEventListener('pointermove', function (e) {
        var r = el.getBoundingClientRect();
        var px = (e.clientX - r.left) / r.width - 0.5, py = (e.clientY - r.top) / r.height - 0.5;
        el.style.transform = 'perspective(900px) rotateY(' + px * 6 + 'deg) rotateX(' + (-py * 6) + 'deg) translateY(-4px)';
      });
      el.addEventListener('pointerleave', function () { el.style.transform = ''; });
    });

    var cursor = $('.cursor');
    if (cursor) {
      document.body.classList.add('has-cursor');
      var cx = -100, cy = -100, tx = -100, ty = -100;
      document.addEventListener('pointermove', function (e) { tx = e.clientX; ty = e.clientY; }, { passive: true });
      (function loop() {
        cx += (tx - cx) * 0.22; cy += (ty - cy) * 0.22;
        cursor.style.transform = 'translate(' + cx + 'px,' + cy + 'px)';
        requestAnimationFrame(loop);
      })();
      document.addEventListener('pointerover', function (e) {
        cursor.classList.toggle('is-hover', !!(e.target.closest && e.target.closest('a, button, summary, label, [data-tilt]')));
      });
    }
  }

  /* ------------------------------------------------------------------ */
  /* Tabs (destinations, visa)                                            */
  /* ------------------------------------------------------------------ */
  $$('[data-tabs]').forEach(function (root) {
    var tabs = $$('[role="tab"]', root);
    function select(tab, focus) {
      tabs.forEach(function (t) {
        var on = t === tab;
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.tabIndex = on ? 0 : -1;
        t.classList.toggle('is-active', on);
        var panel = document.getElementById(t.getAttribute('aria-controls'));
        if (!panel) return;
        panel.hidden = !on;
        if (on && hasGsap && !reduced) {
          gsap.fromTo(panel, { opacity: 0, y: 24 }, { opacity: 1, y: 0, duration: .6, ease: 'power3.out' });
          gsap.fromTo($$('[data-stagger] > *', panel), { opacity: 0, y: 16 }, { opacity: 1, y: 0, duration: .6, stagger: .05, ease: 'power3.out', delay: .1 });
          var route = $('.dest__route path', panel);
          if (route) {
            var len = route.getTotalLength();
            gsap.fromTo(route, { strokeDashoffset: len, strokeDasharray: '4 6' }, { strokeDashoffset: 0, duration: 1.4, ease: 'power2.out' });
          }
        }
      });
      if (focus) tab.focus();
      if (hasGsap) ScrollTrigger.refresh();
    }
    tabs.forEach(function (t, i) {
      t.addEventListener('click', function () { select(t); });
      t.addEventListener('keydown', function (e) {
        var k = e.key, n = null;
        if (k === 'ArrowDown' || k === 'ArrowRight') n = tabs[(i + 1) % tabs.length];
        if (k === 'ArrowUp' || k === 'ArrowLeft') n = tabs[(i - 1 + tabs.length) % tabs.length];
        if (n) { e.preventDefault(); select(n, true); }
      });
    });
  });

  /* ------------------------------------------------------------------ */
  /* Draggable rail                                                       */
  /* ------------------------------------------------------------------ */
  $$('[data-rail]').forEach(function (rail) {
    var down = false, startX = 0, startScroll = 0, moved = false;
    rail.addEventListener('pointerdown', function (e) {
      if (e.pointerType !== 'mouse') return;
      down = true; moved = false; startX = e.clientX; startScroll = rail.scrollLeft;
    });
    window.addEventListener('pointermove', function (e) {
      if (!down) return;
      var dx = e.clientX - startX;
      if (Math.abs(dx) > 5) { moved = true; rail.classList.add('is-dragging'); }
      rail.scrollLeft = startScroll - dx;
    });
    window.addEventListener('pointerup', function () {
      if (!down) return;
      down = false;
      setTimeout(function () { rail.classList.remove('is-dragging'); }, 0);
    });
    rail.addEventListener('click', function (e) { if (moved) { e.preventDefault(); e.stopPropagation(); } }, true);

    var wrap = rail.closest('section') || document;
    var step = function () { var c = rail.querySelector('.doc'); return c ? c.getBoundingClientRect().width + 20 : 320; };
    var prev = $('[data-rail-prev]', wrap), next = $('[data-rail-next]', wrap);
    if (prev) prev.addEventListener('click', function () { rail.scrollBy({ left: -step(), behavior: 'smooth' }); });
    if (next) next.addEventListener('click', function () { rail.scrollBy({ left: step(), behavior: 'smooth' }); });
  });

  /* ------------------------------------------------------------------ */
  /* Filter + search (hospitals, doctors)                                 */
  /* ------------------------------------------------------------------ */
  $$('[data-filterable]').forEach(function (root) {
    var chips = $$('[data-filter]', root);
    var items = $$('[data-country]', root);
    var search = $('[data-search-input]', root);
    var empty = $('.empty-note', root);
    var current = 'all';
    function apply() {
      var q = search ? search.value.trim().toLowerCase() : '';
      var shown = 0;
      items.forEach(function (it) {
        var ok = (current === 'all' || it.getAttribute('data-country') === current) &&
                 (!q || (it.getAttribute('data-search') || it.textContent.toLowerCase()).indexOf(q) !== -1);
        it.classList.toggle('is-filtered-out', !ok);
        if (ok) shown++;
      });
      if (empty) empty.classList.toggle('is-on', shown === 0);
      if (hasGsap && !reduced) {
        gsap.fromTo(items.filter(function (i) { return !i.classList.contains('is-filtered-out'); }),
          { opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: .5, stagger: .03, ease: 'power3.out', overwrite: true });
        ScrollTrigger.refresh();
      }
    }
    chips.forEach(function (c) {
      c.addEventListener('click', function () {
        current = c.getAttribute('data-filter');
        chips.forEach(function (x) { x.classList.toggle('is-active', x === c); x.setAttribute('aria-pressed', x === c ? 'true' : 'false'); });
        apply();
      });
    });
    if (search) search.addEventListener('input', apply);
    var pre = new URLSearchParams(location.search).get('country');
    if (pre) { var chip = chips.filter(function (c) { return c.getAttribute('data-filter') === pre; })[0]; if (chip) chip.click(); }
  });

  /* ------------------------------------------------------------------ */
  /* Lead form                                                            */
  /* ------------------------------------------------------------------ */
  var toastEl = $('[data-toast]'), toastTimer;
  function toast(msg) {
    if (!toastEl) return;
    toastEl.textContent = msg;
    toastEl.classList.add('is-on');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(function () { toastEl.classList.remove('is-on'); }, 4200);
  }

  $$('[data-lead-form]').forEach(function (form) {
    var drop = $('[data-drop]', form);
    var list = $('[data-drop-list]', form);
    if (drop) {
      var input = $('input[type="file"]', drop);
      ['dragenter', 'dragover'].forEach(function (ev) { drop.addEventListener(ev, function () { drop.classList.add('is-over'); }); });
      ['dragleave', 'drop'].forEach(function (ev) { drop.addEventListener(ev, function () { drop.classList.remove('is-over'); }); });
      input.addEventListener('change', function () {
        list.innerHTML = '';
        Array.prototype.slice.call(input.files).forEach(function (f) {
          var s = document.createElement('span');
          var big = f.size > 10 * 1024 * 1024;
          s.textContent = (big ? '⚠ ' : '') + f.name + ' · ' + Math.max(1, Math.round(f.size / 1024)) + ' KB';
          if (big) s.style.color = '#c2334d';
          list.appendChild(s);
        });
      });
    }

    function validate() {
      var ok = true, first = null;
      $$('.field', form).forEach(function (f) {
        var el = $('input, textarea', f);
        if (!el) return;
        var v = el.value.trim(), bad = false;
        if (el.required && !v) bad = true;
        if (!bad && v && el.type === 'email') bad = !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
        if (!bad && v && el.type === 'tel') bad = !/^0?1[3-9]\d{8}$/.test(v.replace(/[\s-]/g, ''));
        f.classList.toggle('is-invalid', bad);
        if (bad) { ok = false; first = first || el; }
      });
      var consent = $('input[name="consent"]', form);
      if (consent) {
        consent.closest('.check').classList.toggle('is-invalid', !consent.checked);
        if (!consent.checked) { ok = false; first = first || consent; }
      }
      if (first) first.focus({ preventScroll: false });
      return ok;
    }

    $$('input, textarea', form).forEach(function (el) {
      el.addEventListener('input', function () { var f = el.closest('.field'); if (f) f.classList.remove('is-invalid'); });
    });

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!validate()) { toast('Please check the highlighted fields.'); return; }
      var btn = $('button[type="submit"]', form);
      btn.classList.add('is-loading'); btn.disabled = true;

      // FRONTEND PREVIEW: the backend (submit.php) is not connected yet.
      setTimeout(function () {
        var fields = $('.form__fields', form), ok = $('.form__success', form);
        if (hasGsap && !reduced) {
          gsap.to(fields, { opacity: 0, y: -10, duration: .3, onComplete: function () { fields.hidden = true; ok.hidden = false; gsap.from(ok, { opacity: 0, y: 20, duration: .6, ease: 'power3.out' }); } });
        } else { fields.hidden = true; ok.hidden = false; }
        toast('Preview mode — the form will send once the backend is connected.');
      }, 900);
    });
  });

  /* ------------------------------------------------------------------ */
  /* Visa checklist progress (remembered per browser)                     */
  /* ------------------------------------------------------------------ */
  $$('[data-checklist]').forEach(function (root) {
    var key = 'he-checklist-' + root.getAttribute('data-checklist');
    var boxes = $$('input[type="checkbox"]', root);
    var saved = [];
    try { saved = JSON.parse(store.get(key) || '[]'); } catch (e) { saved = []; }
    boxes.forEach(function (b, i) { b.checked = saved.indexOf(i) !== -1; });
    var num = $('[data-progress-num]', root), bar = $('[data-progress-bar]', root);
    function update() {
      var done = [];
      boxes.forEach(function (b, i) { if (b.checked) done.push(i); });
      var pct = boxes.length ? Math.round(done.length / boxes.length * 100) : 0;
      if (num) num.textContent = done.length + '/' + boxes.length;
      if (bar) bar.style.width = pct + '%';
      store.set(key, JSON.stringify(done));
    }
    boxes.forEach(function (b) { b.addEventListener('change', update); });
    update();
  });

  /* ------------------------------------------------------------------ */
  /* Table of contents highlight                                          */
  /* ------------------------------------------------------------------ */
  var tocLinks = $$('.toc a');
  if (tocLinks.length && 'IntersectionObserver' in window) {
    var map = {};
    tocLinks.forEach(function (a) { map[a.getAttribute('href').slice(1)] = a; });
    var tio = new IntersectionObserver(function (en) {
      en.forEach(function (x) {
        if (x.isIntersecting) { tocLinks.forEach(function (a) { a.classList.remove('is-active'); }); var a = map[x.target.id]; if (a) a.classList.add('is-active'); }
      });
    }, { rootMargin: '-20% 0px -70% 0px' });
    Object.keys(map).forEach(function (id) { var h = document.getElementById(id); if (h) tio.observe(h); });
  }

  /* ------------------------------------------------------------------ */
  /* Boot                                                                 */
  /* ------------------------------------------------------------------ */
  function start() { heroIn(); scrollFx(); if (hasGsap) ScrollTrigger.refresh(); }
  var fontsReady = document.fonts && document.fonts.ready ? document.fonts.ready : Promise.resolve();
  if (firstVisit) playIntro(function () { fontsReady.then(start); });
  else if (fromTransition) playEnter(function () { fontsReady.then(start); });
  else { hideLoader(); fontsReady.then(start); }
})();
