<?php
$page_title = 'About us';
$page_desc  = 'Health Expert has helped 1,200+ patients from Bangladesh get treated abroad since 2022, with one coordinator per case and no margin on hospital prices.';
$active     = 'about';
require __DIR__ . '/partials/header.php';
?>

<?php page_hero('About Health Expert', 'A straight answer and <em>one person who picks up</em>', 'Since 2022 we have helped more than 1,200 patients from Bangladesh get the right treatment abroad — and we tell families honestly when staying home is the better choice.', ['About']); ?>

<section class="section">
  <div class="container split">
    <div class="prose">
      <p class="eyebrow" data-reveal>Our story</p>
      <h2 class="shead__title" style="margin-bottom:28px" data-split>Built around what families <em>actually need</em></h2>
      <p data-reveal>When someone in the family is ill, the hardest part is often not the treatment — it is not knowing who to trust. Which country? Which hospital? Is the quote fair? Who do we call at 2 AM in a foreign city?</p>
      <p data-reveal>Three years of doing this has taught us that what people want most is <strong>a straight answer and one person who picks up the phone</strong>. That is what we built Health Expert around.</p>
      <p data-reveal>We work with 75+ partner hospitals across India, Thailand, Malaysia, Singapore, Türkiye and China, and can reach more than 1,000 specialists directly. We pass on hospital prices exactly as quoted, and if your treatment is available in Dhaka at a similar standard, we say so.</p>
    </div>
    <div class="visual-card" data-reveal>
      <span class="visual-card__ring"></span><span class="visual-card__ring"></span>
      <?= brand_mark('mark') ?>
    </div>
  </div>
</section>

<section class="section section--cloud">
  <div class="container">
    <div class="stats">
      <?php foreach (SITE['stats'] as $s): ?>
        <div class="stat" data-reveal>
          <div class="stat__num"><span data-counter="<?= (int) $s['value'] ?>"><?= number_format($s['value']) ?></span><?php if ($s['suffix']): ?><sup><?= e($s['suffix']) ?></sup><?php endif; ?></div>
          <p class="stat__label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container promises">
    <div class="promises__sticky">
      <?php section_head('What we promise', 'Four promises <em>we keep</em>', 'These are the reasons families come back to us with the next case.'); ?>
    </div>
    <div class="promises__list">
      <?php foreach (PROMISES as $i => [$t, $p]): ?>
        <div class="promise" data-reveal><span class="promise__n">0<?= $i + 1 ?></span><div><h3><?= e($t) ?></h3><p><?= e($p) ?></p></div></div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--cloud">
  <div class="container">
    <?php section_head('Our offices', 'In Dhaka and <em>Kuala Lumpur</em>', 'Visit us, or reach the team on WhatsApp any time.'); ?>
    <div class="offices">
      <?php foreach (SITE['offices'] as $o): ?>
        <article class="office" data-reveal>
          <span class="office__city" aria-hidden="true"><?= e($o['city']) ?></span>
          <p class="eyebrow eyebrow--light"><?= e($o['label']) ?></p>
          <h3><?= e($o['city']) ?></h3>
          <p><?= e($o['address']) ?></p>
          <a class="link-arrow" href="<?= e($o['map']) ?>" target="_blank" rel="noopener">Open in Google Maps <?= icon('arrow') ?></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php lead_form(); ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
