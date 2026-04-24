<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | About Us</title>
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

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(.96)
      }

      to {
        opacity: 1;
        transform: scale(1)
      }
    }

    @keyframes slideInL {
      from {
        opacity: 0;
        transform: translateX(-24px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes slideInR {
      from {
        opacity: 0;
        transform: translateX(24px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes floatImg {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-8px)
      }
    }

    .page-hero {
      position: relative;
      overflow: hidden;
    }

    .page-hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.62) saturate(1.1);
      transition: transform 8s ease;
    }

    .page-hero:hover .page-hero-img {
      transform: scale(1.03);
    }

    .page-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(129, 88, 84, .58) 0%, rgba(40, 20, 18, .78) 100%);
    }

    .page-hero-content {
      position: relative;
      z-index: 2;
      padding: 64px 20px 52px;
      text-align: center;
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
    }

    .page-hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 5vw, 2.8rem);
      font-weight: 600;
      color: #fff;
      margin: 0;
      line-height: 1.2;
    }

    .page-hero-sub {
      font-family: 'DM Sans', sans-serif;
      font-size: .78rem;
      color: rgba(255, 255, 255, .55);
      margin-top: 12px;
      max-width: 420px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.8;
    }

    .hero-divider {
      width: 36px;
      height: 1.5px;
      background: rgba(249, 235, 222, .35);
      margin: 18px auto 0;
      border-radius: 2px;
    }

    .stat-box {
      background: #fff;
      border-radius: 14px;
      padding: 20px 18px;
      text-align: center;
      box-shadow: 0 3px 16px rgba(107, 70, 68, .08);
      transition: box-shadow .2s, transform .2s;
    }

    .stat-box:hover {
      box-shadow: 0 6px 24px rgba(107, 70, 68, .12);
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
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: #b09080;
      margin-top: 7px;
    }

    .about-img-wrap {
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 32px rgba(107, 70, 68, .14);
      animation: slideInL .6s cubic-bezier(.16, 1, .3, 1) both;
    }

    .about-img-wrap:hover img {
      transform: scale(1.04);
    }

    .about-img-wrap img {
      transition: transform 6s ease;
    }

    .feature-row {
      display: flex;
      gap: 14px;
      padding: 14px 0;
      border-bottom: 1px solid #F0D5C0;
      animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
    }

    .feature-row:last-child {
      border-bottom: none;
    }

    .feature-icon {
      width: 36px;
      height: 36px;
      background: #F9EBDE;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      margin-top: 2px;
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

  <!-- Page Hero -->
  <div class="page-hero" style="height:280px;">
    <img class="page-hero-img"
      src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=1600&q=80&auto=format&fit=crop"
      alt="Sea Horizon Hotel aerial view" width="1600" height="560" loading="eager"
      onerror="this.style.display='none'">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <div class="hero-badge">
        <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
          <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Our Story
      </div>
      <h1 class="page-hero-title">A hotel that<br><em style="font-style:italic;color:#F0D5C0;">actually cares</em></h1>
      <p class="page-hero-sub">We opened in 2010 with a simple idea — make people feel at home, even when they're far from it. We're still working on it.</p>
      <div class="hero-divider"></div>
    </div>
  </div>

  <main class="flex-1">

    <!-- Stats Strip -->
    <div style="background:#fff;border-bottom:1px solid #F0D5C0;padding:28px 20px;">
      <div style="max-width:860px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:14px;">
        <div class="stat-box" style="animation:scaleIn .45s cubic-bezier(.16,1,.3,1) both;">
          <div class="stat-num">15+</div>
          <div class="stat-lbl">Years Running</div>
        </div>
        <div class="stat-box" style="animation:scaleIn .45s cubic-bezier(.16,1,.3,1) .07s both;">
          <div class="stat-num">40+</div>
          <div class="stat-lbl">Room Types</div>
        </div>
        <div class="stat-box" style="animation:scaleIn .45s cubic-bezier(.16,1,.3,1) .14s both;">
          <div class="stat-num">3k+</div>
          <div class="stat-lbl">Happy Guests</div>
        </div>
        <div class="stat-box" style="animation:scaleIn .45s cubic-bezier(.16,1,.3,1) .21s both;">
          <div class="stat-num">24/7</div>
          <div class="stat-lbl">Front Desk</div>
        </div>
      </div>
    </div>

    <!-- About Section -->
    <section style="padding:72px 20px;">
      <div style="max-width:960px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center;">
        <div class="about-img-wrap">
          <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=900&q=80&auto=format&fit=crop"
            alt="Sea Horizon Hotel suite" width="900" height="700" loading="lazy"
            style="width:100%;height:400px;object-fit:cover;display:block;"
            onerror="this.style.display='none'">
        </div>
        <div style="animation:slideInR .6s cubic-bezier(.16,1,.3,1) both;animation-delay:.1s;">
          <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.24em;text-transform:uppercase;color:#815854;margin:0 0 14px;">About Us</p>
          <?php
          $sql = "SELECT * from tblpage where PageType='aboutus'";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
            foreach ($results as $row) { ?>
              <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.4rem,3vw,2rem);font-weight:600;color:#3a2c28;line-height:1.3;margin:0 0 18px;"><?php echo htmlentities($row->PageTitle); ?></h2>
              <p style="font-family:'DM Sans',sans-serif;font-size:.8rem;color:#7a6860;line-height:1.85;margin:0 0 22px;"><?php echo htmlentities($row->PageDescription); ?></p>
          <?php }
          } ?>

          <div style="display:flex;flex-direction:column;gap:0;background:#fff;border-radius:14px;overflow:hidden;border:1px solid #F0D5C0;">
            <?php
            $features = [
              ['icon' => 'M5 13l4 4L19 7', 'text' => 'Sea-facing rooms with private balconies on every floor'],
              ['icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3', 'text' => 'Complimentary breakfast for all guests'],
              ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'text' => 'Spa, infinity pool, and gym — open every day'],
            ];
            foreach ($features as $i => $f): ?>
              <div class="feature-row" style="padding:13px 18px;animation-delay:<?= ($i + 1) * 0.1 ?>s;">
                <div class="feature-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="<?= $f['icon'] ?>" />
                  </svg>
                </div>
                <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#5a4a44;line-height:1.65;margin:0;"><?= $f['text'] ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- Why Us Section -->
    <section style="background:#fff;padding:64px 20px;border-top:1px solid #F0D5C0;">
      <div style="max-width:960px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:44px;animation:fadeInUp .5s cubic-bezier(.16,1,.3,1) both;">
          <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.24em;text-transform:uppercase;color:#815854;margin:0 0 10px;">Why Guests Come Back</p>
          <h2 style="font-family:'Playfair Display',serif;font-size:clamp(1.4rem,3vw,1.9rem);font-weight:600;color:#3a2c28;margin:0;line-height:1.3;">It's the little things, honestly.</h2>
          <div style="width:36px;height:1.5px;background:rgba(129,88,84,.3);margin:18px auto 0;border-radius:2px;"></div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;">
          <?php
          $whys = [
            ['img' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?w=600&q=80&auto=format&fit=crop', 'title' => 'The Breakfast', 'desc' => 'Made fresh every morning. No sad buffet warming trays. Real food, real coffee.'],
            ['img' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=600&q=80&auto=format&fit=crop', 'title' => 'The Rooms', 'desc' => 'Quiet, clean, and properly dark when you need to sleep. Every bed gets fresh linen daily.'],
            ['img' => 'https://images.unsplash.com/photo-1615460549969-36fa19521a4f?w=600&q=80&auto=format&fit=crop', 'title' => 'The Staff', 'desc' => 'They actually remember your name. Sometimes your order too. It\'s a bit uncanny, in a good way.'],
          ];
          foreach ($whys as $i => $item): ?>
            <div style="border-radius:16px;overflow:hidden;box-shadow:0 3px 16px rgba(107,70,68,.08);animation:fadeInUp .45s cubic-bezier(.16,1,.3,1) both;animation-delay:<?= $i * 0.1 ?>s;transition:box-shadow .2s,transform .2s;"
              onmouseover="this.style.boxShadow='0 8px 28px rgba(107,70,68,.14)';this.style.transform='translateY(-3px)'"
              onmouseout="this.style.boxShadow='0 3px 16px rgba(107,70,68,.08)';this.style.transform='translateY(0)'">
              <img src="<?= $item['img'] ?>" alt="<?= $item['title'] ?>" width="600" height="400" loading="lazy"
                style="width:100%;height:160px;object-fit:cover;display:block;" onerror="this.style.display='none'">
              <div style="padding:18px;">
                <h3 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#3a2c28;margin:0 0 8px;"><?= $item['title'] ?></h3>
                <p style="font-family:'DM Sans',sans-serif;font-size:.74rem;color:#7a6860;line-height:1.7;margin:0;"><?= $item['desc'] ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

  <style>
    @media(max-width:680px) {
      section>div>div:first-child:has(.about-img-wrap) {
        grid-template-columns: 1fr !important;
      }

      .stat-box>.stat-num {
        font-size: 1.5rem;
      }
    }
  </style>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>