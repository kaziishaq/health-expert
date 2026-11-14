</main>

<footer class="footer">
  <div class="footer__cta container">
    <div>
      <p class="eyebrow eyebrow--light">Start with a conversation</p>
      <h2 class="footer__title" data-split>Send us your reports.<br><em>We'll take it from there.</em></h2>
    </div>
    <div class="footer__cta-actions">
      <a class="btn btn--mint btn--lg" href="<?= wa('Hi Health Expert, I would like a free consultation.') ?>" target="_blank" rel="noopener" data-magnetic><?= icon('whatsapp') ?> WhatsApp a coordinator</a>
      <a class="btn btn--ghost-light btn--lg" href="<?= url('contact') ?>#consult">Request free consultation <?= icon('arrow') ?></a>
    </div>
  </div>

  <div class="footer__grid container">
    <div class="footer__brand">
      <img src="<?= asset('img/logo-white.png') ?>" alt="Health Expert" width="190" height="45" loading="lazy">
      <p><?= e(SITE['description']) ?></p>
    </div>

    <div>
      <h3 class="footer__h">Destinations</h3>
      <ul>
        <?php foreach (COUNTRIES as $navSlug => $navC): ?>
          <li><a href="<?= url('destination', ['c' => $navSlug]) ?>">Treatment in <?= e($navC['name']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div>
      <h3 class="footer__h">Company</h3>
      <ul>
        <li><a href="<?= url('about') ?>">About us</a></li>
        <li><a href="<?= url('hospitals') ?>">Partner hospitals</a></li>
        <li><a href="<?= url('doctors') ?>">Doctors</a></li>
        <li><a href="<?= url('medical-visa') ?>">Medical visa</a></li>
        <li><a href="<?= url('career') ?>">Career</a></li>
        <li><a href="<?= url('privacy') ?>">Privacy policy</a></li>
      </ul>
    </div>

    <div class="footer__contact">
      <h3 class="footer__h">Contact</h3>
      <a href="tel:<?= e(SITE['hotline_tel']) ?>"><?= icon('phone', 'icon icon--sm') ?> <?= e(SITE['hotline']) ?></a>
      <a href="<?= wa() ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 'icon icon--sm') ?> <?= e(SITE['whatsapp_label']) ?></a>
      <a href="mailto:<?= e(SITE['email']) ?>"><?= icon('mail', 'icon icon--sm') ?> <?= e(SITE['email']) ?></a>
      <span><?= icon('clock', 'icon icon--sm') ?> <?= e(SITE['hours']) ?></span>
      <?php foreach (SITE['offices'] as $o): ?>
        <a href="<?= e($o['map']) ?>" target="_blank" rel="noopener"><?= icon('pin', 'icon icon--sm') ?> <span><strong><?= e($o['label']) ?></strong><br><?= e($o['address']) ?></span></a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="footer__word" aria-hidden="true">HEALTH EXPERT</div>

  <div class="footer__bottom container">
    <span>© <?= date('Y') ?> <?= e(SITE['domain']) ?> — All rights reserved.</span>
    <span>Health Expert is a medical travel facilitator and does not replace a licensed doctor.</span>
  </div>
</footer>

<a class="wa-float" href="<?= wa('Hi Health Expert, I need help with treatment abroad.') ?>" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
  <?= icon('whatsapp') ?><span class="wa-float__label">চ্যাট শুরু করুন</span>
</a>

<div class="toast" role="status" aria-live="polite" data-toast></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js" defer></script>
<script src="<?= asset('js/globe.js') ?>" defer></script>
<script src="<?= asset('js/main.js') ?>" defer></script>
</body>
</html>
