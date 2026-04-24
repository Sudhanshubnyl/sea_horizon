<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (isset($_POST['submit'])) {
  $name   = $_POST['name'];
  $email  = $_POST['email'];
  $mobile = $_POST['mobile'];
  $msg    = $_POST['message'];
  $sql = "INSERT INTO tblcontact(Name,Email,MobileNumber,Message) VALUES(:name,:email,:mobile,:message)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':name',   $name,   PDO::PARAM_STR);
  $query->bindParam(':email',  $email,  PDO::PARAM_STR);
  $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query->bindParam(':message', $msg,    PDO::PARAM_STR);
  
  $query->execute();
  $lastId = $dbh->lastInsertId();
  if ($lastId) {
    echo "<script>alert('Thanks — we got your message. We usually reply within a day.');</script>";
  } else {
    echo "<script>alert('Something went wrong. Please try again.');</script>";
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Feedback</title>
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
      filter: brightness(.65) saturate(1.05);
    }

    .page-hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(129, 88, 84, .6) 0%, rgba(40, 20, 18, .75) 100%);
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
      animation: scaleIn .5s cubic-bezier(.16, 1, .3, 1) both;
    }

    .info-panel {
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
    }

    .form-input:focus {
      border-color: #815854;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(129, 88, 84, .1);
    }

    .form-input::placeholder {
      color: #c9b0a8;
    }

    .form-textarea {
      resize: vertical;
      min-height: 110px;
      line-height: 1.65;
    }

    .form-group {
      margin-bottom: 15px;
      animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
    }

    .form-group:nth-child(1) {
      animation-delay: .1s
    }

    .form-group:nth-child(2) {
      animation-delay: .17s
    }

    .form-group:nth-child(3) {
      animation-delay: .24s
    }

    .form-group:nth-child(4) {
      animation-delay: .31s
    }

    .send-btn {
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
    }

    .send-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 22px rgba(129, 88, 84, .36);
    }

    .send-btn:active {
      transform: scale(.98);
    }

    .info-item {
      display: flex;
      gap: 14px;
      padding: 16px 0;
      border-bottom: 1px solid #F0D5C0;
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .info-icon {
      width: 36px;
      height: 36px;
      background: rgba(129, 88, 84, .09);
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
  <div class="page-hero" style="height:220px;">
    <img class="page-hero-img"
      src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1400&q=80&auto=format&fit=crop"
      alt="Sea Horizon Hotel reception" width="1400" height="400" loading="eager"
      onerror="this.style.display='none'">
    <div class="page-hero-overlay"></div>
    <div class="page-hero-content">
      <div class="hero-badge">
        <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="#F0D5C0" stroke-width="2.5" stroke-linecap="round">
          <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
        </svg>
        Talk to Us
      </div>
      <h1 class="page-hero-title">Feedback & Contact</h1>
      <p class="page-hero-sub">A question, a complaint, a compliment — we want to hear all of it.</p>
      <div class="hero-divider"></div>
    </div>
  </div>

  <main class="flex-1 py-12">
    <div style="max-width:960px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start;">

      <!-- Form Card -->
      <div class="form-card" style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 4px 24px rgba(107,70,68,.09);">
        <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);padding:22px 28px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden;">
          <div style="position:absolute;top:-30px;right:-30px;width:90px;height:90px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
          <div style="width:40px;height:40px;background:rgba(255,255,255,.18);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;z-index:1;">
            <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
            </svg>
          </div>
          <div style="position:relative;z-index:1;">
            <h2 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#fff;margin:0;">Send a Message</h2>
            <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:rgba(255,255,255,.55);margin:4px 0 0;">We read every single message. Yes, really.</p>
          </div>
        </div>

        <div style="padding:26px 28px 28px;">
          <form method="post">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" required placeholder="Your name" class="form-input">
              </div>
              <div class="form-group">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mobile" required placeholder="10-digit number" class="form-input">
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" required placeholder="you@example.com" class="form-input">
            </div>
            <div class="form-group">
              <label class="form-label">Your Message</label>
              <textarea name="message" required placeholder="What's on your mind?" class="form-input form-textarea"></textarea>
            </div>
            <button type="submit" name="submit" class="send-btn">Send Message</button>
          </form>
        </div>
      </div>

      <!-- Info Panel -->
      <div class="info-panel" style="display:flex;flex-direction:column;gap:18px;">

        <!-- Hotel Image -->
        <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(107,70,68,.08);">
          <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=600&q=80&auto=format&fit=crop"
            alt="Sea Horizon Hotel" width="600" height="360" loading="lazy"
            style="width:100%;height:170px;object-fit:cover;display:block;" onerror="this.style.display='none'">
          <div style="padding:14px 18px;text-align:center;border-top:1px solid #F0D5C0;">
            <p style="font-family:'Playfair Display',serif;font-size:.85rem;font-weight:600;color:#815854;margin:0;">Sea Horizon Hotel</p>
            <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:#b09080;margin:5px 0 0;">Est. 2010</p>
          </div>
        </div>

        <!-- Contact Details -->
        <div style="background:#fff;border-radius:16px;padding:20px 18px;box-shadow:0 4px 20px rgba(107,70,68,.08);">
          <?php
          $sql = "SELECT * from tblpage where PageType='contactus'";
          $query = $dbh->prepare($sql);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          if ($query->rowCount() > 0) {
            foreach ($results as $row) { ?>
              <div class="info-item">
                <div class="info-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <div>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0 0 4px;">Address</p>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.74rem;color:#6b5c56;line-height:1.65;margin:0;"><?php echo strip_tags(html_entity_decode($row->PageDescription)); ?></p>
                </div>
              </div>
              <div class="info-item">
                <div class="info-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                </div>
                <div>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0 0 4px;">Phone</p>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.74rem;font-weight:600;color:#4a3830;margin:0 0 3px;">+<?php echo htmlentities($row->MobileNumber); ?></p>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.72rem;color:#6b5c56;margin:0;"><?php echo htmlentities($row->Email); ?></p>
                </div>
              </div>
              <div class="info-item">
                <div class="info-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                  </svg>
                </div>
                <div>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:#b09080;margin:0 0 5px;">Hours</p>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.72rem;color:#6b5c56;line-height:1.75;margin:0;">Front Desk — 24 hrs<br>Restaurant — 7am to 11pm<br>Spa & Pool — 6am to 10pm</p>
                </div>
              </div>
          <?php }
          } ?>
        </div>

      </div>
    </div>
  </main>

  <style>
    @media(max-width:720px) {
      main>div {
        grid-template-columns: 1fr !important;
      }

      .info-panel {
        display: none;
      }

      main>div>.form-card>div:last-child>form>div:first-child {
        grid-template-columns: 1fr !important;
      }
    }
  </style>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>