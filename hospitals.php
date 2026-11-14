<?php
$page_title = 'Partner hospitals';
$page_desc  = 'Partner hospitals in India, Thailand and Malaysia where Health Expert patients are treated — Medanta, Apollo, Max Healthcare, Medpark, Samitivej, Pantai, Gleneagles and more.';
$active     = 'hospitals';
require __DIR__ . '/partials/header.php';
?>

<?php page_hero('Partner hospitals', '75+ hospitals. <em>One honest recommendation.</em>', 'We work with accredited hospitals across six countries and match you to the one that fits your diagnosis, your budget and how quickly you need to be seen.', ['Hospitals']); ?>

<section class="section section--cloud" data-filterable>
  <div class="container">
    <div class="toolbar">
      <div class="filters" role="group" aria-label="Filter by country">
        <button class="chip is-active" data-filter="all" aria-pressed="true">All <small><?= count(HOSPITALS) ?></small></button>
        <?php foreach (COUNTRIES as $slug => $c): $n = count(hospitals_for($slug)); if (!$n) continue; ?>
          <button class="chip" data-filter="<?= e($slug) ?>" aria-pressed="false"><?= e($c['name']) ?> <small><?= $n ?></small></button>
        <?php endforeach; ?>
      </div>
      <label class="search"><?= icon('search') ?><span class="sr-only">Search hospitals</span><input type="search" placeholder="Search hospital or speciality" data-search-input></label>
    </div>

    <div class="hgrid">
      <?php foreach (HOSPITALS as $h): $c = COUNTRIES[$h['country']]; ?>
        <article class="hcard" data-country="<?= e($h['country']) ?>" data-search="<?= e(strtolower($h['name'] . ' ' . $h['city'] . ' ' . $c['name'] . ' ' . implode(' ', $h['tags']))) ?>" data-reveal>
          <div class="hcard__top">
            <span class="hcard__icon"><?= icon('building') ?></span>
            <span class="hcard__loc"><?= icon('pin', 'icon icon--xs') ?> <?= e($h['city']) ?>, <?= e($c['name']) ?></span>
          </div>
          <h3><?= e($h['name']) ?></h3>
          <div class="tags"><?php foreach ($h['tags'] as $t): ?><span class="tag"><?= e($t) ?></span><?php endforeach; ?></div>
          <div class="hcard__cta">
            <a class="link-arrow" href="<?= wa('Hi, I would like to know more about treatment at ' . $h['name'] . '.') ?>" target="_blank" rel="noopener">Ask about this hospital <?= icon('arrow') ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="empty-note">No hospitals match that search. Ask us — we work with 75+ hospitals and may well have the right one.</p>

    <div class="callout" data-reveal>
      <div>
        <h3>Looking at Singapore, Türkiye or China?</h3>
        <p>We share hospital options there once we have reviewed your reports, so the list fits your diagnosis.</p>
      </div>
      <a class="btn btn--mint" href="<?= wa('Hi, I would like hospital options in Singapore, Türkiye or China.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Ask a coordinator</a>
    </div>
  </div>
</section>

<?php lead_form(null, 'Not sure which hospital? We will match you.'); ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
