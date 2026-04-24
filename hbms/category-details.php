<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
$cid = intval($_GET['catid']);
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Room Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="favicon.php">
  <link href="css/lightbox.css" rel="stylesheet">
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

    @keyframes slideInL {
      from {
        opacity: 0;
        transform: translateX(-26px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes slideInR {
      from {
        opacity: 0;
        transform: translateX(26px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
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

    @keyframes imgReveal {
      from {
        clip-path: inset(0 100% 0 0)
      }

      to {
        clip-path: inset(0 0% 0 0)
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
      background: linear-gradient(160deg, rgba(129, 88, 84, .6) 0%, rgba(40, 20, 18, .78) 100%);
    }

    .page-hero-content {
      position: relative;
      z-index: 2;
      padding: 56px 20px 48px;
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
      font-size: clamp(1.7rem, 4.5vw, 2.4rem);
      font-weight: 600;
      color: #fff;
      margin: 0;
      line-height: 1.2;
    }

    .page-hero-sub {
      font-family: 'DM Sans', sans-serif;
      font-size: .74rem;
      color: rgba(255, 255, 255, .55);
      margin-top: 12px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.8;
    }

    .hero-divider {
      width: 36px;
      height: 1.5px;
      background: rgba(249, 235, 222, .3);
      margin: 18px auto 0;
      border-radius: 2px;
    }

    /* Room Card */
    .room-card {
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(107, 70, 68, .09);
      animation: scaleIn .5s cubic-bezier(.16, 1, .3, 1) both;
      transition: box-shadow .25s, transform .25s;
    }

    .room-card:hover {
      box-shadow: 0 10px 36px rgba(107, 70, 68, .16);
      transform: translateY(-3px);
    }

    .room-card:nth-child(1) {
      animation-delay: 0s
    }

    .room-card:nth-child(2) {
      animation-delay: .08s
    }

    .room-card:nth-child(3) {
      animation-delay: .16s
    }

    .room-card:nth-child(4) {
      animation-delay: .24s
    }

    .room-img-wrap {
      position: relative;
      overflow: hidden;
      height: 240px;
    }

    .room-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 5s ease;
    }

    .room-card:hover .room-img {
      transform: scale(1.05);
    }

    .room-img-badge {
      position: absolute;
      top: 14px;
      left: 14px;
      background: rgba(255, 255, 255, .92);
      backdrop-filter: blur(8px);
      border-radius: 50px;
      padding: 4px 12px;
      font-family: 'DM Sans', sans-serif;
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .1em;
      color: #815854;
    }

    .room-img-price {
      position: absolute;
      bottom: 14px;
      right: 14px;
      background: #815854;
      border-radius: 10px;
      padding: 7px 14px;
      font-family: 'Playfair Display', serif;
      font-size: 1rem;
      font-weight: 700;
      color: #fff;
      line-height: 1;
    }

    .room-img-price span {
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      font-weight: 400;
      color: rgba(255, 255, 255, .65);
      display: block;
      margin-top: 2px;
    }

    .room-body {
      padding: 22px 22px 20px;
    }

    .room-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      font-weight: 600;
      color: #3a2c28;
      margin: 0 0 8px;
      line-height: 1.3;
    }

    .room-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: .74rem;
      color: #7a6860;
      line-height: 1.7;
      margin: 0 0 16px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .stat-chip {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 10px;
      font-family: 'DM Sans', sans-serif;
      font-size: .62rem;
      font-weight: 500;
      color: #6b5c56;
      background: #F9EBDE;
      border-radius: 6px;
    }

    .stat-chip svg {
      flex-shrink: 0;
    }

    .room-divider {
      height: 1px;
      background: #F0D5C0;
      margin: 16px 0;
    }

    .room-facilities {
      font-family: 'DM Sans', sans-serif;
      font-size: .68rem;
      color: #9a7c74;
      line-height: 1.7;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .book-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 11px 18px;
      font-family: 'DM Sans', sans-serif;
      font-size: .68rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      color: #fff;
      background: linear-gradient(135deg, #815854 0%, #6b4644 100%);
      border: none;
      border-radius: 10px;
      cursor: pointer;
      box-shadow: 0 4px 14px rgba(129, 88, 84, .25);
      transition: all .2s;
      text-decoration: none;
      margin-top: 16px;
    }

    .book-btn:hover {
      background: #6b4644;
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(129, 88, 84, .35);
    }

    .book-btn:active {
      transform: scale(.98);
    }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
      margin-bottom: 28px;
      animation: fadeInUp .45s cubic-bezier(.16, 1, .3, 1) both;
    }

    .breadcrumb-strip {
      background: #fff;
      border-bottom: 1px solid #F0D5C0;
      padding: 12px 20px;
    }

    .breadcrumb-item {
      font-family: 'DM Sans', sans-serif;
      font-size: .68rem;
      color: #b09080;
      text-decoration: none;
    }

    .breadcrumb-item:hover {
      color: #815854;
    }

    .breadcrumb-sep {
      color: #c9b0a8;
      margin: 0 6px;
    }

    .breadcrumb-active {
      color: #815854;
      font-weight: 600;
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
  <script src="js/lightbox.min.js"></script>
</head>

<body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

  <header><?php include_once('includes/header.php'); ?></header>

  <!-- Page Hero -->
  <div class="page-hero" style="height:260px;">
    <img class="page-hero-img"
      src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=1600&q=80&auto=format&fit=crop"
      alt="Sea Horizon Hotel Room" width="1600" height="520" loading="eager"
      onerror="this.style.display='none'">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <?php
      $sqlcat = "SELECT * FROM tblcategory WHERE ID=:cid";
      $qcat   = $dbh->prepare($sqlcat);
      $qcat->bindParam(':cid', $cid, PDO::PARAM_STR);
      $qcat->execute();
      $cats = $qcat->fetchAll(PDO::FETCH_OBJ);
      $catName = '';
      $catDesc = '';
      foreach ($cats as $cat) {
        $catName = $cat->CategoryName;
        $catDesc = $cat->Description;
      }
      ?>
      <div class="hero-badge">
        <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
          <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Room Category
      </div>
      <h1 class="page-hero-title"><?php echo htmlentities($catName ?: 'Room Details'); ?></h1>
      <p class="page-hero-sub"><?php echo htmlentities($catDesc ?: 'Pick the room that feels right for you.'); ?></p>
      <div class="hero-divider"></div>
    </div>
  </div>

  <!-- Breadcrumb -->
  <div class="breadcrumb-strip">
    <div style="max-width:1100px;margin:0 auto;">
      <a href="index.php" class="breadcrumb-item">Home</a>
      <span class="breadcrumb-sep">/</span>
      <a href="services.php" class="breadcrumb-item">Facilities</a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-active breadcrumb-item"><?php echo htmlentities($catName ?: 'Rooms'); ?></span>
    </div>
  </div>

  <main class="flex-1 py-12">
    <div style="max-width:1100px;margin:0 auto;padding:0 20px;">

      <!-- Section Header -->
      <div class="section-header">
        <div>
          <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#b09080;margin:0 0 6px;">Available Rooms</p>
          <h2 style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:600;color:#3a2c28;margin:0;">
            <?php echo htmlentities($catName ?: 'All Rooms'); ?>
          </h2>
        </div>
        <a href="services.php" style="display:inline-flex;align-items:center;gap:6px;padding:7px 16px;font-family:'DM Sans',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;border:1.5px solid rgba(129,88,84,.25);border-radius:8px;text-decoration:none;transition:all .2s;background:transparent;"
          onmouseover="this.style.background='#815854';this.style.color='#fff'" onmouseout="this.style.background='transparent';this.style.color='#815854'">
          <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M15 19l-7-7 7-7" />
          </svg>
          All Categories
        </a>
      </div>

      <!-- Room Cards Grid -->
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:24px;">
        <?php
        $sql = "SELECT tblroom.*, tblroom.id as rmid, tblcategory.Price, tblcategory.ID, tblcategory.CategoryName
                  FROM tblroom
                  JOIN tblcategory ON tblroom.RoomType = tblcategory.ID
                  WHERE tblroom.RoomType = :cid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':cid', $cid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;

        if ($query->rowCount() > 0) {
          foreach ($results as $row) { ?>

            <div class="room-card">
              <!-- Room Image -->
              <div class="room-img-wrap">
                <a href="admin/images/<?php echo $row->Image; ?>" data-lightbox="room-<?php echo $row->rmid; ?>" data-title="<?php echo htmlentities($row->RoomName ?? $row->FacilityTitle); ?>">
                  <img src="admin/images/<?php echo $row->Image; ?>"
                    alt="<?php echo htmlentities($row->RoomName ?? ''); ?>"
                    class="room-img" width="600" height="400" loading="lazy"
                    onerror="this.style.background='#F9EBDE'">
                </a>
                <div class="room-img-badge"><?php echo htmlentities($row->CategoryName); ?></div>
                <div class="room-img-price">
                  $<?php echo htmlentities($row->Price); ?>
                  <span>per night</span>
                </div>
              </div>

              <!-- Room Body -->
              <div class="room-body">
                <h3 class="room-title"><?php echo htmlentities($row->FacilityTitle ?? $row->RoomName ?? 'Room'); ?></h3>
                <p class="room-desc"><?php echo htmlentities($row->RoomDesc); ?></p>

                <!-- Stats Chips -->
                <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:0;">
                  <span class="stat-chip">
                    <svg width="11" height="11" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
                      <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <?php echo htmlentities($row->MaxAdult); ?> Adults
                  </span>
                  <span class="stat-chip">
                    <svg width="11" height="11" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
                      <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197" />
                    </svg>
                    <?php echo htmlentities($row->MaxChild); ?> Children
                  </span>
                  <span class="stat-chip">
                    <svg width="11" height="11" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
                      <path d="M3 12l9-9 9 9M5 10v10h4v-6h6v6h4V10" />
                    </svg>
                    <?php echo htmlentities($row->NoofBed); ?> Bed(s)
                  </span>
                </div>

                <div class="room-divider"></div>

                <!-- Facilities -->
                <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0 0 6px;">Room Facilities</p>
                <p class="room-facilities"><?php echo htmlentities($row->RoomFacility); ?></p>

                <!-- CTA -->
                <a href="book-room.php?rmid=<?php echo $row->rmid; ?>" class="book-btn">
                  <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg>
                  Book This Room
                </a>
              </div>
            </div>

          <?php $cnt++;
          }
        } else { ?>

          <!-- Empty State -->
          <div style="grid-column:1/-1;padding:72px 20px;text-align:center;">
            <div style="width:56px;height:56px;background:rgba(129,88,84,.08);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
              <svg width="24" height="24" fill="none" stroke="#815854" stroke-width="1.4" viewBox="0 0 24 24" stroke-linecap="round" style="opacity:.4;">
                <path d="M3 12l9-9 9 9M5 10v10h4v-6h6v6h4V10" />
              </svg>
            </div>
            <h3 style="font-family:'Playfair Display',serif;font-size:1rem;color:#3a2c28;margin:0 0 8px;font-weight:600;">Nothing listed here yet</h3>
            <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#b09080;margin:0 0 20px;line-height:1.65;max-width:280px;margin-left:auto;margin-right:auto;">This category might be getting a refresh. Try another type or check back soon.</p>
            <a href="services.php" style="display:inline-flex;align-items:center;gap:7px;padding:9px 22px;font-family:'DM Sans',sans-serif;font-size:.66rem;font-weight:700;letter-spacing:.13em;text-transform:uppercase;color:#fff;background:#815854;border-radius:8px;text-decoration:none;box-shadow:0 3px 12px rgba(129,88,84,.25);">
              Browse All Categories
            </a>
          </div>

        <?php } ?>
      </div>
    </div>
  </main>

  <style>
    @media(max-width:520px) {
      .room-card {
        border-radius: 14px;
      }

      .room-img-wrap {
        height: 200px;
      }
    }
  </style>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>