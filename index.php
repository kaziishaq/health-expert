<?php
$active = 'home';
require __DIR__ . '/partials/header.php';

$partners = ['Medanta – The Medicity', 'Apollo Cancer Centre', 'Max Healthcare', 'Fortis Healthcare', 'Medpark Hospital', 'Samitivej', 'Pantai Hospital', 'Gleneagles', 'Prince Court Medical Centre', 'Sunway Medical Centre', 'KPJ Healthcare'];
?>

<!-- ============ HERO ============ -->
<section class="hero">
  <div class="hero__bg" aria-hidden="true">
    <span class="orb orb--1"></span><span class="orb orb--2"></span>
    <div class="grid-lines"></div>
  </div>
  <canvas class="hero__globe" data-globe aria-hidden="true"></canvas>

  <div class="container hero__inner">
    <div class="hero__copy">
      <p class="pill" data-reveal><span class="pill__dot"></span> Trusted medical assistance from Bangladesh</p>
      <h1 class="hero__title" data-split>Bridging Bangladesh with <em>global healthcare</em></h1>
      <p class="hero__lead" data-reveal>Trusted medical guidance and personal support for treatment abroad. One coordinator, the right specialist, and every step handled — from your first message to the follow-up at home.</p>
      <div class="hero__ctas" data-reveal>
        <a class="btn btn--mint btn--lg" href="#consult" data-magnetic>Get a free treatment plan <?= icon('arrow') ?></a>
        <a class="btn btn--ghost-light btn--lg" href="<?= wa('Hi Health Expert, I would like to talk to a health expert.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Talk to a health expert</a>
      </div>
      <div class="hero__trust" data-reveal>
        <div><strong>1,200+</strong><span>patients since 2022</span></div>
        <div><strong>75+</strong><span>partner hospitals</span></div>
        <div><strong>24 h</strong><span>coordinator response</span></div>
      </div>
    </div>
  </div>

  <div class="hero__chips" aria-hidden="true">
    <div class="chip-card chip-card--1"><span class="chip-card__icon"><?= icon('video') ?></span><span><strong>Video consultation</strong>20 minutes with your specialist</span></div>
    <div class="chip-card chip-card--2"><span class="chip-card__icon"><?= icon('passport') ?></span><span><strong>Medical visa</strong>Handled end to end</span></div>
    <div class="chip-card chip-card--3"><span class="chip-card__icon"><?= icon('languages') ?></span><span><strong>Bangla interpreter</strong>In every consultation</span></div>
  </div>

  <div class="hero__scroll" aria-hidden="true">Scroll<i></i></div>
</section>

<!-- ============ PARTNERS MARQUEE ============ -->
<section class="marquee" aria-label="Partner hospitals">
  <p class="marquee__label">Partner hospitals our patients are treated at</p>
  <div class="marquee__viewport">
    <div class="marquee__track">
      <?php for ($loop = 0; $loop < 2; $loop++): foreach ($partners as $p): ?>
        <span class="marquee__item" <?= $loop ? 'aria-hidden="true"' : '' ?>><?= e($p) ?></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>
</section>

<!-- ============ STATEMENT + STATS ============ -->
<section class="statement">
  <div class="container">
    <p class="eyebrow" data-reveal>Why families trust us</p>
    <p class="statement__text" data-words style="margin-top:28px">
      What people want most is a straight answer and one person who picks up the phone. So we built the service around that — honest advice on where to go, hospital prices with <em>no margin added</em>, and if your treatment is available in Dhaka for less, we tell you.
    </p>
    <div class="statement__sig" data-reveal><?= brand_mark('mark') ?> The Health Expert team, Dhaka &amp; Kuala Lumpur</div>

    <div class="stats" style="margin-top:clamp(60px,8vw,110px)">
      <?php foreach (SITE['stats'] as $s): ?>
        <div class="stat" data-reveal>
          <div class="stat__num"><span data-counter="<?= (int) $s['value'] ?>"><?= number_format($s['value']) ?></span><?php if ($s['suffix']): ?><sup><?= e($s['suffix']) ?></sup><?php endif; ?></div>
          <p class="stat__label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ DESTINATIONS ============ -->
<section class="section section--cloud" id="destinations">
  <div class="container">
    <?php section_head('Where we send patients, and why', 'The right country for <em>your diagnosis</em>', 'It depends on the diagnosis, the budget and how quickly you need to be seen. We will tell you honestly if a treatment is available at home for less.'); ?>

    <div class="dest" data-tabs>
      <div class="dest__tabs" role="tablist" aria-label="Destinations">
        <?php $i = 0; foreach (COUNTRIES as $slug => $c): ?>
          <button class="dest__tab" role="tab" id="tab-<?= e($slug) ?>" aria-controls="panel-<?= e($slug) ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" tabindex="<?= $i === 0 ? '0' : '-1' ?>">
            <span class="dest__tab-code"><?= e($c['code']) ?></span>
            <span class="dest__tab-name"><?= e($c['name']) ?></span>
            <?= icon('arrow') ?>
          </button>
        <?php $i++; endforeach; ?>
      </div>

      <div class="dest__panels">
        <?php $i = 0; foreach (COUNTRIES as $slug => $c):
          // simple schematic route: DAC on the left, destination on the right
          ?>
          <article class="dest__panel" role="tabpanel" id="panel-<?= e($slug) ?>" aria-labelledby="tab-<?= e($slug) ?>" <?= $i ? 'hidden' : '' ?>>
            <svg class="dest__route" viewBox="0 0 420 200" aria-hidden="true">
              <path d="M30 160 C 140 10, 290 10, 390 120"/>
              <circle cx="30" cy="160" r="5"/><circle cx="390" cy="120" r="5"/>
              <text x="14" y="188">DAC</text><text x="366" y="148"><?= e(strtoupper(substr($c['city'], 0, 3))) ?></text>
            </svg>
            <div data-stagger>
              <p class="dest__coords"><?= number_format(abs($c['lat']), 2) ?>° <?= $c['lat'] >= 0 ? 'N' : 'S' ?> · <?= number_format(abs($c['lon']), 2) ?>° E · <?= e($c['city']) ?></p>
              <h3 class="dest__name"><?= e($c['name']) ?></h3>
              <p class="dest__headline"><?= e($c['headline']) ?></p>
              <p class="dest__summary"><?= e($c['summary']) ?></p>
              <div class="dest__meta">
                <span><?= icon('plane', 'icon icon--sm') ?> <?= e($c['flight']) ?></span>
                <span><?= icon('passport', 'icon icon--sm') ?> <?= $c['visa'] ? 'Medical visa support' : 'Visa guidance on request' ?></span>
                <span><?= icon('building', 'icon icon--sm') ?> <?= count(hospitals_for($slug)) ?: 'Network on request' ?><?= count(hospitals_for($slug)) ? ' partner hospitals listed' : '' ?></span>
              </div>
            </div>
            <div class="dest__foot">
              <div class="tags">
                <?php foreach ($c['best_for'] as $b): ?><span class="tag tag--dark"><?= e($b) ?></span><?php endforeach; ?>
              </div>
              <a class="btn btn--mint" href="<?= url('destination', ['c' => $slug]) ?>">Treatment in <?= e($c['name']) ?> <?= icon('arrow') ?></a>
            </div>
          </article>
        <?php $i++; endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ JOURNEY ============ -->
<?php journey(); ?>

<!-- ============ DOCTORS ============ -->
<section class="section" id="doctors" style="overflow:hidden">
  <div class="container">
    <div class="rail-head">
      <?php section_head('Doctors you can speak to before you travel', 'Meet the specialist <em>before you fly</em>', 'A video consultation takes twenty minutes and settles most of the questions families lose sleep over.'); ?>
      <div class="rail-nav" data-reveal>
        <button type="button" aria-label="Previous doctors" data-rail-prev><?= icon('arrow') ?></button>
        <button type="button" aria-label="Next doctors" data-rail-next><?= icon('arrow') ?></button>
      </div>
    </div>
    <div class="rail" data-rail>
      <?php foreach (doctors_for(null, true) as $d) doctor_card($d); ?>
    </div>
    <div style="margin-top:20px" data-reveal><a class="link-arrow" href="<?= url('doctors') ?>">See all doctors <?= icon('arrow') ?></a></div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="section section--dark" id="services">
  <div class="container">
    <?php section_head('What is included', 'Everything handled, <em>so you can focus on getting better</em>', 'Every item below is part of the service. The items marked free stay free whether or not you book treatment through us.', 'shead--light'); ?>
    <div class="bento">
      <?php foreach (SERVICES as $i => $s): ?>
        <article class="svc<?= $i < 2 ? ' svc--wide' : '' ?>" data-reveal>
          <?php if ($s['free']): ?><span class="svc__free">Free</span><?php endif; ?>
          <span class="svc__icon"><?= icon($s['icon']) ?></span>
          <h3><?= e($s['title']) ?></h3>
          <p><?= e($s['text']) ?></p>
        </article>
      <?php endforeach; ?>
      <article class="svc svc--cta" data-reveal>
        <div>
          <h3>Not sure what you need?</h3>
          <p>Send your reports and we'll tell you which services apply to your case.</p>
        </div>
        <a class="btn btn--mint" href="<?= wa('Hi, I am not sure which services I need. Can you help?') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Ask on WhatsApp</a>
      </article>
    </div>
  </div>
</section>

<!-- ============ PROMISES ============ -->
<section class="section">
  <div class="container promises">
    <div class="promises__sticky">
      <?php section_head('Why families come back with the next case', 'Four promises <em>we keep</em>', 'Three years of doing this has taught us that what people want most is a straight answer and one person who picks up the phone.'); ?>
      <a class="btn btn--navy" href="<?= url('about') ?>" data-reveal>About Health Expert <?= icon('arrow') ?></a>
    </div>
    <div class="promises__list">
      <?php foreach (PROMISES as $i => [$t, $p]): ?>
        <div class="promise" data-reveal>
          <span class="promise__n">0<?= $i + 1 ?></span>
          <div><h3><?= e($t) ?></h3><p><?= e($p) ?></p></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ TREATMENTS ============ -->
<section class="section section--cloud">
  <div class="container">
    <?php section_head('Popular treatments', 'Matched to hospitals with <em>proven outcomes</em>', 'Each pathway is matched to hospitals with dedicated international patient centres.', 'shead--center'); ?>
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

<!-- ============ FAQ ============ -->
<section class="section">
  <div class="container faq-wrap">
    <div>
      <?php section_head('Questions families ask', 'Straight <em>answers</em>'); ?>
      <div class="help-card" data-reveal>
        <strong style="font-size:20px">Still have a question?</strong>
        <p>Our coordinators answer on WhatsApp — including at night, Bangladesh time, while you are abroad.</p>
        <a class="btn btn--mint btn--sm" href="<?= wa('Hi Health Expert, I have a question.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Ask a coordinator</a>
      </div>
    </div>
    <?php faq_list(FAQS); ?>
  </div>
</section>

<!-- ============ CONSULTATION ============ -->
<?php lead_form(); ?>

<?php require __DIR__ . '/partials/footer.php'; ?>
