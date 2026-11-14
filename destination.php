<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/data.php';

$slug = isset($_GET['c']) ? strtolower((string) $_GET['c']) : '';
if (!isset(COUNTRIES[$slug])) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}
$c = COUNTRIES[$slug];

$page_title = 'Medical treatment in ' . $c['name'];
$page_desc  = $c['summary'];
$active     = 'destinations';
require __DIR__ . '/partials/header.php';

$hospitals = hospitals_for($slug);
$doctors   = doctors_for($slug);
$checklist = VISA_CHECKLISTS[$slug] ?? null;

$faqs = [
    ['Is the consultation really free?', 'Yes. The review of your reports, the written plan, the cost estimate and the video consultation are free, with no obligation to proceed.'],
    ['Do I need a visa for treatment in ' . $c['name'] . '?', $c['visa']
        ? 'Yes, a medical visa is needed for the patient and usually one companion. We prepare the invitation letter, give you a document checklist and book the hospital appointment.'
        : 'Visa rules depend on your case and travel dates. Send us your passport details and we will guide you through the requirements.'],
    ['Will there be a language barrier?', 'No. A Bangla-speaking interpreter joins your consultations, and your coordinator is on WhatsApp throughout your stay.'],
    ['How long does treatment usually take?', 'It depends on the procedure — from a single-day health check-up to a few weeks for surgery, recovery and follow-up. Your written plan includes an expected length of stay.'],
    ['Is ' . $c['name'] . ' the right choice for me?', 'Maybe — it depends on the diagnosis, the budget and how quickly you need to be seen. We compare options honestly, and if treatment is available in Dhaka at a similar standard, we tell you.'],
];
?>

<section class="phero">
  <div class="phero__bg" aria-hidden="true"><span class="orb orb--1"></span><span class="orb orb--2"></span><div class="grid-lines"></div></div>
  <div class="phero__big" aria-hidden="true"><?= e($c['code']) ?></div>
  <div class="container phero__inner">
    <nav class="crumbs" aria-label="Breadcrumb"><a href="<?= url() ?>">Home</a><span>/</span><a href="<?= url() ?>#destinations">Destinations</a><span>/</span><span><?= e($c['name']) ?></span></nav>
    <p class="eyebrow eyebrow--light" data-reveal>Medical travel to <?= e($c['name']) ?></p>
    <h1 class="phero__title" data-split>Treatment in <em><?= e($c['name']) ?></em></h1>
    <p class="phero__text" data-reveal><?= e($c['summary']) ?></p>
    <div class="phero__actions" data-reveal>
      <a class="btn btn--mint btn--lg" href="#consult" data-magnetic>Get my free <?= e($c['name']) ?> plan <?= icon('arrow') ?></a>
      <a class="btn btn--ghost-light btn--lg" href="<?= wa('Hi Health Expert, I am interested in treatment in ' . $c['name'] . '.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp now</a>
    </div>
    <div class="phero__stats" data-reveal>
      <div class="phero__stat"><strong><?= e($c['city']) ?></strong><span><?= e($c['flight']) ?></span></div>
      <div class="phero__stat"><strong>24 h</strong><span>coordinator response</span></div>
      <div class="phero__stat"><strong>Free</strong><span>plan &amp; cost estimate</span></div>
    </div>
  </div>
</section>

<!-- Why -->
<section class="section">
  <div class="container">
    <?php section_head('Why ' . $c['name'], e($c['headline'])); ?>
    <div class="why">
      <?php foreach ($c['why'] as $i => [$t, $p]): ?>
        <article class="why__item" data-reveal>
          <span class="n">0<?= $i + 1 ?></span>
          <h3><?= e($t) ?></h3>
          <p><?= e($p) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="tags" style="margin-top:28px" data-reveal>
      <span style="font-weight:600;margin-right:6px">Best for:</span>
      <?php foreach ($c['best_for'] as $b): ?><span class="tag"><?= e($b) ?></span><?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Doctors -->
<?php if ($doctors): ?>
<section class="section section--cloud" style="overflow:hidden">
  <div class="container">
    <div class="rail-head">
      <?php section_head('Specialists in ' . $c['name'], 'Meet your doctor <em>before you travel</em>', 'Internationally trained specialists at our partner hospitals. Book a video consultation before you decide.'); ?>
      <div class="rail-nav" data-reveal>
        <button type="button" aria-label="Previous" data-rail-prev><?= icon('arrow') ?></button>
        <button type="button" aria-label="Next" data-rail-next><?= icon('arrow') ?></button>
      </div>
    </div>
    <div class="rail" data-rail>
      <?php foreach ($doctors as $d) doctor_card($d); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Treatments -->
<section class="section">
  <div class="container">
    <?php section_head('Popular treatments', 'What Bangladeshi patients choose in <em>' . e($c['name']) . '</em>', 'Each pathway is matched to hospitals with proven outcomes and dedicated international patient centres.', 'shead--center'); ?>
    <div class="tgrid">
      <?php foreach (TREATMENTS as $t): ?>
        <article class="treat" data-reveal>
          <span class="treat__icon"><?= icon($t['icon']) ?></span>
          <h3><?= e($t['title']) ?></h3>
          <p><?= e($t['text']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Hospitals -->
<section class="section section--dark">
  <div class="container">
    <?php section_head('Partner hospitals', 'Where you could be <em>treated</em>', $hospitals ? 'A few of the hospitals our patients are treated at in ' . $c['name'] . '. We match you to the right one for your diagnosis.' : 'We share the hospital options that fit your diagnosis once we have reviewed your reports.', 'shead--light'); ?>
    <?php if ($hospitals): ?>
      <div class="bento">
        <?php foreach ($hospitals as $h): ?>
          <article class="svc" data-reveal>
            <span class="svc__icon"><?= icon('building') ?></span>
            <h3><?= e($h['name']) ?></h3>
            <p><?= icon('pin', 'icon icon--xs') ?> <?= e($h['city']) ?>, <?= e($c['name']) ?></p>
            <div class="tags" style="margin-top:16px"><?php foreach ($h['tags'] as $t): ?><span class="tag tag--dark"><?= e($t) ?></span><?php endforeach; ?></div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="callout" style="background:rgba(255,255,255,.05);box-shadow:inset 0 0 0 1px rgba(255,255,255,.1)" data-reveal>
        <div><h3>Hospital options on request</h3><p>Send your reports and we'll come back with suitable hospitals and a cost estimate.</p></div>
        <a class="btn btn--mint" href="<?= wa('Hi, please share hospital options in ' . $c['name'] . ' for my case.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Ask for options</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- Visa -->
<section class="section section--cloud">
  <div class="container">
    <?php section_head('Medical visa support', $c['name'] . ' <em>visa checklist</em>', $checklist ? 'Keep these document groups ready and our coordinators will handle the rest.' : 'We prepare the invitation letter, give you an exact checklist for your case and book the appointment.'); ?>
    <?php if ($checklist): ?>
      <div class="vlayout" data-checklist="<?= e($slug) ?>">
        <div class="checklist">
          <?php foreach ($checklist['groups'] as $gi => [$g, $items]): ?>
            <div class="cgroup" data-reveal>
              <h3><span><?= $gi + 1 ?></span><?= e($g) ?></h3>
              <ul>
                <?php foreach ($items as $it): ?>
                  <li><label class="citem check"><input type="checkbox"><span class="check__box"><?= icon('check') ?></span><span><?= e($it) ?></span></label></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endforeach; ?>
        </div>
        <aside class="vside">
          <div class="progress">
            <p class="eyebrow eyebrow--light" style="margin:0">Your progress</p>
            <div class="progress__num" data-progress-num>0/0</div>
            <div class="progress__bar"><i data-progress-bar></i></div>
            <p>Tick documents as you collect them. Saved on this device.</p>
          </div>
          <?php if (!empty($checklist['note'])): ?><div class="note"><?= e($checklist['note']) ?></div><?php endif; ?>
          <a class="btn btn--navy btn--block" href="<?= wa('Hi, can you check my visa documents for ' . $c['name'] . '?') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Send a photo — we check for free</a>
        </aside>
      </div>
    <?php else: ?>
      <div class="vgeneric">
        <?php foreach ([['file', 'Invitation letter', 'We request the hospital invitation letter once your plan is confirmed.'], ['passport', 'Document checklist', 'An exact list for your case — passport, photos, reports and financial papers.'], ['calendar', 'Appointment booking', 'Your hospital appointment booked around your visa and flight dates.']] as [$ic, $t, $p]): ?>
          <article class="why__item" data-reveal><span class="treat__icon"><?= icon($ic) ?></span><h3><?= e($t) ?></h3><p><?= e($p) ?></p></article>
        <?php endforeach; ?>
      </div>
      <div style="margin-top:24px" data-reveal><a class="link-arrow" href="<?= url('medical-visa') ?>">How our visa support works <?= icon('arrow') ?></a></div>
    <?php endif; ?>
  </div>
</section>

<?php journey(); ?>

<section class="section">
  <div class="container faq-wrap">
    <div><?php section_head('Frequently asked', 'Treatment in ' . e($c['name']) . ', <em>answered</em>'); ?></div>
    <?php faq_list($faqs); ?>
  </div>
</section>

<?php lead_form($slug, 'Get your free ' . $c['name'] . ' treatment plan'); ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
