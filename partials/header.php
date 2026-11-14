<?php
/**
 * Expects (optional): $page_title, $page_desc, $active, $body_class
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/data.php';
require_once __DIR__ . '/../includes/icons.php';
require_once __DIR__ . '/components.php';

$page_title = isset($page_title) ? $page_title . ' — ' . SITE['name'] : SITE['name'] . ' — ' . SITE['tagline'];
$page_desc  = $page_desc  ?? SITE['description'];
$active     = $active     ?? 'home';
$body_class = $body_class ?? '';

$nav = [
    'destinations' => ['Destinations', '#'],
    'hospitals'    => ['Hospitals', url('hospitals')],
    'doctors'      => ['Doctors', url('doctors')],
    'visa'         => ['Medical Visa', url('medical-visa')],
    'about'        => ['About', url('about')],
    'contact'      => ['Contact', url('contact')],
];
?><!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?></title>
<meta name="description" content="<?= e($page_desc) ?>">
<meta name="theme-color" content="#061C3F">
<meta property="og:title" content="<?= e($page_title) ?>">
<meta property="og:description" content="<?= e($page_desc) ?>">
<meta property="og:type" content="website">
<link rel="icon" href="<?= asset('img/favicon.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;600;700&family=Fraunces:ital,opsz,wght@0,9..144,300..700;1,9..144,300..600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
<script>
(function(d){d.classList.replace('no-js','js');try{var s=sessionStorage;if(!matchMedia('(prefers-reduced-motion: reduce)').matches&&(!s.getItem('he-visited')||s.getItem('he-trans')==='1'))d.classList.add('is-loading');}catch(e){}
setTimeout(function(){d.classList.remove('is-loading');},4000);})(document.documentElement);
</script>
</head>
<body class="<?= e($body_class) ?>">
<a class="skip" href="#main">Skip to content</a>

<!-- Preloader / page transition -->
<div class="loader" aria-hidden="true">
  <div class="loader__inner">
    <?= brand_mark('loader__mark') ?>
    <span class="loader__bar"><i></i></span>
  </div>
</div>

<div class="cursor" aria-hidden="true"><span></span></div>

<header class="nav" data-nav>
  <div class="nav__inner container">
    <a class="nav__logo" href="<?= url() ?>" aria-label="<?= e(SITE['name']) ?> home">
      <img src="<?= asset('img/logo-white.png') ?>" alt="Health Expert" width="170" height="40">
    </a>

    <nav class="nav__links" aria-label="Main">
      <div class="nav__item nav__item--mega">
        <button class="nav__link<?= $active === 'destinations' ? ' is-active' : '' ?>" aria-expanded="false" aria-haspopup="true" data-mega-toggle>
          Destinations <?= icon('chevron', 'icon icon--xs') ?>
        </button>
        <div class="mega" data-mega>
          <div class="mega__grid">
            <?php foreach (COUNTRIES as $navSlug => $navC): ?>
              <a class="mega__card" href="<?= url('destination', ['c' => $navSlug]) ?>">
                <span class="mega__code"><?= e($navC['code']) ?></span>
                <span>
                  <strong><?= e($navC['name']) ?></strong>
                  <small><?= e($navC['headline']) ?></small>
                </span>
                <?= icon('arrow-ur', 'icon icon--sm mega__arrow') ?>
              </a>
            <?php endforeach; ?>
          </div>
          <div class="mega__aside">
            <p class="eyebrow eyebrow--light">Not sure where to go?</p>
            <p>The right country depends on the diagnosis, the budget and how quickly you need to be seen.</p>
            <a class="btn btn--mint btn--sm" href="<?= wa('Hi Health Expert, I need help choosing the right country for treatment.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> Ask a coordinator</a>
          </div>
        </div>
      </div>
      <?php foreach (array_slice($nav, 1, null, true) as $key => [$label, $href]): ?>
        <a class="nav__link<?= $active === $key ? ' is-active' : '' ?>" href="<?= $href ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="nav__actions">
      <a class="nav__phone" href="tel:<?= e(SITE['hotline_tel']) ?>"><?= icon('phone', 'icon icon--sm') ?><span><?= e(SITE['hotline']) ?></span></a>
      <a class="btn btn--mint btn--sm nav__cta" href="<?= url('contact') ?>#consult" data-magnetic>Free consultation</a>
      <button class="nav__burger" aria-label="Open menu" aria-expanded="false" data-burger><span></span><span></span></button>
    </div>
  </div>
</header>

<!-- Mobile menu -->
<div class="drawer" data-drawer aria-hidden="true">
  <div class="drawer__inner">
    <p class="eyebrow eyebrow--light">Destinations</p>
    <div class="drawer__countries">
      <?php foreach (COUNTRIES as $navSlug => $navC): ?>
        <a href="<?= url('destination', ['c' => $navSlug]) ?>"><span><?= e($navC['code']) ?></span><?= e($navC['name']) ?></a>
      <?php endforeach; ?>
    </div>
    <nav class="drawer__links" aria-label="Mobile">
      <a href="<?= url() ?>">Home</a>
      <?php foreach (array_slice($nav, 1, null, true) as [$label, $href]): ?>
        <a href="<?= $href ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
      <a href="<?= url('career') ?>">Career</a>
    </nav>
    <div class="drawer__foot">
      <a class="btn btn--mint" href="<?= wa('Hi Health Expert, I would like a free consultation.') ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?> WhatsApp us</a>
      <a class="btn btn--ghost-light" href="tel:<?= e(SITE['hotline_tel']) ?>"><?= icon('phone') ?> <?= e(SITE['hotline']) ?></a>
    </div>
  </div>
</div>

<main id="main">
