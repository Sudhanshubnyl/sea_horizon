<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
if (strlen($_SESSION['hbmsuid'] == 0)) {
  header('location:logout.php');
} else {

  if (isset($_POST['submit'])) {
    $booknum     = mt_rand(100000000, 999999999);
    $rid         = intval($_GET['rmid']);
    $uid         = $_SESSION['hbmsuid'];
    $idtype      = $_POST['idtype'];
    $gender      = $_POST['gender'];
    $address     = $_POST['address'];
    $checkindate = $_POST['checkindate'];
    $checkoutdate = $_POST['checkoutdate'];
    $cdate       = date('Y-m-d');

    if ($checkindate < $cdate) {
      echo '<script>alert("Check-in date can\'t be in the past.")</script>';
    } elseif ($checkindate > $checkoutdate) {
      echo '<script>alert("Check-out must be on or after check-in.")</script>';
    } else {
      $sql = "INSERT INTO tblbooking(RoomId,BookingNumber,UserID,IDType,Gender,Address,CheckinDate,CheckoutDate)
              VALUES(:rid,:booknum,:uid,:idtype,:gender,:address,:checkindate,:checkoutdate)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':rid',         $rid,         PDO::PARAM_STR);
      $query->bindParam(':booknum',     $booknum,     PDO::PARAM_STR);
      $query->bindParam(':uid',         $uid,         PDO::PARAM_STR);
      $query->bindParam(':idtype',      $idtype,      PDO::PARAM_STR);
      $query->bindParam(':gender',      $gender,      PDO::PARAM_STR);
      $query->bindParam(':address',     $address,     PDO::PARAM_STR);
      $query->bindParam(':checkindate', $checkindate, PDO::PARAM_STR);
      $query->bindParam(':checkoutdate', $checkoutdate, PDO::PARAM_STR);
      $query->execute();
      $LastInsertId = $dbh->lastInsertId();
      if ($LastInsertId > 0) {
        echo '<script>alert("Room booked! Your reference number is ' . $booknum . '. We\'ll confirm shortly.")</script>';
        echo "<script>window.location.href='index.php'</script>";
      } else {
        echo '<script>alert("Something went wrong. Please try again.")</script>';
      }
    }
  }
?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <title>Sea Horizon Hotel | Book a Room</title>
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
          transform: translateY(18px)
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

      @keyframes shimmerMove {
        0% {
          background-position: -200% 0
        }

        100% {
          background-position: 200% 0
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
        padding: 52px 20px 44px;
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
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        font-weight: 600;
        color: #fff;
        margin: 0;
        line-height: 1.2;
      }

      .page-hero-sub {
        font-family: 'DM Sans', sans-serif;
        font-size: .72rem;
        color: rgba(255, 255, 255, .5);
        margin-top: 10px;
      }

      .hero-divider {
        width: 36px;
        height: 1.5px;
        background: rgba(249, 235, 222, .3);
        margin: 16px auto 0;
        border-radius: 2px;
      }

      .form-card {
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 32px rgba(107, 70, 68, .1);
        animation: slideInL .55s cubic-bezier(.16, 1, .3, 1) both;
      }

      .side-panel {
        animation: slideInR .55s cubic-bezier(.16, 1, .3, 1) both;
        animation-delay: .08s;
      }

      .form-label {
        display: block;
        font-family: 'DM Sans', sans-serif;
        font-size: .58rem;
        font-weight: 700;
        letter-spacing: .17em;
        text-transform: uppercase;
        color: #b09080;
        margin-bottom: 6px;
      }

      .form-input {
        width: 100%;
        padding: 10px 14px;
        font-family: 'DM Sans', sans-serif;
        font-size: .82rem;
        color: #4a3830;
        background: #fdf8f5;
        border: 1.5px solid #F0D5C0;
        border-radius: 10px;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
        -webkit-appearance: none;
        appearance: none;
      }

      .form-input:focus {
        border-color: #815854;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(129, 88, 84, .1);
      }

      .form-input::placeholder {
        color: #c9b0a8;
      }

      .form-input[readonly] {
        background: #f8f5f2;
        border-color: #ece7e2;
        color: #b09080;
        cursor: not-allowed;
      }

      .form-input textarea {
        resize: vertical;
        min-height: 80px;
        line-height: 1.65;
      }

      .form-group {
        margin-bottom: 15px;
        animation: fadeInUp .38s cubic-bezier(.16, 1, .3, 1) both;
      }

      .form-group:nth-child(1) {
        animation-delay: .08s
      }

      .form-group:nth-child(2) {
        animation-delay: .14s
      }

      .form-group:nth-child(3) {
        animation-delay: .2s
      }

      .form-group:nth-child(4) {
        animation-delay: .26s
      }

      .form-group:nth-child(5) {
        animation-delay: .32s
      }

      .form-group:nth-child(6) {
        animation-delay: .38s
      }

      .form-group:nth-child(7) {
        animation-delay: .44s
      }

      .form-group:nth-child(8) {
        animation-delay: .5s
      }

      .book-btn {
        width: 100%;
        padding: 12px 20px;
        font-family: 'DM Sans', sans-serif;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #fff;
        background: linear-gradient(135deg, #815854 0%, #6b4644 100%);
        border: none;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(129, 88, 84, .28);
        transition: transform .18s, box-shadow .18s;
        margin-top: 8px;
      }

      .book-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(129, 88, 84, .38);
      }

      .book-btn:active {
        transform: scale(.98);
      }

      .radio-group {
        display: flex;
        gap: 12px;
      }

      .radio-opt {
        display: flex;
        align-items: center;
        gap: 7px;
        cursor: pointer;
        font-family: 'DM Sans', sans-serif;
        font-size: .76rem;
        color: #5a4a44;
        padding: 8px 14px;
        border: 1.5px solid #F0D5C0;
        border-radius: 9px;
        flex: 1;
        transition: all .18s;
      }

      .radio-opt:has(input:checked) {
        border-color: #815854;
        background: rgba(129, 88, 84, .06);
        color: #815854;
      }

      .radio-opt input[type="radio"] {
        accent-color: #815854;
        width: 14px;
        height: 14px;
      }

      .room-info-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(107, 70, 68, .08);
      }

      .step-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #F0D5C0;
      }

      .step-item:last-child {
        border-bottom: none;
      }

      .step-num {
        width: 24px;
        height: 24px;
        background: #815854;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-family: 'DM Sans', sans-serif;
        font-size: .6rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1px;
      }

      .date-shimmer {
        background: linear-gradient(90deg, #F9EBDE 25%, #F0D5C0 50%, #F9EBDE 75%);
        background-size: 200% 100%;
        animation: shimmerMove 2s ease-in-out infinite;
        border-radius: 8px;
        height: 40px;
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
  </head>

  <body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

    <header><?php include_once('includes/header.php'); ?></header>

    <!-- Page Hero -->
    <div class="page-hero" style="height:240px;">
      <?php
      $rid_preview = intval($_GET['rmid']);
      $sqlroom = "SELECT tblroom.*, tblcategory.Price, tblcategory.CategoryName FROM tblroom
                  JOIN tblcategory ON tblroom.RoomType=tblcategory.ID
                  WHERE tblroom.ID=:rid";
      $qroom = $dbh->prepare($sqlroom);
      $qroom->bindParam(':rid', $rid_preview, PDO::PARAM_STR);
      $qroom->execute();
      $rooms = $qroom->fetchAll(PDO::FETCH_OBJ);
      $roomData = $rooms[0] ?? null;
      ?>
      <img class="page-hero-img"
        src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1600&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel booking" width="1600" height="480" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          Reservation
        </div>
        <h1 class="page-hero-title">Book Your Stay</h1>
        <p class="page-hero-sub">
          <?php if ($roomData): ?>
            You picked <strong style="color:#F0D5C0;"><?php echo htmlentities($roomData->RoomName ?? $roomData->FacilityTitle ?? 'a room'); ?></strong>. Good choice.
          <?php else: ?>
            Fill in the details below and we'll get you sorted.
          <?php endif; ?>
        </p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-strip">
      <div style="max-width:960px;margin:0 auto;">
        <a href="index.php" class="breadcrumb-item">Home</a>
        <span class="breadcrumb-sep">/</span>
        <a href="services.php" class="breadcrumb-item">Facilities</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-active breadcrumb-item">Book a Room</span>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:960px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1fr 280px;gap:24px;align-items:start;">

        <!-- LEFT: Booking Form -->
        <div class="form-card">
          <!-- Card Header -->
          <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);padding:22px 28px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden;">
            <div style="position:absolute;top:-30px;right:-30px;width:90px;height:90px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
            <div style="position:absolute;bottom:-20px;left:-10px;width:60px;height:60px;background:rgba(255,255,255,.04);border-radius:50%;"></div>
            <div style="width:42px;height:42px;background:rgba(255,255,255,.18);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;z-index:1;">
              <svg width="19" height="19" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <div style="position:relative;z-index:1;">
              <h2 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#fff;margin:0;line-height:1.2;">Guest Information</h2>
              <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:rgba(255,255,255,.55);margin:4px 0 0;">Quick form — shouldn't take more than a minute.</p>
            </div>
          </div>

          <div style="padding:26px 28px 30px;">
            <form method="post">

              <!-- Auto-filled guest info (readonly) -->
              <?php
              $uid = $_SESSION['hbmsuid'];
              $sqlu = "SELECT * FROM tbluser WHERE ID=:uid";
              $qu = $dbh->prepare($sqlu);
              $qu->bindParam(':uid', $uid, PDO::PARAM_STR);
              $qu->execute();
              $users = $qu->fetchAll(PDO::FETCH_OBJ);
              foreach ($users as $u) { ?>

                <!-- Guest Info: readonly section label -->
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:14px;padding:8px 12px;background:rgba(249,235,222,.6);border-radius:9px;">
                  <svg width="12" height="12" fill="#815854" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:#7a6860;margin:0;">Booking for <strong style="color:#815854;"><?php echo htmlentities($u->FullName); ?></strong> — we've filled in the basics.</p>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:4px;">
                  <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-input" readonly value="<?php echo htmlentities($u->FullName); ?>">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Mobile Number</label>
                    <input type="text" name="phone" class="form-input" readonly maxlength="10" value="<?php echo htmlentities($u->MobileNumber); ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-input" readonly value="<?php echo htmlentities($u->Email); ?>">
                </div>

              <?php } ?>

              <div style="height:1px;background:#F0D5C0;margin:18px 0;"></div>

              <!-- ID Type -->
              <div class="form-group">
                <label class="form-label">ID Type</label>
                <select name="idtype" required class="form-input">
                  <option value="">Choose an ID type</option>
                  <option value="IRP">IRP</option>
                  <option value="PPSN">PPSN</option>
                  <option value="Driving Licence">Driving Licence</option>
                  <option value="Passport">Passport</option>
                </select>
              </div>

              <!-- Gender -->
              <div class="form-group">
                <label class="form-label">Gender</label>
                <div class="radio-group">
                  <label class="radio-opt">
                    <input type="radio" name="gender" value="Female" checked>
                    Female
                  </label>
                  <label class="radio-opt">
                    <input type="radio" name="gender" value="Male">
                    Male
                  </label>
                  <label class="radio-opt">
                    <input type="radio" name="gender" value="Other">
                    Other
                  </label>
                </div>
              </div>

              <!-- Address -->
              <div class="form-group">
                <label class="form-label">Current Address</label>
                <textarea name="address" required placeholder="Where are you coming from?" rows="3" class="form-input" style="resize:vertical;min-height:75px;line-height:1.65;"></textarea>
              </div>

              <div style="height:1px;background:#F0D5C0;margin:18px 0;"></div>
              <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#815854;margin:0 0 14px;">Stay Dates</p>

              <!-- Dates -->
              <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:4px;">
                <div class="form-group">
                  <label class="form-label">Check-in Date</label>
                  <input type="date" name="checkindate" required class="form-input" min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                  <label class="form-label">Check-out Date</label>
                  <input type="date" name="checkoutdate" required class="form-input" min="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>

              <!-- Notice -->
              <div style="display:flex;gap:10px;align-items:flex-start;background:#F9EBDE;border-radius:10px;padding:12px 14px;margin-bottom:18px;margin-top:6px;">
                <svg width="14" height="14" fill="#815854" viewBox="0 0 20 20" style="flex-shrink:0;margin-top:1px;">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <p style="font-family:'DM Sans',sans-serif;font-size:.7rem;color:#7a6860;margin:0;line-height:1.65;">We'll review your booking and send a confirmation. Usually within a few hours, never more than 24.</p>
              </div>

              <button type="submit" name="submit" class="book-btn">
                Confirm My Booking
              </button>
            </form>
          </div>
        </div>

        <!-- RIGHT: Side Info -->
        <div class="side-panel" style="display:flex;flex-direction:column;gap:18px;">

          <!-- Selected Room Card -->
          <?php if ($roomData): ?>
            <div class="room-info-card">
              <img src="admin/images/<?php echo $roomData->Image; ?>"
                alt="<?php echo htmlentities($roomData->RoomName ?? ''); ?>"
                style="width:100%;height:160px;object-fit:cover;display:block;"
                onerror="this.style.background='#F9EBDE'">
              <div style="padding:16px 18px;">
                <p style="font-family:'DM Sans',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#b09080;margin:0 0 5px;"><?php echo htmlentities($roomData->CategoryName); ?></p>
                <h3 style="font-family:'Playfair Display',serif;font-size:.9rem;font-weight:600;color:#3a2c28;margin:0 0 12px;"><?php echo htmlentities($roomData->RoomName ?? $roomData->FacilityTitle ?? 'Room'); ?></h3>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-top:1px solid #F0D5C0;border-bottom:1px solid #F0D5C0;margin-bottom:12px;">
                  <span style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#b09080;">Price / Night</span>
                  <span style="font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:#815854;">$<?php echo htmlentities($roomData->Price); ?></span>
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                  <span style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#6b5c56;background:#F9EBDE;padding:3px 9px;border-radius:6px;"><?php echo $roomData->MaxAdult; ?> Adults</span>
                  <span style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#6b5c56;background:#F9EBDE;padding:3px 9px;border-radius:6px;"><?php echo $roomData->MaxChild; ?> Children</span>
                  <span style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#6b5c56;background:#F9EBDE;padding:3px 9px;border-radius:6px;"><?php echo $roomData->NoofBed; ?> Bed(s)</span>
                </div>
              </div>
            </div>
          <?php else: ?>
            <div style="background:#fff;border-radius:16px;padding:24px 20px;text-align:center;box-shadow:0 4px 18px rgba(107,70,68,.07);">
              <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=560&q=80&auto=format&fit=crop"
                alt="Sea Horizon Hotel" width="560" height="320" loading="lazy"
                style="width:100%;height:140px;object-fit:cover;border-radius:10px;display:block;margin-bottom:12px;"
                onerror="this.style.display='none'">
              <p style="font-family:'Playfair Display',serif;font-size:.85rem;font-weight:600;color:#815854;margin:0;">Sea Horizon Hotel</p>
            </div>
          <?php endif; ?>

          <!-- How It Works -->
          <div style="background:#fff;border-radius:16px;padding:20px 18px;box-shadow:0 4px 18px rgba(107,70,68,.07);">
            <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#b09080;margin:0 0 14px;">How It Works</p>
            <?php
            $steps = [
              'Fill in your details above',
              'Hit "Confirm My Booking"',
              'We review and confirm within 24hrs',
              'Show your booking number at check-in',
            ];
            foreach ($steps as $i => $step): ?>
              <div class="step-item">
                <div class="step-num"><?= $i + 1 ?></div>
                <p style="font-family:'DM Sans',sans-serif;font-size:.73rem;color:#6b5c56;margin:0;line-height:1.6;"><?= $step ?></p>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Need Help -->
          <div style="background:linear-gradient(135deg,#815854,#6b4644);border-radius:14px;padding:18px 18px;text-align:center;">
            <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(249,235,222,.55);margin:0 0 6px;">Questions?</p>
            <p style="font-family:'DM Sans',sans-serif;font-size:.74rem;color:rgba(255,255,255,.7);margin:0 0 12px;line-height:1.65;">We're at the front desk around the clock.</p>
            <a href="contact.php" style="display:inline-block;font-family:'DM Sans',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#815854;background:#F9EBDE;border-radius:8px;padding:7px 18px;text-decoration:none;transition:background .2s;"
              onmouseover="this.style.background='#F0D5C0'" onmouseout="this.style.background='#F9EBDE'">
              Get in Touch
            </a>
          </div>

        </div>
      </div>
    </main>

    <style>
      @media(max-width:700px) {
        main>div {
          grid-template-columns: 1fr !important;
        }

        .side-panel {
          display: none;
        }

        .radio-group {
          flex-direction: column;
        }
      }
    </style>

    <?php include_once('includes/getintouch.php'); ?>
    <?php include_once('includes/footer.php'); ?>
  </body>

  </html>
<?php } ?>