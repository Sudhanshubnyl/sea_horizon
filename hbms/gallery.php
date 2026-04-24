<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Gallery</title>
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

  <!-- Lightbox CSS (untouched) -->
  <link rel="stylesheet" href="css/lightbox.css">

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

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-14px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
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

    @keyframes cardIn {
      from {
        opacity: 0;
        transform: translateY(18px) scale(.98)
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1)
      }
    }

    /* ── Page Hero ── */
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
      filter: brightness(.6) saturate(1.1);
      transition: transform 8s ease;
    }

    .page-hero:hover .page-hero-img {
      transform: scale(1.04);
    }

    .page-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(129, 88, 84, .62) 0%, rgba(40, 20, 18, .82) 100%);
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
      margin-bottom: 16px;
      animation: floatBadge 3.5s ease-in-out infinite;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.8rem, 5vw, 2.8rem);
      font-weight: 600;
      color: #fff;
      margin: 0;
      line-height: 1.2;
      animation: slideDown .55s cubic-bezier(.16, 1, .3, 1) both;
    }

    .hero-title em {
      font-style: italic;
      color: #F0D5C0;
    }

    .hero-sub {
      font-family: 'DM Sans', sans-serif;
      font-size: .76rem;
      color: rgba(255, 255, 255, .5);
      margin: 12px auto 0;
      max-width: 380px;
      line-height: 1.8;
      animation: fadeInUp .6s cubic-bezier(.16, 1, .3, 1) .1s both;
    }

    .hero-divider {
      width: 36px;
      height: 1.5px;
      background: rgba(249, 235, 222, .3);
      margin: 18px auto 0;
      border-radius: 2px;
    }

    /* ── Gallery Cards ── */
    .gallery-item {
      position: relative;
      border-radius: 14px;
      overflow: hidden;
      cursor: pointer;
      box-shadow: 0 2px 12px rgba(107, 70, 68, .09);
      transition: box-shadow .25s, transform .25s;
      animation: cardIn .45s cubic-bezier(.16, 1, .3, 1) both;
    }

    .gallery-item:hover {
      box-shadow: 0 8px 28px rgba(107, 70, 68, .18);
      transform: translateY(-3px);
    }

    .gallery-item:nth-child(1) {
      animation-delay: .04s
    }

    .gallery-item:nth-child(2) {
      animation-delay: .08s
    }

    .gallery-item:nth-child(3) {
      animation-delay: .12s
    }

    .gallery-item:nth-child(4) {
      animation-delay: .16s
    }

    .gallery-item:nth-child(5) {
      animation-delay: .20s
    }

    .gallery-item:nth-child(6) {
      animation-delay: .24s
    }

    .gallery-item:nth-child(7) {
      animation-delay: .28s
    }

    .gallery-item:nth-child(8) {
      animation-delay: .32s
    }

    .gallery-item:nth-child(9) {
      animation-delay: .36s
    }

    .gallery-item:nth-child(10) {
      animation-delay: .40s
    }

    .gallery-item:nth-child(11) {
      animation-delay: .44s
    }

    .gallery-item:nth-child(12) {
      animation-delay: .48s
    }

    .gallery-item img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform .6s cubic-bezier(.16, 1, .3, 1);
    }

    .gallery-item:hover img {
      transform: scale(1.08);
    }

    /* Hover overlay */
    .gallery-overlay {
      position: absolute;
      inset: 0;
      background: rgba(129, 88, 84, .62);
      opacity: 0;
      transition: opacity .28s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 10px;
      text-decoration: none;
    }

    .gallery-item:hover .gallery-overlay {
      opacity: 1;
    }

    .overlay-zoom {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .2);
      border: 2px solid rgba(255, 255, 255, .55);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background .2s, transform .2s;
    }

    .gallery-item:hover .overlay-zoom {
      background: rgba(255, 255, 255, .3);
      transform: scale(1.08);
    }

    /* Bottom gradient label */
    .gallery-label {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      padding: 28px 14px 12px;
      background: linear-gradient(to top, rgba(40, 20, 18, .72) 0%, transparent 100%);
      pointer-events: none;
    }

    .gallery-label p {
      font-family: 'DM Sans', sans-serif;
      font-size: .65rem;
      font-weight: 600;
      letter-spacing: .06em;
      color: rgba(255, 255, 255, .85);
      margin: 0;
      truncate: true;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* ── Filter Strip ── */
    .filter-btn {
      padding: 5px 14px;
      border-radius: 50px;
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      cursor: pointer;
      border: 1.5px solid rgba(129, 88, 84, .25);
      color: #815854;
      background: transparent;
      transition: all .2s;
    }

    .filter-btn:hover,
    .filter-btn.active {
      background: #815854;
      color: #fff;
      border-color: #815854;
      box-shadow: 0 3px 10px rgba(129, 88, 84, .22);
    }

    /* ── Count chip ── */
    .count-chip {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 14px;
      background: #fff;
      border: 1px solid #F0D5C0;
      border-radius: 50px;
      font-family: 'DM Sans', sans-serif;
      font-size: .62rem;
      color: #b09080;
      box-shadow: 0 2px 8px rgba(107, 70, 68, .06);
    }

    .count-chip strong {
      color: #815854;
      font-weight: 700;
    }

    /* ── Grid layout ── */
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px;
    }

    @media(max-width:1024px) {
      .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media(max-width:680px) {
      .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media(max-width:400px) {
      .gallery-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Wide card every 7th item */
    .gallery-item.is-wide {
      grid-column: span 2;
    }

    @media(max-width:680px) {
      .gallery-item.is-wide {
        grid-column: span 1;
      }
    }

    /* Tall card for first item */
    .gallery-item.is-tall {
      aspect-ratio: 3/4;
    }

    .gallery-item.is-wide {
      aspect-ratio: 16/7;
    }

    .gallery-item:not(.is-tall):not(.is-wide) {
      aspect-ratio: 4/3;
    }
  </style>
</head>

<body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

  <header><?php include_once('includes/header.php'); ?></header>

  <!-- ═══ Page Hero ═══ -->
  <div class="page-hero" style="height:290px;">
    <img class="page-hero-img"
      src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=1600&q=80&auto=format&fit=crop"
      alt="Sea Horizon Hotel aerial" width="1600" height="580" loading="eager"
      onerror="this.style.display='none'">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <div class="hero-badge">
        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#F0D5C0" stroke-width="2.5" stroke-linecap="round">
          <rect x="3" y="3" width="18" height="18" rx="2" />
          <circle cx="8.5" cy="8.5" r="1.5" />
          <polyline points="21 15 16 10 5 21" />
        </svg>
        Visual Tour
      </div>
      <h1 class="hero-title">Our Gallery<br><em>through the lens</em></h1>
      <p class="hero-sub">Rooms that feel better in person, but these photos come close. Have a look around.</p>
      <div class="hero-divider"></div>
    </div>
  </div>

  <!-- ═══ Main ═══ -->
  <main class="flex-1 py-14">
    <div style="max-width:1200px; margin:0 auto; padding:0 20px;">

      <!-- Section header + count -->
      <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px; animation:fadeInUp .45s cubic-bezier(.16,1,.3,1) both;">
        <div>
          <p style="font-family:'DM Sans',sans-serif; font-size:.58rem; font-weight:700; letter-spacing:.24em; text-transform:uppercase; color:#815854; margin:0 0 6px;">Our Rooms & Spaces</p>
          <h2 style="font-family:'Playfair Display',serif; font-size:clamp(1rem,2.5vw,1.3rem); font-weight:600; color:#3a2c28; margin:0;">Every corner of Sea Horizon, captured.</h2>
        </div>

        <?php
        $sqlCount = "SELECT COUNT(*) as total FROM tblroom";
        $qCount   = $dbh->prepare($sqlCount);
        $qCount->execute();
        $rCount   = $qCount->fetch(PDO::FETCH_OBJ);
        $total    = $rCount->total ?? 0;
        ?>
        <?php if ($total > 0): ?>
          <div class="count-chip">
            <svg width="11" height="11" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
              <rect x="3" y="3" width="18" height="18" rx="2" />
              <circle cx="8.5" cy="8.5" r="1.5" />
              <polyline points="21 15 16 10 5 21" />
            </svg>
            <strong><?php echo $total; ?></strong> room<?php echo $total != 1 ? 's' : ''; ?> · Click any to view full size
          </div>
        <?php endif; ?>
      </div>

      <!-- ═══ Gallery Grid ═══ -->
      <div class="gallery-grid">

        <?php
        $sql = "SELECT * from tblroom";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) {
            $isWide = ($cnt % 7 == 1);
            $isTall = ($cnt % 11 == 3);
            $cls    = $isWide ? 'is-wide' : ($isTall ? 'is-tall' : '');
        ?>

            <div class="gallery-item <?php echo $cls; ?>">

              <!-- Room image -->
              <img src="admin/images/<?php echo $row->Image; ?>"
                alt="<?php echo htmlentities($row->RoomName); ?>"
                loading="lazy" decoding="async"
                onerror="this.style.background='#F0D5C0';this.removeAttribute('src')">

              <!-- Lightbox link overlay -->
              <a class="gallery-overlay example-image-link"
                href="admin/images/<?php echo $row->Image; ?>"
                data-lightbox="sea-horizon-gallery"
                data-title="<?php echo htmlentities($row->RoomName); ?> — Sea Horizon Hotel">

                <!-- Zoom icon -->
                <div class="overlay-zoom">
                  <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
                    <circle cx="11" cy="11" r="8" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    <line x1="11" y1="8" x2="11" y2="14" />
                    <line x1="8" y1="11" x2="14" y2="11" />
                  </svg>
                </div>

                <!-- Room name on hover -->
                <span style="font-family:'DM Sans',sans-serif; font-size:.65rem; font-weight:600; letter-spacing:.1em; color:rgba(255,255,255,.9); text-align:center; padding:0 12px; max-width:180px; line-height:1.4;">
                  <?php echo htmlentities($row->RoomName); ?>
                </span>

              </a>

              <!-- Always-visible bottom label -->
              <div class="gallery-label">
                <p><?php echo htmlentities($row->RoomName); ?></p>
              </div>

            </div>

          <?php
            $cnt++;
          }
        }

        // Empty state
        if ($cnt == 1) { ?>
          <div style="grid-column:1/-1; padding:72px 20px; text-align:center; animation:scaleIn .5s cubic-bezier(.16,1,.3,1) both;">
            <div style="width:56px; height:56px; background:#F0D5C0; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; opacity:.6;">
              <svg width="24" height="24" fill="none" stroke="#815854" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <circle cx="8.5" cy="8.5" r="1.5" />
                <polyline points="21 15 16 10 5 21" />
              </svg>
            </div>
            <p style="font-family:'Playfair Display',serif; font-size:1rem; color:#5a4a44; margin:0 0 8px;">Nothing to show yet.</p>
            <p style="font-family:'DM Sans',sans-serif; font-size:.74rem; color:#b09080; max-width:260px; margin:0 auto; line-height:1.65;">
              Photos will show up here once rooms are added. Check back soon.
            </p>
          </div>
        <?php } ?>

      </div>

      <!-- Image count footer note -->
      <?php if ($cnt > 1): ?>
        <div style="text-align:center; margin-top:36px; animation:fadeInUp .5s cubic-bezier(.16,1,.3,1) .3s both;">
          <p style="font-family:'DM Sans',sans-serif; font-size:.65rem; color:#c9b0a8; letter-spacing:.1em;">
            Showing <strong style="color:#815854;"><?php echo $cnt - 1; ?></strong> room<?php echo ($cnt - 1) > 1 ? 's' : ''; ?> &nbsp;·&nbsp; Tap or click any image to see the full picture
          </p>
        </div>
      <?php endif; ?>

    </div>
  </main>

  <!-- Lightbox JS (untouched — must stay after jQuery) -->
  <script src="js/lightbox-plus-jquery.min.js"></script>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>

</body>

</html>