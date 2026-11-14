<?php
$page_title = 'Doctors';
$page_desc  = 'Speak to senior specialists in India, Thailand and Malaysia by video before you travel. Book a free consultation through Health Expert.';
$active     = 'doctors';
require __DIR__ . '/partials/header.php';
?>

<?php page_hero('Doctors you can speak to', 'Meet your specialist <em>before you fly</em>', 'A twenty-minute video consultation with the doctor who would treat you settles most of the questions families lose sleep over. We arrange it for free.', ['Doctors']); ?>

<section class="section section--cloud" data-filterable>
  <div class="container">
    <div class="toolbar">
      <div class="filters" role="group" aria-label="Filter by country">
        <button class="chip is-active" data-filter="all" aria-pressed="true">All <small><?= count(DOCTORS) ?></small></button>
        <?php foreach (COUNTRIES as $slug => $c): $n = count(doctors_for($slug)); if (!$n) continue; ?>
          <button class="chip" data-filter="<?= e($slug) ?>" aria-pressed="false"><?= e($c['name']) ?> <small><?= $n ?></small></button>
        <?php endforeach; ?>
      </div>
      <label class="search"><?= icon('search') ?><span class="sr-only">Search doctors</span><input type="search" placeholder="Search name, speciality or hospital" data-search-input></label>
    </div>

    <div class="dgrid">
      <?php foreach (DOCTORS as $d) doctor_card($d); ?>
    </div>
    <p class="empty-note">No doctors match that search. We can reach 1,000+ specialists — tell us what you need.</p>

    <div class="callout" data-reveal>
      <div>
        <h3>Need a different specialist?</h3>
        <p>We can reach more than 1,000 doctors directly. Tell us the diagnosis and we'll find the right one.</p>
      </div>
      <a class="btn btn--mint" href="<?= wa('Hi, I am looking for a specialist for my condition.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Find my specialist</a>
    </div>
  </div>
</section>

<?php lead_form(null, 'Book a free video consultation'); ?>
<?php require __DIR__ . '/partials/footer.php'; ?>
