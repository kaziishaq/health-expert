<?php
/** Reusable UI components. Each returns nothing and echoes markup. */

declare(strict_types=1);

function section_head(string $eyebrow, string $title, string $text = '', string $mod = ''): void { ?>
  <div class="shead <?= e($mod) ?>">
    <p class="eyebrow" data-reveal><?= e($eyebrow) ?></p>
    <h2 class="shead__title" data-split><?= $title /* trusted markup: allows <em> */ ?></h2>
    <?php if ($text !== ''): ?><p class="shead__text" data-reveal><?= e($text) ?></p><?php endif; ?>
  </div>
<?php }

function page_hero(string $eyebrow, string $title, string $text, array $crumbs = []): void { ?>
  <section class="phero">
    <div class="phero__bg" aria-hidden="true"><span class="orb orb--1"></span><span class="orb orb--2"></span><div class="grid-lines"></div></div>
    <div class="container phero__inner">
      <nav class="crumbs" aria-label="Breadcrumb">
        <a href="<?= url() ?>">Home</a>
        <?php foreach ($crumbs as $c): ?><span>/</span><span><?= e($c) ?></span><?php endforeach; ?>
      </nav>
      <p class="eyebrow eyebrow--light" data-reveal><?= e($eyebrow) ?></p>
      <h1 class="phero__title" data-split><?= $title ?></h1>
      <p class="phero__text" data-reveal><?= e($text) ?></p>
    </div>
  </section>
<?php }

function doctor_card(array $d): void {
    $c = COUNTRIES[$d['country']] ?? null;
    $msg = 'Hi Health Expert, I would like to consult ' . $d['name'] . ' (' . $d['specialty'] . ').';
    ?>
  <article class="doc" data-country="<?= e($d['country']) ?>" data-search="<?= e(strtolower($d['name'] . ' ' . $d['specialty'] . ' ' . $d['hospital'])) ?>" data-tilt>
    <div class="doc__top">
      <div class="doc__avatar" aria-hidden="true"><span><?= e(initials($d['name'])) ?></span></div>
      <?php if ($c): ?><span class="doc__flag"><?= e($c['code']) ?> · <?= e($c['name']) ?></span><?php endif; ?>
    </div>
    <h3 class="doc__name"><?= e($d['name']) ?></h3>
    <p class="doc__spec"><?= e($d['specialty']) ?></p>
    <p class="doc__hosp"><?= icon('building', 'icon icon--xs') ?> <?= e($d['hospital']) ?></p>
    <?php if (!empty($d['years'])): ?><p class="doc__years"><strong><?= (int) $d['years'] ?>+</strong> years in practice</p><?php endif; ?>
    <div class="doc__actions">
      <a class="btn btn--navy btn--sm" href="<?= wa($msg) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp</a>
      <a class="btn btn--line btn--sm" href="<?= url('contact', ['doctor' => $d['name']]) ?>#consult">Book video call</a>
    </div>
  </article>
<?php }

function faq_list(array $faqs): void { ?>
  <div class="faq">
    <?php foreach ($faqs as $i => [$q, $a]): ?>
      <details class="faq__item" data-reveal <?= $i === 0 ? 'open' : '' ?>>
        <summary><span><?= e($q) ?></span><i class="faq__icon" aria-hidden="true"></i></summary>
        <div class="faq__body"><p><?= e($a) ?></p></div>
      </details>
    <?php endforeach; ?>
  </div>
<?php }

function lead_form(?string $country = null, string $title = 'Get your free treatment plan'): void {
    $doctor = isset($_GET['doctor']) ? (string) $_GET['doctor'] : '';
    ?>
  <section class="consult" id="consult">
    <div class="container consult__inner">
      <div class="consult__copy">
        <p class="eyebrow eyebrow--light" data-reveal>Free · No obligation</p>
        <h2 class="consult__title" data-split><?= e($title) ?></h2>
        <p data-reveal>Share a few details and your coordinator will contact you within 24 hours with hospital options, estimated costs and next steps.</p>
        <ul class="consult__points">
          <li data-reveal><?= icon('check') ?> No cost, no obligation</li>
          <li data-reveal><?= icon('check') ?> Response within 24 hours</li>
          <li data-reveal><?= icon('check') ?> Bengali &amp; English support</li>
          <li data-reveal><?= icon('check') ?> Your information is never sold</li>
        </ul>
        <a class="consult__wa" href="<?= wa('Hi Health Expert, I would like a free consultation.') ?>" target="_blank" rel="noopener" data-reveal>
          <span class="consult__wa-icon"><?= icon('whatsapp') ?></span>
          <span><small>Prefer WhatsApp?</small><strong><?= e(SITE['whatsapp_label']) ?></strong></span>
        </a>
      </div>

      <form class="form" action="submit.php" method="post" enctype="multipart/form-data" novalidate data-lead-form data-reveal>
        <div class="form__success" hidden>
          <span class="form__success-icon"><?= icon('check') ?></span>
          <h3>Request received</h3>
          <p>Your coordinator will contact you within 24 hours with your personalised treatment plan.</p>
          <a class="btn btn--mint" href="<?= wa('Hi, I just submitted the consultation form on your website.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Speed things up on WhatsApp</a>
        </div>

        <div class="form__fields">
          <div class="field">
            <input id="f-name" name="name" type="text" placeholder=" " autocomplete="name" required>
            <label for="f-name">Full name *</label>
            <small class="field__err">Please enter the patient's name.</small>
          </div>
          <div class="field field--phone">
            <span class="field__prefix">+880</span>
            <input id="f-phone" name="phone" type="tel" placeholder=" " inputmode="tel" autocomplete="tel-national" pattern="0?1[3-9][0-9]{8}" required>
            <label for="f-phone">Mobile number *</label>
            <small class="field__err">Enter a valid Bangladeshi mobile number, e.g. 1712 345678.</small>
          </div>
          <div class="field">
            <input id="f-email" name="email" type="email" placeholder=" " autocomplete="email">
            <label for="f-email">Email (optional)</label>
            <small class="field__err">That email doesn't look right.</small>
          </div>
          <div class="field field--select">
            <select id="f-country" name="country">
              <option value="">Not sure — advise me</option>
              <?php foreach (COUNTRIES as $slug => $c): ?>
                <option value="<?= e($slug) ?>" <?= $country === $slug ? 'selected' : '' ?>><?= e($c['name']) ?></option>
              <?php endforeach; ?>
            </select>
            <label for="f-country">Preferred country</label>
            <?= icon('chevron', 'icon icon--sm field__chev') ?>
          </div>
          <div class="field field--full">
            <textarea id="f-condition" name="condition" rows="3" placeholder=" " required><?= $doctor !== '' ? e('I would like a video consultation with ' . $doctor . '.') : '' ?></textarea>
            <label for="f-condition">Medical condition or treatment needed *</label>
            <small class="field__err">Tell us briefly what you need help with.</small>
          </div>
          <label class="drop field--full" data-drop>
            <input type="file" name="files[]" accept=".pdf,.jpg,.jpeg,.png,.heic" multiple>
            <span class="drop__icon"><?= icon('upload') ?></span>
            <span class="drop__text"><strong>Upload reports or passport</strong><small>PDF, JPG or PNG · up to 10 MB each · optional</small></span>
            <span class="drop__list" data-drop-list></span>
          </label>
          <label class="check field--full">
            <input type="checkbox" name="consent" value="1" required>
            <span class="check__box"><?= icon('check') ?></span>
            <span>I agree that Health Expert may use these details to prepare my treatment plan, as described in the <a href="<?= url('privacy') ?>" target="_blank">privacy policy</a>.</span>
          </label>
          <button class="btn btn--mint btn--lg btn--block field--full" type="submit" data-magnetic>
            <span>Request free consultation</span> <?= icon('arrow') ?>
          </button>
        </div>
      </form>
    </div>
  </section>
<?php }

function journey(): void { ?>
  <section class="section journey">
    <div class="container">
      <?php section_head('How it works', 'From your first message <em>to the follow-up at home</em>', 'Six steps, one coordinator. You always know what happens next and who to call.', 'shead--center'); ?>
      <div class="journey__stack" data-stack>
        <?php foreach (STEPS as $i => $s): ?>
          <article class="jcard" style="--i: <?= $i ?>">
            <div class="jcard__num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></div>
            <div class="jcard__body">
              <h3><?= e($s['title']) ?></h3>
              <p><?= e($s['text']) ?></p>
            </div>
            <div class="jcard__icon"><?= icon($s['icon']) ?></div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php }
