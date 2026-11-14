/* Health Expert — dotted globe with animated routes from Dhaka.
   Pure canvas, no dependencies. Usage: <canvas data-globe></canvas> */
(function () {
  'use strict';

  var DEG = Math.PI / 180;
  var HOME = { name: 'DHAKA', lat: 23.81, lon: 90.41 };
  var CITIES = [
    { name: 'NEW DELHI', lat: 28.61, lon: 77.21 },
    { name: 'CHENNAI', lat: 13.08, lon: 80.27 },
    { name: 'BANGKOK', lat: 13.76, lon: 100.5 },
    { name: 'KUALA LUMPUR', lat: 3.14, lon: 101.69 },
    { name: 'SINGAPORE', lat: 1.35, lon: 103.82 },
    { name: 'BEIJING', lat: 39.9, lon: 116.4 },
    { name: 'ISTANBUL', lat: 41.01, lon: 28.98 }
  ];

  function vec(lat, lon) {
    var p = lat * DEG, l = lon * DEG;
    return [Math.cos(p) * Math.cos(l), Math.cos(p) * Math.sin(l), Math.sin(p)];
  }

  function slerp(a, b, t) {
    var dot = Math.min(1, Math.max(-1, a[0] * b[0] + a[1] * b[1] + a[2] * b[2]));
    var om = Math.acos(dot), s = Math.sin(om);
    if (s < 1e-6) return a.slice();
    var k1 = Math.sin((1 - t) * om) / s, k2 = Math.sin(t * om) / s;
    return [a[0] * k1 + b[0] * k2, a[1] * k1 + b[1] * k2, a[2] * k1 + b[2] * k2];
  }

  function Globe(canvas) {
    this.c = canvas;
    this.ctx = canvas.getContext('2d');
    this.reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    this.lon0 = 82; this.lat0 = 20;
    this.targetLon = 82; this.mouseX = 0; this.mouseY = 0;
    this.t0 = performance.now();
    this.visible = true;

    // Fibonacci sphere of dots
    var n = 1600, pts = [];
    var golden = Math.PI * (3 - Math.sqrt(5));
    for (var i = 0; i < n; i++) {
      var y = 1 - (i / (n - 1)) * 2, r = Math.sqrt(1 - y * y), th = golden * i;
      pts.push([Math.cos(th) * r, Math.sin(th) * r, y]);
    }
    this.dots = pts;
    this.home = vec(HOME.lat, HOME.lon);
    this.routes = CITIES.map(function (c, i) {
      var v = vec(c.lat, c.lon), path = [];
      for (var s = 0; s <= 48; s++) {
        var t = s / 48, p = slerp(this.home, v, t), h = 1 + Math.sin(Math.PI * t) * 0.16;
        path.push([p[0] * h, p[1] * h, p[2] * h]);
      }
      return { city: c, v: v, path: path, offset: i * 0.37 };
    }, this);

    this.resize = this.resize.bind(this);
    this.frame = this.frame.bind(this);
    window.addEventListener('resize', this.resize);
    this.resize();

    var self = this;
    window.addEventListener('pointermove', function (e) {
      self.mouseX = (e.clientX / window.innerWidth - 0.5);
      self.mouseY = (e.clientY / window.innerHeight - 0.5);
    }, { passive: true });

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        self.visible = entries[0].isIntersecting;
        if (self.visible && !self.reduced) requestAnimationFrame(self.frame);
      }).observe(canvas);
    }
    requestAnimationFrame(this.frame);
  }

  Globe.prototype.resize = function () {
    var dpr = Math.min(window.devicePixelRatio || 1, 2);
    // clientWidth ignores CSS transforms (the intro animation scales the canvas)
    var r = { width: this.c.clientWidth || 600, height: this.c.clientHeight || 600 };
    this.w = r.width; this.h = r.height;
    this.c.width = Math.round(r.width * dpr);
    this.c.height = Math.round(r.height * dpr);
    this.ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    this.R = Math.min(r.width, r.height) * 0.42;
    if (this.reduced) this.draw(0);
  };

  // Rotate a world vector into view space → [depth, screenX, screenY]
  Globe.prototype.project = function (v) {
    var l = this.lon0 * DEG, p = this.lat0 * DEG;
    var x1 = v[0] * Math.cos(l) + v[1] * Math.sin(l);
    var y1 = -v[0] * Math.sin(l) + v[1] * Math.cos(l);
    var z1 = v[2];
    var x2 = x1 * Math.cos(p) + z1 * Math.sin(p);
    var z2 = -x1 * Math.sin(p) + z1 * Math.cos(p);
    return [x2, this.w / 2 + y1 * this.R, this.h / 2 - z2 * this.R];
  };

  Globe.prototype.frame = function (now) {
    if (!this.visible && !this.reduced) return;
    var t = (now - this.t0) / 1000;
    this.targetLon = 82 + Math.sin(t * 0.12) * 14 + this.mouseX * 18;
    this.lon0 += (this.targetLon - this.lon0) * 0.04;
    this.lat0 += ((20 - this.mouseY * 10) - this.lat0) * 0.04;
    this.draw(t);
    if (!this.reduced) requestAnimationFrame(this.frame);
  };

  Globe.prototype.draw = function (t) {
    var ctx = this.ctx, R = this.R, cx = this.w / 2, cy = this.h / 2;
    ctx.clearRect(0, 0, this.w, this.h);

    // Atmosphere
    var g = ctx.createRadialGradient(cx, cy, R * 0.85, cx, cy, R * 1.35);
    g.addColorStop(0, 'rgba(25,246,197,0.10)');
    g.addColorStop(1, 'rgba(25,246,197,0)');
    ctx.fillStyle = g;
    ctx.beginPath(); ctx.arc(cx, cy, R * 1.35, 0, Math.PI * 2); ctx.fill();

    // Sphere body
    var body = ctx.createRadialGradient(cx - R * 0.35, cy - R * 0.4, R * 0.1, cx, cy, R);
    body.addColorStop(0, 'rgba(30,80,150,0.55)');
    body.addColorStop(1, 'rgba(6,28,63,0.2)');
    ctx.fillStyle = body;
    ctx.beginPath(); ctx.arc(cx, cy, R, 0, Math.PI * 2); ctx.fill();
    ctx.strokeStyle = 'rgba(25,246,197,0.18)'; ctx.lineWidth = 1; ctx.stroke();

    // Dots
    for (var i = 0; i < this.dots.length; i++) {
      var p = this.project(this.dots[i]);
      if (p[0] <= 0) continue;
      var a = 0.14 + p[0] * 0.6;
      ctx.fillStyle = 'rgba(170,210,255,' + a.toFixed(3) + ')';
      var s = 0.9 + p[0] * 1.4;
      ctx.fillRect(p[1] - s / 2, p[2] - s / 2, s, s);
    }

    // Routes
    var home = this.project(this.home);
    for (var r = 0; r < this.routes.length; r++) {
      var route = this.routes[r];
      ctx.beginPath();
      var started = false;
      for (var k = 0; k < route.path.length; k++) {
        var q = this.project(route.path[k]);
        if (q[0] < -0.15) { started = false; continue; }
        if (!started) { ctx.moveTo(q[1], q[2]); started = true; } else ctx.lineTo(q[1], q[2]);
      }
      ctx.strokeStyle = 'rgba(25,246,197,0.45)';
      ctx.lineWidth = 1.2;
      ctx.setLineDash([3, 5]);
      ctx.stroke();
      ctx.setLineDash([]);

      // Travelling pulse
      var prog = ((t * 0.22 + route.offset) % 1);
      var idx = Math.floor(prog * (route.path.length - 1));
      var tp = this.project(route.path[idx]);
      if (tp[0] > -0.1) {
        var glow = ctx.createRadialGradient(tp[1], tp[2], 0, tp[1], tp[2], 10);
        glow.addColorStop(0, 'rgba(25,246,197,0.9)');
        glow.addColorStop(1, 'rgba(25,246,197,0)');
        ctx.fillStyle = glow;
        ctx.beginPath(); ctx.arc(tp[1], tp[2], 10, 0, Math.PI * 2); ctx.fill();
      }

      // City marker + label
      var cp = this.project(route.v);
      if (cp[0] > 0.05) {
        ctx.fillStyle = 'rgba(255,255,255,0.95)';
        ctx.beginPath(); ctx.arc(cp[1], cp[2], 3, 0, Math.PI * 2); ctx.fill();
        ctx.strokeStyle = 'rgba(25,246,197,0.6)';
        ctx.beginPath(); ctx.arc(cp[1], cp[2], 6 + Math.sin(t * 2 + r) * 1.5, 0, Math.PI * 2); ctx.stroke();
        ctx.font = '600 10px Archivo, sans-serif';
        ctx.fillStyle = 'rgba(255,255,255,' + (0.35 + cp[0] * 0.5).toFixed(2) + ')';
        ctx.fillText(route.city.name, cp[1] + 10, cp[2] + 3.5);
      }
    }

    // Home marker (Dhaka)
    if (home[0] > 0) {
      var pulse = (t * 0.8) % 1;
      ctx.strokeStyle = 'rgba(25,246,197,' + (1 - pulse).toFixed(2) + ')';
      ctx.lineWidth = 1.5;
      ctx.beginPath(); ctx.arc(home[1], home[2], 6 + pulse * 22, 0, Math.PI * 2); ctx.stroke();
      ctx.fillStyle = '#19F6C5';
      ctx.beginPath(); ctx.arc(home[1], home[2], 5, 0, Math.PI * 2); ctx.fill();
      ctx.font = '700 11px Archivo, sans-serif';
      ctx.fillStyle = '#19F6C5';
      ctx.fillText(HOME.name, home[1] + 12, home[2] - 8);
    }
  };

  function init() {
    var nodes = document.querySelectorAll('[data-globe]');
    for (var i = 0; i < nodes.length; i++) {
      if (nodes[i].getContext) new Globe(nodes[i]);
    }
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
