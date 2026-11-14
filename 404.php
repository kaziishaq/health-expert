<?php
http_response_code(404);
$page_title = 'Page not found';
$active = '';
require_once __DIR__ . '/partials/header.php';
?>
<section class="notfound">
  <div>
    <div class="notfound__code" aria-hidden="true">404</div>
    <h1 data-split>This page took a <em>different flight</em></h1>
    <p data-reveal>The page you are looking for doesn't exist or has moved. Your coordinator is still one message away.</p>
    <div class="phero__actions" style="justify-content:center" data-reveal>
      <a class="btn btn--mint" href="<?= url() ?>">Back to home <?= icon('arrow') ?></a>
      <a class="btn btn--ghost-light" href="<?= wa() ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp us</a>
    </div>
  </div>
</section>
<?php require __DIR__ . '/partials/footer.php'; ?>
