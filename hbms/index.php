<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel & Resort</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Sea Horizon Hotel — A quiet place by the sea. Comfortable rooms, honest service, and breakfast worth waking up for.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="favicon.php">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#815854',
            'primary-dark': '#6b4644',
            cream: '#F9EBDE',
            'cream-dark': '#F0D5C0'
          },
          fontFamily: {
            serif: ['Playfair Display', 'serif'],
            sans: ['DM Sans', 'sans-serif']
          }
        }
      }
    }
  </script>

  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    html {
      scroll-behavior: smooth;
      -webkit-font-smoothing: antialiased;
      text-rendering: optimizeLegibility
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #F9EBDE;
      color: #3a2c28;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
    }

    img {
      display: block;
      max-width: 100%;
      height: auto;
    }

    a {
      text-decoration: none;
      transition: color .2s, background .2s;
    }

    button {
      cursor: pointer;
      border: none;
      background: none;
      font-family: inherit;
    }

    /* ─── ANIMATIONS ─── */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(22px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-16px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes slideInL {
      from {
        opacity: 0;
        transform: translateX(-28px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes slideInR {
      from {
        opacity: 0;
        transform: translateX(28px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(.95)
      }

      to {
        opacity: 1;
        transform: scale(1)
      }
    }

    @keyframes floatBadge {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-6px)
      }
    }

    @keyframes shimmer {
      0% {
        background-position: -200% 0
      }

      100% {
        background-position: 200% 0
      }
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1
      }

      50% {
        opacity: .4
      }
    }

    @keyframes heroKenBurns {
      0% {
        transform: scale(1)
      }

      100% {
        transform: scale(1.06)
      }
    }

    @keyframes scrollHint {

      0%,
      100% {
        transform: translateY(0);
        opacity: 1
      }

      50% {
        transform: translateY(6px);
        opacity: .4
      }
    }

    @keyframes counterUp {
      from {
        opacity: 0;
        transform: translateY(8px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    /* ─── HERO ─── */
    .hero-section {
      position: relative;
      height: 100dvh;
      min-height: 600px;
      max-height: 900px;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      animation: heroKenBurns 18s ease-in-out infinite alternate;
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(170deg, rgba(129, 88, 84, .52) 0%, rgba(40, 18, 16, .82) 100%);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      padding: 20px;
      max-width: 780px;
      width: 100%;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 50px;
      padding: 5px 16px;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .85);
      margin-bottom: 20px;
      animation: floatBadge 4s ease-in-out infinite;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2.2rem, 6vw, 4rem);
      font-weight: 600;
      color: #fff;
      line-height: 1.15;
      margin: 0 0 6px;
      animation: fadeInUp .8s cubic-bezier(.16, 1, .3, 1) both;
      animation-delay: .2s;
    }

    .hero-title em {
      font-style: italic;
      color: #F0D5C0;
    }

    .hero-subtitle {
      font-family: 'DM Sans', sans-serif;
      font-size: clamp(.76rem, 1.5vw, .88rem);
      color: rgba(255, 255, 255, .58);
      margin: 14px auto 0;
      max-width: 440px;
      line-height: 1.85;
      animation: fadeInUp .8s cubic-bezier(.16, 1, .3, 1) both;
      animation-delay: .35s;
    }

    .hero-cta-row {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
      margin-top: 30px;
      animation: fadeInUp .8s cubic-bezier(.16, 1, .3, 1) both;
      animation-delay: .5s;
    }

    .btn-hero-primary {
      padding: 12px 28px;
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: #fff;
      background: #815854;
      border-radius: 50px;
      box-shadow: 0 4px 20px rgba(129, 88, 84, .35);
      transition: transform .2s, box-shadow .2s, background .2s;
    }

    .btn-hero-primary:hover {
      background: #6b4644;
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(129, 88, 84, .42);
    }

    .btn-hero-ghost {
      padding: 12px 28px;
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: #fff;
      border: 1.5px solid rgba(255, 255, 255, .35);
      border-radius: 50px;
      transition: background .2s, border-color .2s, transform .2s;
    }

    .btn-hero-ghost:hover {
      background: rgba(255, 255, 255, .1);
      border-color: rgba(255, 255, 255, .6);
      transform: translateY(-2px);
    }

    .hero-scroll {
      position: absolute;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 3;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 6px;
    }

    .hero-scroll-dot {
      width: 24px;
      height: 38px;
      border: 1.5px solid rgba(255, 255, 255, .3);
      border-radius: 50px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding-top: 6px;
    }

    .hero-scroll-dot::after {
      content: '';
      width: 4px;
      height: 8px;
      background: rgba(255, 255, 255, .6);
      border-radius: 2px;
      animation: scrollHint 1.8s ease-in-out infinite;
    }

    .hero-scroll-txt {
      font-size: .55rem;
      font-weight: 600;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .35);
    }

    /* Hero image strip */
    .hero-img-strip {
      position: absolute;
      bottom: 0;
      right: 0;
      display: flex;
      gap: 6px;
      padding: 14px;
      z-index: 3;
    }

    .strip-thumb {
      width: 70px;
      height: 70px;
      border-radius: 10px;
      overflow: hidden;
      border: 2px solid rgba(255, 255, 255, .2);
      cursor: pointer;
      transition: all .25s;
    }

    .strip-thumb:hover {
      transform: scale(1.06);
      border-color: rgba(255, 255, 255, .5);
    }

    .strip-thumb img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media(max-width:600px) {
      .hero-img-strip {
        display: none;
      }
    }

    /* ─── QUICK BOOKING BAR ─── */
    .booking-bar {
      background: #fff;
      border-radius: 18px;
      padding: 22px 26px;
      box-shadow: 0 8px 32px rgba(107, 70, 68, .14);
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      align-items: flex-end;
      animation: fadeInUp .6s cubic-bezier(.16, 1, .3, 1) both;
      animation-delay: .1s;
    }

    .bb-field {
      flex: 1;
      min-width: 160px;
    }

    .bb-label {
      font-size: .55rem;
      font-weight: 700;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: #b09080;
      display: block;
      margin-bottom: 6px;
    }

    .bb-input {
      width: 100%;
      padding: 9px 12px;
      font-size: .8rem;
      color: #4a3830;
      background: #fdf8f5;
      border: 1.5px solid #F0D5C0;
      border-radius: 9px;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .bb-input:focus {
      border-color: #815854;
      box-shadow: 0 0 0 3px rgba(129, 88, 84, .1);
    }

    .bb-btn {
      padding: 9px 24px;
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: #fff;
      background: #815854;
      border-radius: 9px;
      white-space: nowrap;
      box-shadow: 0 3px 12px rgba(129, 88, 84, .25);
      transition: all .2s;
    }

    .bb-btn:hover {
      background: #6b4644;
      transform: translateY(-1px);
      box-shadow: 0 5px 18px rgba(129, 88, 84, .32);
    }

    /* ─── SECTION SHARED ─── */
    .section-label {
      font-size: .58rem;
      font-weight: 700;
      letter-spacing: .26em;
      text-transform: uppercase;
      color: #815854;
      margin: 0 0 10px;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.4rem, 3vw, 2rem);
      font-weight: 600;
      color: #3a2c28;
      line-height: 1.25;
      margin: 0;
    }

    .section-divider {
      width: 36px;
      height: 2px;
      background: rgba(129, 88, 84, .3);
      border-radius: 2px;
      margin: 16px 0;
    }

    /* ─── STATS ─── */
    .stat-card {
      text-align: center;
      padding: 22px 16px;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 3px 14px rgba(107, 70, 68, .08);
      transition: box-shadow .2s, transform .2s;
      animation: scaleIn .45s cubic-bezier(.16, 1, .3, 1) both;
    }

    .stat-card:hover {
      box-shadow: 0 6px 22px rgba(107, 70, 68, .12);
      transform: translateY(-2px);
    }

    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 700;
      color: #815854;
      line-height: 1;
    }

    .stat-lbl {
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: #b09080;
      margin-top: 8px;
    }

    /* ─── CATEGORY CARDS ─── */
    .cat-card {
      position: relative;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 18px rgba(107, 70, 68, .1);
      transition: box-shadow .25s, transform .25s;
      animation: fadeInUp .45s cubic-bezier(.16, 1, .3, 1) both;
      cursor: pointer;
    }

    .cat-card:hover {
      box-shadow: 0 10px 32px rgba(107, 70, 68, .18);
      transform: translateY(-4px);
    }

    .cat-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 6s ease;
    }

    .cat-card:hover img {
      transform: scale(1.05);
    }

    .cat-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(0deg, rgba(40, 18, 16, .8) 0%, rgba(129, 88, 84, .15) 60%, transparent 100%);
    }

    .cat-content {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 20px 18px;
    }

    .cat-name {
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-weight: 600;
      color: #fff;
      margin: 0 0 5px;
    }

    .cat-price {
      font-size: .65rem;
      font-weight: 600;
      letter-spacing: .1em;
      color: rgba(249, 235, 222, .7);
    }

    .cat-arrow {
      position: absolute;
      top: 14px;
      right: 14px;
      width: 30px;
      height: 30px;
      background: rgba(255, 255, 255, .15);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s, transform .2s;
    }

    .cat-card:hover .cat-arrow {
      background: rgba(255, 255, 255, .25);
      transform: scale(1.1);
    }

    /* ─── ROOM SLIDER ─── */
    .rooms-track {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      scrollbar-width: none;
      padding-bottom: 8px;
    }

    .rooms-track::-webkit-scrollbar {
      display: none;
    }

    .room-slide {
      flex: 0 0 320px;
      scroll-snap-align: start;
      background: #fff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 3px 16px rgba(107, 70, 68, .09);
      transition: box-shadow .25s, transform .25s;
    }

    .room-slide:hover {
      box-shadow: 0 8px 28px rgba(107, 70, 68, .15);
      transform: translateY(-3px);
    }

    .room-slide-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 5s ease;
    }

    .room-slide:hover .room-slide-img {
      transform: scale(1.04);
    }

    .room-slide-img-wrap {
      overflow: hidden;
    }

    .slider-nav-btn {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: #fff;
      border: 1.5px solid #F0D5C0;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all .2s;
      box-shadow: 0 2px 8px rgba(107, 70, 68, .1);
    }

    .slider-nav-btn:hover {
      background: #815854;
      border-color: #815854;
    }

    .slider-nav-btn:hover svg {
      stroke: #fff;
    }

    /* ─── GALLERY ─── */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-template-rows: repeat(2, 200px);
      gap: 12px;
    }

    .gal-item {
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      cursor: pointer;
    }

    .gal-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 5s ease;
    }

    .gal-item:hover img {
      transform: scale(1.06);
    }

    .gal-item::after {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(129, 88, 84, 0);
      transition: background .25s;
    }

    .gal-item:hover::after {
      background: rgba(129, 88, 84, .12);
    }

    .gal-item:nth-child(1) {
      grid-column: span 2;
      grid-row: span 2;
    }

    .gal-item:nth-child(1) {
      grid-row: span 2;
    }

    /* ─── AMENITIES ─── */
    .amenity-card {
      background: #fff;
      border-radius: 14px;
      padding: 22px 18px;
      box-shadow: 0 3px 14px rgba(107, 70, 68, .07);
      transition: box-shadow .2s, transform .2s;
      animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
    }

    .amenity-card:hover {
      box-shadow: 0 6px 22px rgba(107, 70, 68, .12);
      transform: translateY(-2px);
    }

    .amenity-icon {
      width: 40px;
      height: 40px;
      background: #F9EBDE;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 14px;
    }

    /* ─── TESTIMONIALS ─── */
    .testi-track {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      scrollbar-width: none;
      padding-bottom: 8px;
    }

    .testi-track::-webkit-scrollbar {
      display: none;
    }

    .testi-card {
      flex: 0 0 300px;
      scroll-snap-align: start;
      background: #fff;
      border-radius: 16px;
      padding: 24px 22px;
      box-shadow: 0 3px 16px rgba(107, 70, 68, .08);
    }

    .testi-stars {
      display: flex;
      gap: 3px;
      margin-bottom: 12px;
    }

    .testi-quote {
      font-family: 'Playfair Display', serif;
      font-size: .82rem;
      color: #5a4a44;
      line-height: 1.75;
      margin: 0 0 16px;
      font-style: italic;
    }

    .testi-author {
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: #b09080;
    }

    /* ─── BADGE PILL ─── */
    .room-badge {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 9px;
      font-size: .58rem;
      font-weight: 600;
      background: rgba(129, 88, 84, .09);
      color: #815854;
      border-radius: 50px;
    }

    /* ─── CTA BANNER ─── */
    .cta-banner {
      position: relative;
      overflow: hidden;
      border-radius: 20px;
    }

    .cta-banner-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.55) saturate(1.1);
    }

    .cta-banner-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(120deg, rgba(129, 88, 84, .7) 0%, rgba(40, 18, 16, .75) 100%);
    }

    .cta-banner-content {
      position: relative;
      z-index: 2;
      padding: 52px 40px;
      text-align: center;
    }

    /* Responsive */
    @media(max-width:900px) {
      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: auto;
      }

      .gal-item:nth-child(1) {
        grid-column: span 2;
        grid-row: span 1;
      }
    }

    @media(max-width:600px) {
      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: auto;
      }

      .gal-item:nth-child(1) {
        grid-column: span 2;
      }

      .booking-bar {
        flex-direction: column;
      }

      .bb-field {
        min-width: 100%;
      }
    }
  </style>

  <!-- Existing JS (untouched) -->
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/responsiveslides.min.js"></script>
  <script>
    $(function() {
      $("#slider").responsiveSlides({
        auto: true,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        pager: true
      });
    });
  </script>
</head>

<body>

  <header><?php include_once('includes/header.php'); ?></header>

  <!-- ═══════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════ -->
  <section class="hero-section">
    <img class="hero-img"
      src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=1800&q=85&auto=format&fit=crop"
      alt="Sea Horizon Hotel aerial view" width="1800" height="1200" loading="eager"
      onerror="this.style.background='#815854'">
    <div class="hero-overlay"></div>

    <div class="hero-content">
      <div class="hero-badge">
        <svg width="8" height="8" viewBox="0 0 24 24" fill="#F0D5C0">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
        </svg>
        Sea Horizon Hotel · Est. 2010
        <svg width="8" height="8" viewBox="0 0 24 24" fill="#F0D5C0">
          <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
        </svg>
      </div>

      <h1 class="hero-title">
        A sea view, a quiet room<br>
        and <em>breakfast worth waking up for.</em>
      </h1>

      <p class="hero-subtitle">
        We've been looking after guests since 2010. Not with grand promises — just good rooms, real food, and staff who actually care.
      </p>

      <div class="hero-cta-row">
        <a href="services.php" class="btn-hero-primary">
          Browse Our Rooms
        </a>
        <a href="about.php" class="btn-hero-ghost">
          Our Story
        </a>
      </div>
    </div>

    <!-- Thumbnail strip bottom-right -->
    <div class="hero-img-strip">
      <?php
      $strip_imgs = [
        ['https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=200&q=70&auto=format&fit=crop', 'Sea view room'],
        ['https://images.unsplash.com/photo-1582719508461-905c673771fd?w=200&q=70&auto=format&fit=crop', 'Spa & pool'],
        ['https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=200&q=70&auto=format&fit=crop', 'Breakfast spread'],
      ];
      foreach ($strip_imgs as $si): ?>
        <div class="strip-thumb">
          <img src="<?= $si[0] ?>" alt="<?= $si[1] ?>" width="70" height="70" loading="lazy">
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Scroll hint -->
    <div class="hero-scroll">
      <div class="hero-scroll-dot"></div>
      <span class="hero-scroll-txt">Scroll</span>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     QUICK BOOKING BAR
═══════════════════════════════════════ -->
  <div style="padding:0 20px;position:relative;z-index:10;max-width:900px;margin:-36px auto 0;">
    <div class="booking-bar">
      <div class="bb-field">
        <label class="bb-label">
          <svg width="10" height="10" fill="none" stroke="#b09080" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" style="display:inline;vertical-align:middle;margin-right:4px;">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="3" y1="10" x2="21" y2="10" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="16" y1="2" x2="16" y2="6" />
          </svg>
          Check-in
        </label>
        <input type="date" class="bb-input" min="<?php echo date('Y-m-d'); ?>" id="bb-checkin">
      </div>
      <div class="bb-field">
        <label class="bb-label">
          <svg width="10" height="10" fill="none" stroke="#b09080" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" style="display:inline;vertical-align:middle;margin-right:4px;">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="3" y1="10" x2="21" y2="10" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="16" y1="2" x2="16" y2="6" />
          </svg>
          Check-out
        </label>
        <input type="date" class="bb-input" min="<?php echo date('Y-m-d'); ?>" id="bb-checkout">
      </div>
      <div class="bb-field" style="max-width:160px;">
        <label class="bb-label">
          <svg width="10" height="10" fill="none" stroke="#b09080" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" style="display:inline;vertical-align:middle;margin-right:4px;">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
          </svg>
          Guests
        </label>
        <select class="bb-input">
          <option>1 Guest</option>
          <option>2 Guests</option>
          <option>3 Guests</option>
          <option>4+ Guests</option>
        </select>
      </div>
      <a href="services.php" class="bb-btn" style="display:inline-flex;align-items:center;gap:7px;">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
          <circle cx="11" cy="11" r="8" />
          <path d="M21 21l-4.35-4.35" />
        </svg>
        Check Availability
      </a>
    </div>
  </div>

  <!-- ═══════════════════════════════════════
     STATS STRIP
═══════════════════════════════════════ -->
  <section style="padding:60px 20px 48px;">
    <div style="max-width:860px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
      <?php
      $stats = [
        ['15+', 'Years Running'],
        ['40+', 'Room Types'],
        ['3k+', 'Happy Guests'],
        ['24/7', 'Front Desk'],
      ];
      foreach ($stats as $i => $s): ?>
        <div class="stat-card" style="animation-delay:<?= $i * 0.08 ?>s;">
          <div class="stat-num"><?= $s[0] ?></div>
          <div class="stat-lbl"><?= $s[1] ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     ROOM CATEGORIES
═══════════════════════════════════════ -->
  <section style="padding:8px 20px 64px;">
    <div style="max-width:1100px;margin:0 auto;">
      <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
          <p class="section-label">What We've Got</p>
          <h2 class="section-title">Room Categories</h2>
          <div class="section-divider"></div>
        </div>
        <a href="services.php" style="display:inline-flex;align-items:center;gap:7px;font-size:.66rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;padding:7px 16px;border:1.5px solid rgba(129,88,84,.25);border-radius:8px;transition:all .2s;"
          onmouseover="this.style.background='#815854';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='#815854'">
          All Rooms
          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </a>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px;">
        <?php
        $cat_imgs = [
          'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=700&q=80&auto=format&fit=crop',
        ];
        $sql = "SELECT * from tblcategory";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $ci = 0;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) {
            $img = $cat_imgs[$ci % count($cat_imgs)];
            $ci++;
        ?>
            <a href="category-details.php?catid=<?php echo htmlentities($row->ID); ?>" class="cat-card" style="animation-delay:<?= ($ci - 1) * 0.07 ?>s;">
              <img src="<?= $img ?>" alt="<?php echo htmlentities($row->CategoryName); ?>" width="700" height="440" loading="lazy">
              <div class="cat-overlay"></div>
              <div class="cat-content">
                <h3 class="cat-name"><?php echo htmlentities($row->CategoryName); ?></h3>
                <?php if (!empty($row->Price)): ?>
                  <p class="cat-price">From $<?php echo htmlentities($row->Price); ?>/night</p>
                <?php else: ?>
                  <p class="cat-price">View availability →</p>
                <?php endif; ?>
              </div>
              <div class="cat-arrow">
                <svg width="12" height="12" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round">
                  <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
              </div>
            </a>
          <?php }
        } else { ?>
          <?php foreach ($cat_imgs as $i => $img): ?>
            <div class="cat-card" style="animation-delay:<?= $i * 0.07 ?>s;">
              <img src="<?= $img ?>" alt="Hotel room" width="700" height="440" loading="lazy">
              <div class="cat-overlay"></div>
              <div class="cat-content">
                <h3 class="cat-name">Deluxe Category</h3>
                <p class="cat-price">From $99/night</p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     ABOUT STRIP — Two column
═══════════════════════════════════════ -->
  <section style="background:#fff;padding:72px 20px;border-top:1px solid #F0D5C0;border-bottom:1px solid #F0D5C0;">
    <div style="max-width:960px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:60px;align-items:center;">
      <div style="animation:slideInL .6s cubic-bezier(.16,1,.3,1) both;">
        <p class="section-label">About Sea Horizon</p>
        <h2 class="section-title">We've been doing this for fifteen years.<br><em style="font-style:italic;color:#815854;">Still enjoying it.</em></h2>
        <div class="section-divider"></div>
        <?php
        $sql2 = "SELECT * from tblpage where PageType='aboutus' LIMIT 1";
        $q2 = $dbh->prepare($sql2);
        $q2->execute();
        $r2 = $q2->fetchAll(PDO::FETCH_OBJ);
        if ($q2->rowCount() > 0) {
          foreach ($r2 as $ab) { ?>
            <p style="font-size:.78rem;color:#7a6860;line-height:1.9;margin:0 0 22px;"><?php echo htmlentities(substr($ab->PageDescription, 0, 360)); ?>...</p>
          <?php }
        } else { ?>
          <p style="font-size:.78rem;color:#7a6860;line-height:1.9;margin:0 0 22px;">Sea Horizon started with a simple idea — make people feel genuinely welcome, not just checked in. We're a family hotel, built on the coast, and we've kept that feeling going for fifteen years now.</p>
        <?php } ?>

        <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:26px;">
          <?php foreach (['Sea-facing rooms', 'Free breakfast', 'Spa & pool', '24hr desk', 'Free Wi-Fi', 'Airport shuttle'] as $feat): ?>
            <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-size:.62rem;font-weight:600;background:#F9EBDE;color:#815854;border-radius:50px;">
              <svg width="9" height="9" viewBox="0 0 24 24" fill="#815854">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <?= $feat ?>
            </span>
          <?php endforeach; ?>
        </div>

        <a href="about.php" style="display:inline-flex;align-items:center;gap:8px;padding:10px 24px;font-size:.66rem;font-weight:700;letter-spacing:.13em;text-transform:uppercase;color:#fff;background:#815854;border-radius:9px;box-shadow:0 3px 14px rgba(129,88,84,.28);transition:all .2s;"
          onmouseover="this.style.background='#6b4644';this.style.transform='translateY(-1px)'" onmouseout="this.style.background='#815854';this.style.transform='translateY(0)'">
          Read Our Story
          <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M5 12h14M12 5l7 7-7 7" />
          </svg>
        </a>
      </div>

      <div style="animation:slideInR .6s cubic-bezier(.16,1,.3,1) both;animation-delay:.1s;display:grid;grid-template-rows:auto auto;gap:12px;">
        <div style="border-radius:16px;overflow:hidden;box-shadow:0 6px 28px rgba(107,70,68,.12);">
          <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=900&q=80&auto=format&fit=crop"
            alt="Sea Horizon Hotel exterior" width="900" height="540" loading="lazy"
            style="width:100%;height:240px;object-fit:cover;display:block;" onerror="this.style.display='none'">
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
          <div style="border-radius:14px;overflow:hidden;box-shadow:0 3px 14px rgba(107,70,68,.1);">
            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=500&q=80&auto=format&fit=crop"
              alt="Hotel breakfast" width="500" height="400" loading="lazy"
              style="width:100%;height:130px;object-fit:cover;display:block;" onerror="this.style.display='none'">
          </div>
          <div style="border-radius:14px;overflow:hidden;box-shadow:0 3px 14px rgba(107,70,68,.1);">
            <img src="https://images.unsplash.com/photo-1615460549969-36fa19521a4f?w=500&q=80&auto=format&fit=crop"
              alt="Hotel pool" width="500" height="400" loading="lazy"
              style="width:100%;height:130px;object-fit:cover;display:block;" onerror="this.style.display='none'">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     FEATURED ROOMS SLIDER
═══════════════════════════════════════ -->
  <section style="padding:72px 20px 64px;">
    <div style="max-width:1100px;margin:0 auto;">
      <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
          <p class="section-label">Pick Your Room</p>
          <h2 class="section-title">Rooms We're Proud Of</h2>
          <div class="section-divider"></div>
        </div>
        <div style="display:flex;gap:8px;">
          <button class="slider-nav-btn" id="rooms-prev" aria-label="Previous rooms">
            <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button class="slider-nav-btn" id="rooms-next" aria-label="Next rooms">
            <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

      <div class="rooms-track" id="rooms-track">
        <?php
        $fallback_imgs = [
          'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=700&q=80&auto=format&fit=crop',
        ];
        $sql3 = "SELECT tblroom.*,tblcategory.CategoryName,tblcategory.Price from tblroom join tblcategory on tblroom.RoomType=tblcategory.ID";
        $query3 = $dbh->prepare($sql3);
        $query3->execute();
        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
        $ri = 0;
        if ($query3->rowCount() > 0) {
          foreach ($results3 as $room) {
            $fb = $fallback_imgs[$ri % count($fallback_imgs)];
            $ri++;
        ?>
            <div class="room-slide">
              <div class="room-slide-img-wrap">
                <img class="room-slide-img"
                  src="admin/images/<?php echo htmlentities($room->Image); ?>"
                  alt="<?php echo htmlentities($room->RoomName); ?>"
                  width="700" height="400" loading="lazy"
                  onerror="this.src='<?= $fb ?>'">
              </div>
              <div style="padding:18px;">
                <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:10px;gap:8px;">
                  <h3 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#3a2c28;margin:0;line-height:1.3;"><?php echo htmlentities($room->RoomName); ?></h3>
                  <div style="flex-shrink:0;text-align:right;">
                    <span style="font-family:'Playfair Display',serif;font-size:1rem;font-weight:700;color:#815854;">$<?php echo htmlentities($room->Price); ?></span>
                    <span style="font-size:.58rem;color:#b09080;display:block;">/night</span>
                  </div>
                </div>

                <span style="display:inline-block;font-size:.58rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;background:rgba(129,88,84,.09);padding:2px 9px;border-radius:50px;margin-bottom:10px;"><?php echo htmlentities($room->CategoryName); ?></span>

                <p style="font-size:.72rem;color:#7a6860;line-height:1.7;margin:0 0 14px;"><?php echo htmlentities(substr($room->RoomDesc, 0, 85)); ?>...</p>

                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:16px;">
                  <span class="room-badge">
                    <svg width="9" height="9" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24">
                      <path stroke-linecap="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo $room->MaxAdult; ?> Adult · <?php echo $room->MaxChild; ?> Child
                  </span>
                  <span class="room-badge">
                    <svg width="9" height="9" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24">
                      <path stroke-linecap="round" d="M3 12l9-9 9 9M5 10v10h4v-6h6v6h4V10" />
                    </svg>
                    <?php echo $room->NoofBed; ?> Bed(s)
                  </span>
                </div>

                <a href="category-details.php?catid=<?php echo htmlentities($room->RoomType); ?>"
                  style="display:flex;align-items:center;justify-content:center;gap:7px;padding:9px 16px;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;border:1.5px solid rgba(129,88,84,.28);border-radius:8px;transition:all .2s;width:100%;"
                  onmouseover="this.style.background='#815854';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='#815854'">
                  Book This Room
                  <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                  </svg>
                </a>
              </div>
            </div>
          <?php
          }
        } else {
          foreach ($fallback_imgs as $i => $fimg): ?>
            <div class="room-slide">
              <div class="room-slide-img-wrap">
                <img class="room-slide-img" src="<?= $fimg ?>" alt="Hotel room" width="700" height="400" loading="lazy">
              </div>
              <div style="padding:18px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#3a2c28;margin:0 0 10px;">Deluxe Room <?= $i + 1 ?></h3>
                <p style="font-size:.72rem;color:#7a6860;margin:0 0 14px;line-height:1.7;">A spacious, well-lit room with a view of the sea and everything you need for a comfortable stay.</p>
                <a href="services.php" style="display:flex;align-items:center;justify-content:center;gap:7px;padding:9px 16px;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;border:1.5px solid rgba(129,88,84,.28);border-radius:8px;width:100%;">Book This Room</a>
              </div>
            </div>
        <?php endforeach;
        } ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     AMENITIES / FACILITIES
═══════════════════════════════════════ -->
  <section style="background:#fff;padding:64px 20px;border-top:1px solid #F0D5C0;">
    <div style="max-width:1000px;margin:0 auto;">
      <div style="text-align:center;margin-bottom:40px;">
        <p class="section-label">What You Get</p>
        <h2 class="section-title">Things guests actually notice.</h2>
        <div class="section-divider" style="margin:16px auto;"></div>
        <p style="font-size:.76rem;color:#9a7c74;max-width:380px;margin:0 auto;line-height:1.8;">Not a laundry list of features nobody uses. Just the things that made people come back.</p>
      </div>

      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;">
        <?php
        $amenities = [
          ['M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.14 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0', 'Wi-Fi Everywhere', 'Even in the pool area. Yes, really.'],
          ['M12 3v1m0 16v1m9-9h-1M4 12H3m3.343-5.657L5.93 5.93m12.728 0l-1.414 1.414M17.657 17.657l-1.414-1.414M6.343 17.657L4.93 19.07M12 8a4 4 0 110 8 4 4 0 010-8z', '24hr Reception', 'Front desk doesn\'t sleep. Neither does the coffee.'],
          ['M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'Daily Housekeeping', 'Fresh linen, fresh room, every single day.'],
          ['M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064', 'Infinity Pool', 'Heated. No kids allowed after 8pm.'],
          ['M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'Restaurant', 'Open 7am to 11pm. Breakfast is the highlight.'],
          ['M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'Spa & Wellness', 'Book a slot. You won\'t regret it.'],
          ['M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'Airport Pickup', 'Just message us. We\'ll sort the rest.'],
          ['M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'Sea View Rooms', 'Not every room, but most of them face the water.'],
        ];
        foreach ($amenities as $i => $a): ?>
          <div class="amenity-card" style="animation-delay:<?= $i * 0.06 ?>s;">
            <div class="amenity-icon">
              <svg width="18" height="18" fill="none" stroke="#815854" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round">
                <path d="<?= $a[0] ?>" />
              </svg>
            </div>
            <h3 style="font-family:'Playfair Display',serif;font-size:.82rem;font-weight:600;color:#3a2c28;margin:0 0 6px;"><?= $a[1] ?></h3>
            <p style="font-size:.68rem;color:#9a7c74;line-height:1.65;margin:0;"><?= $a[2] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     GALLERY SLIDER
═══════════════════════════════════════ -->
  <section style="padding:72px 20px 64px;">
    <div style="max-width:1100px;margin:0 auto;">
      <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
          <p class="section-label">Take a Look</p>
          <h2 class="section-title">What Sea Horizon Looks Like</h2>
          <div class="section-divider"></div>
        </div>
        <a href="gallery.php" style="display:inline-flex;align-items:center;gap:6px;font-size:.64rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;padding:7px 16px;border:1.5px solid rgba(129,88,84,.25);border-radius:8px;transition:all .2s;"
          onmouseover="this.style.background='#815854';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='#815854'">
          Full Gallery →
        </a>
      </div>

      <!-- Masonry-style gallery grid -->
      <div class="gallery-grid">
        <?php
        $gal_imgs = [
          ['https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=900&q=80&auto=format&fit=crop', 'Hotel lobby entrance'],
          ['https://images.unsplash.com/photo-1582719508461-905c673771fd?w=600&q=80&auto=format&fit=crop', 'Deluxe bedroom'],
          ['https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80&auto=format&fit=crop', 'Morning breakfast'],
          ['https://images.unsplash.com/photo-1615460549969-36fa19521a4f?w=600&q=80&auto=format&fit=crop', 'Infinity pool'],
          ['https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=600&q=80&auto=format&fit=crop', 'Spa treatment room'],
        ];
        foreach ($gal_imgs as $gi => $gimg): ?>
          <div class="gal-item" style="animation:scaleIn .45s cubic-bezier(.16,1,.3,1) both;animation-delay:<?= $gi * 0.07 ?>s;">
            <img src="<?= $gimg[0] ?>" alt="<?= $gimg[1] ?>" width="900" height="600" loading="lazy" onerror="this.style.display='none'">
            <div style="position:absolute;inset:0;display:flex;align-items:flex-end;padding:14px;opacity:0;transition:opacity .25s;" class="gal-caption">
              <span style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:600;color:#fff;background:rgba(0,0,0,.4);padding:4px 10px;border-radius:6px;backdrop-filter:blur(4px);"><?= $gimg[1] ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <style>
        .gal-item:hover .gal-caption {
          opacity: 1;
        }
      </style>

      <!-- Gallery Scroll Strip -->
      <div style="margin-top:14px;display:flex;gap:10px;overflow-x:auto;scrollbar-width:none;padding-bottom:4px;" id="gal-strip">
        <?php
        $gal_strip = [
          'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=300&q=70&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1615460549969-36fa19521a4f?w=300&q=70&auto=format&fit=crop',
        ];
        foreach ($gal_strip as $gs): ?>
          <div style="flex:0 0 100px;height:70px;border-radius:9px;overflow:hidden;cursor:pointer;transition:transform .2s;flex-shrink:0;"
            onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            <img src="<?= $gs ?>" alt="Gallery photo" width="300" height="200" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════ -->
  <section style="background:#fff;padding:64px 20px;border-top:1px solid #F0D5C0;border-bottom:1px solid #F0D5C0;">
    <div style="max-width:1100px;margin:0 auto;">
      <div style="text-align:center;margin-bottom:36px;">
        <p class="section-label">What Guests Say</p>
        <h2 class="section-title">Straight from the people who stayed.</h2>
        <div class="section-divider" style="margin:16px auto;"></div>
      </div>

      <div class="testi-track" id="testi-track">
        <?php
        $testimonials = [
          ['Stayed three nights, left wishing it was five. The staff just remember who you are — your name, your coffee order. It\'s a bit uncanny, honestly.', 'Riya M.', 'Mumbai · Stayed March 2025'],
          ['The breakfast alone is worth booking for. Real food, not that sad sad buffet stuff. The sea view room was everything we hoped it\'d be.', 'Karan & Priya S.', 'Pune · Honeyseahorizon Stay'],
          ['Came for two days, ended up extending to five. The pool, the spa, the silence — you just don\'t want to leave.', 'Ananya T.', 'Bangalore · Solo Trip'],
          ['The room was spotless every single day. Front desk picked up at 2am when we needed extra pillows. No fuss, just sorted it.', 'Dev R.', 'Delhi · Family Vacation'],
          ['Booked the sea-view suite for our anniversary. Woke up to the sound of waves. The hotel left a small surprise in the room — didn\'t expect that.', 'Mehul & Sara P.', 'Surat · Anniversary Stay'],
          ['Best hotel I\'ve stayed at in years. The spa was incredible and the staff genuinely seem to enjoy their jobs, which makes a huge difference.', 'Tanvi K.', 'Chennai · Business Trip'],
        ];
        foreach ($testimonials as $ti => $t): ?>
          <div class="testi-card" style="animation:fadeInUp .4s cubic-bezier(.16,1,.3,1) both;animation-delay:<?= $ti * 0.07 ?>s;">
            <div class="testi-stars">
              <?php for ($s = 0; $s < 5; $s++): ?>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="#d97706">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
              <?php endfor; ?>
            </div>
            <p class="testi-quote">"<?= $t[0] ?>"</p>
            <div style="display:flex;align-items:center;gap:10px;">
              <div style="width:32px;height:32px;border-radius:50%;background:rgba(129,88,84,.15);display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-size:.82rem;font-weight:700;color:#815854;">
                <?= strtoupper(substr($t[1], 0, 1)) ?>
              </div>
              <div>
                <p class="testi-author"><?= $t[1] ?></p>
                <p style="font-size:.58rem;color:#c9b0a8;margin:2px 0 0;"><?= $t[2] ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════ -->
  <section style="padding:64px 20px;">
    <div style="max-width:960px;margin:0 auto;">
      <div class="cta-banner" style="min-height:300px;">
        <img class="cta-banner-img"
          src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1400&q=80&auto=format&fit=crop"
          alt="Sea Horizon Hotel pool deck" width="1400" height="700" loading="lazy"
          onerror="this.style.display='none'">
        <div class="cta-banner-overlay"></div>
        <div class="cta-banner-content" style="animation:fadeInUp .5s cubic-bezier(.16,1,.3,1) both;">
          <p style="font-size:.6rem;font-weight:700;letter-spacing:.28em;text-transform:uppercase;color:rgba(249,235,222,.5);margin:0 0 12px;">Ready When You Are</p>
          <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.5rem,4vw,2.4rem);font-weight:600;color:#fff;margin:0 0 14px;line-height:1.25;">
            You've been thinking about a break.<br>
            <em style="color:#F0D5C0;font-style:italic;">This is the sign.</em>
          </h2>
          <p style="font-size:.76rem;color:rgba(255,255,255,.55);margin:0 auto 28px;max-width:380px;line-height:1.8;">Rooms fill up faster than you'd expect, especially on weekends. Have a look at what's available.</p>
          <div style="display:flex;flex-wrap:wrap;gap:12px;justify-content:center;">
            <a href="services.php" style="padding:11px 28px;font-size:.66rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#3a2c28;background:#F9EBDE;border-radius:50px;transition:all .2s;box-shadow:0 4px 16px rgba(0,0,0,.2);"
              onmouseover="this.style.background='#fff'" onmouseout="this.style.background='#F9EBDE'">
              Browse Rooms
            </a>
            <a href="contact.php" style="padding:11px 28px;font-size:.66rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#fff;border:1.5px solid rgba(255,255,255,.35);border-radius:50px;transition:all .2s;"
              onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'">
              Ask Us Anything
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
     QUICK CONTACT INFO STRIP
═══════════════════════════════════════ -->
  <section style="background:#fff;border-top:1px solid #F0D5C0;padding:28px 20px;">
    <div style="max-width:960px;margin:0 auto;display:flex;flex-wrap:wrap;gap:24px;align-items:center;justify-content:space-between;">
      <div style="display:flex;align-items:center;gap:9px;">
        <div style="width:36px;height:36px;background:#F9EBDE;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="none" stroke="#815854" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
        </div>
        <div>
          <p style="font-size:.55rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0;">Call Us</p>
          <?php
          $sql_c = "SELECT MobileNumber from tblpage where PageType='contactus' LIMIT 1";
          $qc = $dbh->prepare($sql_c);
          $qc->execute();
          $rc = $qc->fetchAll(PDO::FETCH_OBJ);
          $phone = '+91 98765 43210';
          if ($qc->rowCount() > 0) {
            foreach ($rc as $r) {
              $phone = '+' . $r->MobileNumber;
            }
          }
          ?>
          <p style="font-size:.78rem;font-weight:600;color:#3a2c28;margin:3px 0 0;"><?= $phone ?></p>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:9px;">
        <div style="width:36px;height:36px;background:#F9EBDE;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="none" stroke="#815854" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
        </div>
        <div>
          <p style="font-size:.55rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0;">Email Us</p>
          <p style="font-size:.78rem;font-weight:600;color:#3a2c28;margin:3px 0 0;">hotelseahorizon@gmail.com</p>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:9px;">
        <div style="width:36px;height:36px;background:#F9EBDE;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
          <svg width="15" height="15" fill="none" stroke="#815854" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round">
            <circle cx="12" cy="12" r="10" />
            <polyline points="12 6 12 12 16 14" />
          </svg>
        </div>
        <div>
          <p style="font-size:.55rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0;">Open Hours</p>
          <p style="font-size:.78rem;font-weight:600;color:#3a2c28;margin:3px 0 0;">Front Desk — 24 hrs · Restaurant — 7am–11pm</p>
        </div>
      </div>
      <a href="contact.php" style="padding:9px 22px;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#fff;background:#815854;border-radius:8px;box-shadow:0 3px 12px rgba(129,88,84,.25);transition:all .2s;"
        onmouseover="this.style.background='#6b4644'" onmouseout="this.style.background='#815854'">
        Get in Touch
      </a>
    </div>
  </section>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>

  <!-- ═══════════════════════════════════════
     SLIDER NAVIGATION JS (new — not touching existing)
═══════════════════════════════════════ -->
  <script>
    // Rooms slider prev/next
    (function() {
      var track = document.getElementById('rooms-track');
      if (!track) return;
      document.getElementById('rooms-prev').addEventListener('click', function() {
        track.scrollBy({
          left: -340,
          behavior: 'smooth'
        });
      });
      document.getElementById('rooms-next').addEventListener('click', function() {
        track.scrollBy({
          left: 340,
          behavior: 'smooth'
        });
      });
    })();
  </script>

  <style>
    @media(max-width:768px) {
      .hero-title {
        font-size: clamp(1.8rem, 5vw, 2.4rem) !important;
      }

      section>div>div[style*="grid-template-columns:1fr 1fr"] {
        grid-template-columns: 1fr !important;
      }

      .stat-num {
        font-size: 1.4rem !important;
      }

      .gallery-grid {
        grid-template-rows: auto !important;
      }
    }
  </style>

</body>

</html>