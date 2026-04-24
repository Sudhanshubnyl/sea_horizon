<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Facilities & Rooms</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
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
      -webkit-font-smoothing: antialiased
    }

    /* ── Animations ── */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes slideInL {
      from {
        opacity: 0;
        transform: translateX(-22px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes slideInR {
      from {
        opacity: 0;
        transform: translateX(22px)
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

    @keyframes heroZoom {
      from {
        transform: scale(1)
      }

      to {
        transform: scale(1.06)
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

    @keyframes rowSlide {
      from {
        opacity: 0;
        transform: translateY(14px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    /* ── Page Hero ── */
    .page-hero {
      position: relative;
      overflow: hidden;
      height: 260px;
    }

    .page-hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.62) saturate(1.1);
      animation: heroZoom 10s ease-in-out infinite alternate;
    }

    .page-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(129, 88, 84, .58) 0%, rgba(40, 20, 18, .78) 100%);
    }

    .page-hero-content {
      position: relative;
      z-index: 2;
      padding: 56px 20px 48px;
      text-align: center;
      animation: fadeInUp .7s cubic-bezier(.16, 1, .3, 1) both;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .18);
      border-radius: 50px;
      padding: 4px 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .2em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .8);
      margin-bottom: 14px;
      animation: floatBadge 3.5s ease-in-out infinite;
    }

    .page-hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 5vw, 2.6rem);
      font-weight: 600;
      color: #fff;
      margin: 0;
      line-height: 1.2;
    }

    .page-hero-sub {
      font-family: 'DM Sans', sans-serif;
      font-size: .74rem;
      color: rgba(255, 255, 255, .52);
      margin-top: 12px;
      max-width: 380px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.8;
    }

    .hero-divider {
      width: 36px;
      height: 1.5px;
      background: rgba(249, 235, 222, .32);
      margin: 18px auto 0;
      border-radius: 2px;
    }

    /* ── Section Header ── */
    .section-label {
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .24em;
      text-transform: uppercase;
      color: #815854;
      margin: 0 0 10px;
    }

    .section-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.3rem, 3vw, 1.75rem);
      font-weight: 600;
      color: #3a2c28;
      margin: 0 0 6px;
      line-height: 1.3;
    }

    .section-sub {
      font-family: 'DM Sans', sans-serif;
      font-size: .76rem;
      color: #9a7c74;
      margin: 0;
      line-height: 1.75;
      max-width: 400px;
    }

    .section-rule {
      width: 36px;
      height: 1.5px;
      background: rgba(129, 88, 84, .25);
      border-radius: 2px;
      margin: 18px 0 0;
    }

    /* ── Category Cards ── */
    .cat-card {
      background: #fff;
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 3px 16px rgba(107, 70, 68, .08);
      transition: box-shadow .25s, transform .25s;
      animation: scaleIn .45s cubic-bezier(.16, 1, .3, 1) both;
      display: block;
      text-decoration: none;
    }

    .cat-card:hover {
      box-shadow: 0 10px 32px rgba(107, 70, 68, .16);
      transform: translateY(-4px);
    }

    .cat-card:nth-child(1) {
      animation-delay: 0s
    }

    .cat-card:nth-child(2) {
      animation-delay: .08s
    }

    .cat-card:nth-child(3) {
      animation-delay: .16s
    }

    .cat-card:nth-child(4) {
      animation-delay: .24s
    }

    .cat-card:nth-child(5) {
      animation-delay: .32s
    }

    .cat-card:nth-child(6) {
      animation-delay: .40s
    }

    .cat-card-img {
      width: 100%;
      height: 190px;
      object-fit: cover;
      display: block;
      transition: transform 6s ease;
    }

    .cat-card:hover .cat-card-img {
      transform: scale(1.06);
    }

    .cat-card-body {
      padding: 18px 18px 20px;
    }

    .cat-card-tag {
      font-family: 'DM Sans', sans-serif;
      font-size: .55rem;
      font-weight: 700;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: #b09080;
      margin: 0 0 7px;
    }

    .cat-card-name {
      font-family: 'Playfair Display', serif;
      font-size: .95rem;
      font-weight: 600;
      color: #3a2c28;
      margin: 0 0 8px;
      line-height: 1.3;
    }

    .cat-card-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: .72rem;
      color: #7a6860;
      line-height: 1.7;
      margin: 0 0 14px;
    }

    .cat-card-cta {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: #815854;
      transition: gap .2s;
    }

    .cat-card:hover .cat-card-cta {
      gap: 9px;
    }

    .cat-card-price {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      font-weight: 700;
      color: #815854;
    }

    .cat-card-price-lbl {
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      color: #b09080;
    }

    /* ── Facility Rows ── */
    .fac-row {
      background: #fff;
      border-radius: 18px;
      box-shadow: 0 3px 16px rgba(107, 70, 68, .07);
      overflow: hidden;
      margin-bottom: 22px;
      display: flex;
      flex-wrap: wrap;
      transition: box-shadow .25s;
      cursor: default;
      animation: rowSlide .45s cubic-bezier(.16, 1, .3, 1) both;
    }

    .fac-row:hover {
      box-shadow: 0 8px 28px rgba(107, 70, 68, .13);
    }

    .fac-row:nth-child(odd) {
      animation-delay: .05s;
    }

    .fac-row:nth-child(even) {
      animation-delay: .12s;
    }

    .fac-img-wrap {
      flex: 0 0 38%;
      overflow: hidden;
      position: relative;
      min-height: 220px;
    }

    .fac-img-wrap img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 6s ease;
    }

    .fac-row:hover .fac-img-wrap img {
      transform: scale(1.05);
    }

    .fac-num-badge {
      position: absolute;
      top: 14px;
      left: 14px;
      width: 32px;
      height: 32px;
      background: #815854;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(129, 88, 84, .35);
      z-index: 1;
    }

    .fac-num-badge.right {
      left: auto;
      right: 14px;
    }

    .fac-text {
      flex: 1;
      padding: 28px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .fac-label {
      font-family: 'DM Sans', sans-serif;
      font-size: .55rem;
      font-weight: 700;
      letter-spacing: .22em;
      text-transform: uppercase;
      color: #815854;
      margin: 0 0 10px;
    }

    .fac-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 600;
      color: #3a2c28;
      margin: 0 0 10px;
      line-height: 1.3;
    }

    .fac-divider {
      width: 32px;
      height: 1.5px;
      background: rgba(129, 88, 84, .25);
      border-radius: 2px;
      margin: 0 0 14px;
    }

    .fac-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: .76rem;
      color: #7a6860;
      line-height: 1.8;
      margin: 0 0 18px;
    }

    .fac-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      background: #F9EBDE;
      border: 1px solid #F0D5C0;
      border-radius: 50px;
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: #815854;
      width: fit-content;
    }

    /* ── Nav Tabs ── */
    .tab-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 22px;
      font-family: 'DM Sans', sans-serif;
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all .22s cubic-bezier(.16, 1, .3, 1);
    }

    .tab-btn.active {
      background: #815854;
      color: #fff;
      box-shadow: 0 4px 16px rgba(129, 88, 84, .28);
    }

    .tab-btn.inactive {
      background: rgba(129, 88, 84, .08);
      color: #815854;
    }

    .tab-btn.inactive:hover {
      background: rgba(129, 88, 84, .14);
    }

    /* ── Responsive ── */
    @media(max-width:640px) {
      .fac-img-wrap {
        flex: 0 0 100%;
        min-height: 200px;
        position: relative;
      }

      .fac-img-wrap img {
        position: static;
        width: 100%;
        height: 200px;
      }

      .fac-num-badge {
        top: 14px;
        left: 14px !important;
        right: auto !important;
      }

      .page-hero {
        height: 230px;
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

<body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

  <header><?php include_once('includes/header.php'); ?></header>

  <!-- ══ Page Hero ══ -->
  <div class="page-hero">
    <img class="page-hero-img"
      src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1600&q=80&auto=format&fit=crop"
      alt="Sea Horizon Hotel infinity pool" width="1600" height="520" loading="eager"
      onerror="this.style.display='none'">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <div class="hero-badge">
        <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
          <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        What We Offer
      </div>
      <h1 class="page-hero-title">Rooms & Facilities</h1>
      <p class="page-hero-sub">Pick a room, explore what's available — everything you need for a proper stay.</p>
      <div class="hero-divider"></div>
    </div>
  </div>

  <!-- ══ Section Tab Navigation ══ -->
  <div style="background:#fff; border-bottom:1px solid #F0D5C0; padding:16px 20px; position:sticky; top:62px; z-index:40;">
    <div style="max-width:1100px; margin:0 auto; display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
      <button class="tab-btn active" id="tab-rooms" onclick="switchTab('rooms')">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
          <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Room Categories
      </button>
      <button class="tab-btn inactive" id="tab-facilities" onclick="switchTab('facilities')">
        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        Our Facilities
      </button>

      <!-- Right: quick count badges -->
      <div style="margin-left:auto; display:flex; align-items:center; gap:8px;">
        <?php
        $catCount = $dbh->query("SELECT COUNT(*) FROM tblcategory")->fetchColumn();
        $facCount = $dbh->query("SELECT COUNT(*) FROM tblfacility")->fetchColumn();
        ?>
        <span style="font-family:'DM Sans',sans-serif; font-size:.58rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#b09080; background:#F9EBDE; padding:4px 10px; border-radius:50px; border:1px solid #F0D5C0;">
          <?php echo $catCount; ?> Room Types
        </span>
        <span style="font-family:'DM Sans',sans-serif; font-size:.58rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#b09080; background:#F9EBDE; padding:4px 10px; border-radius:50px; border:1px solid #F0D5C0;">
          <?php echo $facCount; ?> Facilities
        </span>
      </div>
    </div>
  </div>

  <!-- ══════════════════════════════════
       SECTION 1: Room Categories
  ═══════════════════════════════════════ -->
  <main id="section-rooms" class="flex-1 py-14">
    <div style="max-width:1100px; margin:0 auto; padding:0 20px;">

      <!-- Section Header -->
      <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:32px; flex-wrap:wrap; gap:12px;">
        <div style="animation:fadeInUp .5s cubic-bezier(.16,1,.3,1) both;">
          <p class="section-label">Browse by Type</p>
          <h2 class="section-title">Room Categories</h2>
          <p class="section-sub">From compact sea-view rooms to full suites — there's something for everyone.</p>
          <div class="section-rule"></div>
        </div>
        <a href="#section-facilities"
          onclick="switchTab('facilities'); return false;"
          style="font-family:'DM Sans',sans-serif; font-size:.62rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#815854; text-decoration:none; padding:7px 16px; border:1.5px solid rgba(129,88,84,.25); border-radius:8px; transition:all .2s; white-space:nowrap;"
          onmouseover="this.style.background='rgba(129,88,84,.07)'" onmouseout="this.style.background='transparent'">
          View Facilities →
        </a>
      </div>

      <!-- Category Cards Grid -->
      <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(280px, 1fr)); gap:22px;">
        <?php
        $sqlCat = "SELECT * FROM tblcategory ORDER BY ID";
        $queryCat = $dbh->prepare($sqlCat);
        $queryCat->execute();
        $categories = $queryCat->fetchAll(PDO::FETCH_OBJ);

        // Hotel room fallback images by index (Unsplash, no local storage)
        $catImages = [
          'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=700&q=80&auto=format&fit=crop',
          'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=700&q=80&auto=format&fit=crop',
        ];

        $catCnt = 0;
        if ($queryCat->rowCount() > 0) {
          foreach ($categories as $cat) {
            $imgSrc = $catImages[$catCnt % count($catImages)];
            $catCnt++;
        ?>
            <a href="category-details.php?catid=<?php echo htmlentities($cat->ID); ?>" class="cat-card">

              <!-- Card Image -->
              <div style="overflow:hidden; position:relative;">
                <img class="cat-card-img"
                  src="<?php echo $imgSrc; ?>"
                  alt="<?php echo htmlentities($cat->CategoryName); ?>"
                  width="700" height="380" loading="lazy"
                  onerror="this.src='https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=700&q=80&auto=format&fit=crop'">

                <!-- Hover Overlay -->
                <div style="position:absolute; inset:0; background:linear-gradient(to top, rgba(129,88,84,.55) 0%, transparent 60%); opacity:0; transition:opacity .3s;" class="cat-overlay"></div>

                <!-- Number Badge -->
                <div style="position:absolute; top:12px; left:12px; width:28px; height:28px; background:#815854; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(129,88,84,.4);">
                  <span style="font-family:'Playfair Display',serif; font-size:.68rem; font-weight:700; color:#fff;"><?php echo $catCnt; ?></span>
                </div>
              </div>

              <!-- Card Body -->
              <div class="cat-card-body">
                <p class="cat-card-tag">Room Category</p>
                <h3 class="cat-card-name"><?php echo htmlentities($cat->CategoryName); ?></h3>
                <p class="cat-card-desc">
                  <?php echo htmlentities(substr($cat->Description, 0, 88)); ?>...
                </p>

                <!-- Price + CTA Row -->
                <div style="display:flex; align-items:center; justify-content:space-between; padding-top:12px; border-top:1px solid #F0D5C0;">
                  <div>
                    <span class="cat-card-price">$<?php echo htmlentities($cat->Price); ?></span>
                    <span class="cat-card-price-lbl"> / night</span>
                  </div>
                  <span class="cat-card-cta">
                    Book Now
                    <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24" stroke-linecap="round">
                      <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                  </span>
                </div>
              </div>
            </a>
          <?php }
        } else { ?>
          <!-- Empty State: Categories -->
          <div style="grid-column:1/-1; padding:60px 20px; text-align:center;">
            <div style="width:52px; height:52px; background:#F9EBDE; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
              <svg width="22" height="22" fill="none" stroke="#815854" stroke-width="1.4" viewBox="0 0 24 24" stroke-linecap="round" style="opacity:.35;">
                <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
            </div>
            <p style="font-family:'Playfair Display',serif; font-size:.9rem; color:#5a4a44; margin:0 0 7px;">No room categories yet.</p>
            <p style="font-family:'DM Sans',sans-serif; font-size:.72rem; color:#b09080; margin:0;">The team's still setting things up — check back soon.</p>
          </div>
        <?php } ?>
      </div>

    </div>
  </main>

  <!-- ══════════════════════════════════
       SECTION 2: Facilities
  ═══════════════════════════════════════ -->
  <section id="section-facilities" style="display:none; padding:56px 0 64px; background:#F9EBDE;">
    <div style="max-width:960px; margin:0 auto; padding:0 20px;">

      <!-- Section Header -->
      <div style="margin-bottom:36px; animation:fadeInUp .5s cubic-bezier(.16,1,.3,1) both;">
        <p class="section-label">What's Included</p>
        <h2 class="section-title">Hotel Facilities</h2>
        <p class="section-sub">Everything we've put in place so your stay isn't just comfortable — it's genuinely enjoyable.</p>
        <div class="section-rule"></div>
      </div>

      <!-- Facilities Alternating List -->
      <?php
      $sqlFac = "SELECT * FROM tblfacility";
      $queryFac = $dbh->prepare($sqlFac);
      $queryFac->execute();
      $facilities = $queryFac->fetchAll(PDO::FETCH_OBJ);
      $facCnt = 1;

      if ($queryFac->rowCount() > 0) {
        foreach ($facilities as $fac) {
          $isEven = ($facCnt % 2 == 0);
      ?>
          <div class="fac-row" style="flex-direction:<?php echo $isEven ? 'row-reverse' : 'row'; ?>;">

            <!-- Image -->
            <div class="fac-img-wrap">
              <img src="admin/images/<?php echo $fac->Image; ?>"
                alt="<?php echo htmlentities($fac->FacilityTitle); ?>"
                width="600" height="400" loading="lazy"
                onerror="this.style.background='#F9EBDE'; this.style.display='none'">

              <!-- Number Badge -->
              <div class="fac-num-badge <?php echo $isEven ? 'right' : ''; ?>">
                <span style="font-family:'Playfair Display',serif; font-size:.72rem; font-weight:700; color:#fff; line-height:1;"><?php echo $facCnt; ?></span>
              </div>
            </div>

            <!-- Text -->
            <div class="fac-text" style="animation:<?php echo $isEven ? 'slideInR' : 'slideInL'; ?> .5s cubic-bezier(.16,1,.3,1) both;">
              <p class="fac-label">Hotel Facility</p>
              <h3 class="fac-title"><?php echo htmlentities($fac->FacilityTitle); ?></h3>
              <div class="fac-divider"></div>
              <p class="fac-desc"><?php echo htmlentities($fac->Description); ?></p>
              <div class="fac-badge">
                <svg width="10" height="10" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Available for all guests
              </div>
            </div>
          </div>
        <?php $facCnt++;
        }
      } else { ?>

        <!-- Empty State: Facilities -->
        <div style="padding:64px 20px; text-align:center; background:#fff; border-radius:18px; box-shadow:0 3px 16px rgba(107,70,68,.07);">
          <div style="width:52px; height:52px; background:#F9EBDE; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 14px;">
            <svg width="22" height="22" fill="none" stroke="#815854" stroke-width="1.4" viewBox="0 0 24 24" stroke-linecap="round" style="opacity:.35;">
              <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <p style="font-family:'Playfair Display',serif; font-size:.9rem; color:#5a4a44; margin:0 0 7px;">No facilities listed yet.</p>
          <p style="font-family:'DM Sans',sans-serif; font-size:.72rem; color:#b09080; margin:0;">We're adding them shortly — please check back soon.</p>
        </div>

      <?php } ?>
    </div>
  </section>

  <!-- Hover overlay CSS trick -->
  <style>
    .cat-card:hover .cat-overlay {
      opacity: 1 !important;
    }

    @media(max-width:640px) {

      #tab-rooms,
      #tab-facilities {
        font-size: .58rem;
        padding: 8px 14px;
      }

      .tab-btn span {
        display: none;
      }
    }
  </style>

  <!-- Tab Switch JS (new, not touching existing JS) -->
  <script>
    function switchTab(tab) {
      var rooms = document.getElementById('section-rooms');
      var facilities = document.getElementById('section-facilities');
      var btnRooms = document.getElementById('tab-rooms');
      var btnFac = document.getElementById('tab-facilities');

      if (tab === 'rooms') {
        rooms.style.display = 'block';
        facilities.style.display = 'none';
        btnRooms.className = 'tab-btn active';
        btnFac.className = 'tab-btn inactive';
      } else {
        rooms.style.display = 'none';
        facilities.style.display = 'block';
        btnFac.className = 'tab-btn active';
        btnRooms.className = 'tab-btn inactive';
      }
      window.scrollTo({
        top: 120,
        behavior: 'smooth'
      });
    }
  </script>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>