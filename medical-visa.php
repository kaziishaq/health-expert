<?php
$page_title = 'Medical visa assistance';
$page_desc  = 'Medical visa support from Bangladesh for India, Thailand, Malaysia, Singapore and Türkiye — invitation letters, document checklists and appointment booking.';
$active     = 'visa';
require __DIR__ . '/partials/header.php';

$visa_countries = array_filter(COUNTRIES, static fn($c) => $c['visa']);
$first = isset($visa_countries['malaysia']) ? 'malaysia' : array_key_first($visa_countries);
?>

<?php page_hero('Medical visa assistance', 'Your medical visa, <em>handled end to end</em>', 'Invitation letters, document checklists and appointment booking for India, Thailand, Malaysia, Singapore and Türkiye. Send a photo of your documents and we check them for free.', ['Medical visa']); ?>

<section class="section">
  <div class="container">
    <?php section_head('How it works', 'Three things we do <em>for every visa</em>'); ?>
    <div class="vgeneric">
      <?php foreach ([
        ['file', 'Invitation letter', 'Once your treatment plan is confirmed, we request the official invitation letter from the hospital.'],
        ['passport', 'Document checklist', 'A checklist for your exact case — passport, photos, medical reports, financial and employment papers.'],
        ['calendar', 'Appointment booking', 'Your hospital appointment booked around your visa and flight dates, and moved if the schedule changes.'],
      ] as $i => [$ic, $t, $p]): ?>
        <article class="why__item" data-reveal>
          <span class="treat__icon"><?= icon($ic) ?></span>
          <h3><?= e($t) ?></h3>
          <p><?= e($p) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--cloud">
  <div class="container">
    <?php section_head('Choose your destination', 'Visa guide <em>by country</em>', 'Pick a country to see what to prepare.'); ?>

    <div data-tabs>
      <div class="vtabs" role="tablist" aria-label="Visa countries">
        <?php foreach ($visa_countries as $slug => $c): ?>
          <button class="chip<?= $slug === $first ? ' is-active' : '' ?>" role="tab" id="vt-<?= e($slug) ?>" aria-controls="vp-<?= e($slug) ?>" aria-selected="<?= $slug === $first ? 'true' : 'false' ?>" tabindex="<?= $slug === $first ? '0' : '-1' ?>"><?= e($c['name']) ?></button>
        <?php endforeach; ?>
      </div>

      <?php foreach ($visa_countries as $slug => $c): $list = VISA_CHECKLISTS[$slug] ?? null; ?>
        <div class="vpanel" role="tabpanel" id="vp-<?= e($slug) ?>" aria-labelledby="vt-<?= e($slug) ?>" <?= $slug === $first ? '' : 'hidden' ?>>
          <?php if ($list): ?>
            <div class="vlayout" data-checklist="<?= e($slug) ?>">
              <div class="checklist" data-stagger>
                <?php foreach ($list['groups'] as $gi => [$g, $items]): ?>
                  <div class="cgroup">
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
                  <p class="eyebrow eyebrow--light" style="margin:0"><?= e($c['name']) ?> checklist</p>
                  <div class="progress__num" data-progress-num>0/0</div>
                  <div class="progress__bar"><i data-progress-bar></i></div>
                  <p>Tick documents as you collect them. Saved on this device only.</p>
                </div>
                <?php if (!empty($list['note'])): ?><div class="note"><?= e($list['note']) ?></div><?php endif; ?>
                <a class="btn btn--navy btn--block" href="<?= wa('Hi, can you check my ' . $c['name'] . ' medical visa documents?') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Send a photo — free check</a>
              </aside>
            </div>
          <?php else: ?>
            <div class="callout" style="margin-top:0">
              <div>
                <h3><?= e($c['name']) ?> medical visa</h3>
                <p>Requirements depend on your case and travel dates. Send us your passport and reports and we will send you the exact checklist for your case.</p>
              </div>
              <div style="display:flex;gap:10px;flex-wrap:wrap">
                <a class="btn btn--mint" href="<?= wa('Hi, I need the ' . $c['name'] . ' medical visa checklist.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Get my checklist</a>
                <a class="btn btn--ghost-light" href="<?= url('destination', ['c' => $slug]) ?>">Treatment in <?= e($c['name']) ?></a>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container faq-wrap">
    <div><?php section_head('Visa questions', 'Before you <em>apply</em>'); ?></div>
    <?php faq_list([
      ['Can a family member travel with the patient?', 'In most cases, yes — medical visas generally allow the patient and at least one companion. We include the companion\'s documents in your checklist.'],
      ['How long before travel should I start?', 'As soon as your treatment plan is confirmed. We will tell you the typical processing time for your destination when we send the checklist.'],
      ['Do you charge for checking my documents?', 'No. Send a photo of your documents on WhatsApp and we check them for free.'],
      ['What if the doctor changes my appointment date?', 'We rebook the appointment and move flights around it, and update the documents if the change affects your visa.'],
    ]); ?>
  </div>
</section>

<?php lead_form(null, 'Start your visa with a free plan'); ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
