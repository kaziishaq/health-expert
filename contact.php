<?php
$page_title = 'Contact us';
$page_desc  = 'Talk to a Health Expert coordinator on WhatsApp, by phone or email, or visit our offices in Dhaka and Kuala Lumpur.';
$active     = 'contact';
require __DIR__ . '/partials/header.php';
?>

<?php page_hero('Contact us', 'Talk to a <em>real person</em>', 'One coordinator, from your first message to the follow-up at home. Pick whichever way is easiest for you.', ['Contact']); ?>

<section class="section section--cloud">
  <div class="container">
    <div class="ccards">
      <a class="ccard" href="<?= wa('Hi Health Expert, I need help.') ?>" target="_blank" rel="noopener" data-reveal>
        <span class="ccard__icon" style="background:#25d366;color:#fff"><?= icon('whatsapp') ?></span>
        <small>WhatsApp</small><strong><?= e(SITE['whatsapp_label']) ?></strong><span>Fastest reply — day and night</span>
      </a>
      <a class="ccard" href="tel:<?= e(SITE['hotline_tel']) ?>" data-reveal>
        <span class="ccard__icon"><?= icon('phone') ?></span>
        <small>Hotline</small><strong><?= e(SITE['hotline']) ?></strong><span><?= e(SITE['hours']) ?></span>
      </a>
      <a class="ccard" href="mailto:<?= e(SITE['email']) ?>" data-reveal>
        <span class="ccard__icon"><?= icon('mail') ?></span>
        <small>Email</small><strong><?= e(SITE['email']) ?></strong><span>Send reports and documents</span>
      </a>
      <div class="ccard" data-reveal>
        <span class="ccard__icon"><?= icon('clock') ?></span>
        <small>Office hours</small><strong><?= e(SITE['hours']) ?></strong><span>WhatsApp support continues while you are in hospital abroad</span>
      </div>
    </div>

    <div class="offices" style="margin-top:16px">
      <?php foreach (SITE['offices'] as $o): ?>
        <article class="office" data-reveal>
          <span class="office__city" aria-hidden="true"><?= e($o['city']) ?></span>
          <p class="eyebrow eyebrow--light"><?= e($o['label']) ?></p>
          <h3><?= e($o['city']) ?></h3>
          <p><?= e($o['address']) ?></p>
          <a class="link-arrow" href="<?= e($o['map']) ?>" target="_blank" rel="noopener">Get directions <?= icon('arrow') ?></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php lead_form(); ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
