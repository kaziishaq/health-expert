<?php
$page_title = 'Career';
$page_desc  = 'Work with Health Expert and help patients from Bangladesh get the right treatment abroad.';
$active     = 'career';
require __DIR__ . '/partials/header.php';

// Backend: replace with job listings from the database.
$jobs = [];
?>

<?php page_hero('Career', 'Help families through <em>the hardest weeks</em>', 'We grow the team as more families trust us with their care. If you are calm under pressure and good with people, we would like to hear from you.', ['Career']); ?>

<section class="section">
  <div class="container">
    <?php section_head('How we work', 'What matters <em>on our team</em>'); ?>
    <div class="why">
      <?php foreach ([
        ['Patients first', 'Every decision starts with what is right for the patient — including telling them when to stay home.'],
        ['Own the case', 'Coordinators stay with a family from the first message to the follow-up. No hand-offs.'],
        ['Straight answers', 'We say what we know, admit what we don\'t, and find out fast.'],
        ['Always reachable', 'Families abroad need us at odd hours. We share that load as a team.'],
      ] as $i => [$t, $p]): ?>
        <article class="why__item" data-reveal><span class="n">0<?= $i + 1 ?></span><h3><?= e($t) ?></h3><p><?= e($p) ?></p></article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section--cloud">
  <div class="container">
    <?php section_head('Open roles', 'Current <em>openings</em>'); ?>
    <?php if ($jobs): ?>
      <!-- Job cards render here once the backend is connected -->
    <?php else: ?>
      <div class="callout" data-reveal>
        <div>
          <h3>No open roles right now</h3>
          <p>We still read every application. Send your CV and a short note about yourself, and we will contact you when a suitable role opens.</p>
        </div>
        <a class="btn btn--mint" href="mailto:<?= e(SITE['email']) ?>?subject=<?= rawurlencode('Career application') ?>"><?= icon('mail') ?> Email your CV</a>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
