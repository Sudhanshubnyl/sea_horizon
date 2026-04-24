<?php
session_start();
error_reporting(0);
// Redirect already logged-in users
if (strlen($_SESSION['hbmsuid']) != 0) {
  header('location:index.php');
  exit();
}

include('includes/dbconnection.php');

if (isset($_POST['submit'])) {
  $fname    = $_POST['fname'];
  $mobno    = $_POST['mobno'];
  $email    = $_POST['email'];
  $password = md5($_POST['password']);

  $ret   = "select Email from tbluser where Email=:email";
  $query = $dbh->prepare($ret);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->execute();

  if ($query->rowCount() == 0) {
    $sql   = "Insert Into tbluser(FullName,MobileNumber,Email,Password)Values(:fname,:mobno,:email,:password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',    $fname,    PDO::PARAM_STR);
    $query->bindParam(':email',    $email,    PDO::PARAM_STR);
    $query->bindParam(':mobno',    $mobno,    PDO::PARAM_INT);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    if ($lastInsertId) {
      // ✅ Auto-login: set session right here, no need to go to signin page
      $_SESSION['hbmsuid'] = $lastInsertId;
      $_SESSION['login']   = $email;

      // ✅ Redirect to home with a welcome message
      echo "<script>
                alert('Welcome to Sea Horizon! Your account is ready.');
                document.location = 'index.php';
            </script>";
    } else {
      echo "<script>alert('Something went wrong. Please try again.');</script>";
    }
  } else {
    echo "<script>alert('That email is already registered. Try signing in instead.');</script>";
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Sign Up</title>
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
    /* (same base styles as signin.php — copy all .auth-shell through .form-tagline) */
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
        transform: translateY(22px)
      }

      to {
        opacity: 1;
        transform: translateY(0)
      }
    }

    @keyframes slideInLeft {
      from {
        opacity: 0;
        transform: translateX(-28px)
      }

      to {
        opacity: 1;
        transform: translateX(0)
      }
    }

    @keyframes floatBadge {

      0%,
      100% {
        transform: translateY(0)
      }

      50% {
        transform: translateY(-7px)
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(.94)
      }

      to {
        opacity: 1;
        transform: scale(1)
      }
    }

    .auth-shell {
      display: flex;
      min-height: calc(100vh - 62px)
    }

    .hero-panel {
      display: none;
      flex: 1;
      position: relative;
      overflow: hidden
    }

    @media(min-width:900px) {
      .hero-panel {
        display: flex
      }
    }

    .hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.76) saturate(1.1);
      transition: transform 6s ease
    }

    .hero-panel:hover .hero-img {
      transform: scale(1.03)
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(107, 70, 68, .65) 0%, rgba(30, 16, 14, .82) 100%)
    }

    .hero-content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 52px 44px;
      animation: slideInLeft .7s cubic-bezier(.16, 1, .3, 1) both
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(255, 255, 255, .12);
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 50px;
      padding: 5px 14px;
      font-family: 'DM Sans', sans-serif;
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .85);
      width: fit-content;
      margin-bottom: 20px;
      animation: floatBadge 3.5s ease-in-out infinite
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.6rem, 3vw, 2.4rem);
      font-weight: 600;
      color: #fff;
      line-height: 1.25;
      margin-bottom: 14px
    }

    .hero-title em {
      font-style: italic;
      color: #F0D5C0
    }

    .hero-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: .8rem;
      color: rgba(255, 255, 255, .62);
      line-height: 1.75;
      max-width: 300px
    }

    .hero-feature {
      font-family: 'DM Sans', sans-serif;
      font-size: .63rem;
      font-weight: 500;
      color: rgba(255, 255, 255, .7);
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .15);
      border-radius: 50px;
      padding: 3px 10px
    }

    .hero-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .3)
    }

    .hero-dot.active {
      background: #F0D5C0;
      width: 18px;
      border-radius: 3px
    }

    .form-panel {
      flex: 0 0 auto;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 36px 20px;
      background: #F9EBDE
    }

    @media(min-width:900px) {
      .form-panel {
        width: 420px
      }
    }

    .form-card {
      width: 100%;
      max-width: 360px;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 40px rgba(107, 70, 68, .12);
      animation: scaleIn .55s cubic-bezier(.16, 1, .3, 1) both
    }

    .form-card-header {
      background: linear-gradient(135deg, #815854 0%, #6b4644 100%);
      padding: 28px 30px 26px;
      text-align: center;
      position: relative;
      overflow: hidden
    }

    .form-card-header::before {
      content: '';
      position: absolute;
      top: -40px;
      right: -40px;
      width: 120px;
      height: 120px;
      background: rgba(255, 255, 255, .06);
      border-radius: 50%
    }

    .form-card-header::after {
      content: '';
      position: absolute;
      bottom: -30px;
      left: -20px;
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, .04);
      border-radius: 50%
    }

    .form-icon-wrap {
      width: 50px;
      height: 50px;
      background: rgba(255, 255, 255, .18);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 14px;
      box-shadow: 0 0 0 6px rgba(255, 255, 255, .08);
      position: relative;
      z-index: 1
    }

    .form-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 600;
      color: #fff;
      position: relative;
      z-index: 1
    }

    .form-subtitle {
      font-family: 'DM Sans', sans-serif;
      font-size: .7rem;
      color: rgba(255, 255, 255, .58);
      margin-top: 5px;
      position: relative;
      z-index: 1
    }

    .form-body {
      padding: 26px 28px 28px
    }

    .form-label {
      display: block;
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      font-weight: 700;
      letter-spacing: .17em;
      text-transform: uppercase;
      color: #b09080;
      margin-bottom: 6px
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
      animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both
    }

    .form-input:focus {
      border-color: #815854;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(129, 88, 84, .1)
    }

    .form-input::placeholder {
      color: #c9b0a8
    }

    .form-group {
      margin-bottom: 14px
    }

    .form-group:nth-child(1) .form-input {
      animation-delay: .1s
    }

    .form-group:nth-child(2) .form-input {
      animation-delay: .18s
    }

    .form-group:nth-child(3) .form-input {
      animation-delay: .26s
    }

    .form-group:nth-child(4) .form-input {
      animation-delay: .34s
    }

    .form-btn {
      width: 100%;
      padding: 11px 20px;
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
      margin-top: 6px;
      box-shadow: 0 4px 16px rgba(129, 88, 84, .3);
      transition: transform .18s, box-shadow .18s
    }

    .form-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 22px rgba(129, 88, 84, .38)
    }

    .form-btn:active {
      transform: scale(.98)
    }

    .form-foot {
      text-align: center;
      font-family: 'DM Sans', sans-serif;
      font-size: .72rem;
      color: #b09080;
      margin-top: 18px
    }

    .form-foot a {
      color: #815854;
      font-weight: 600;
      text-decoration: none
    }

    .form-foot a:hover {
      text-decoration: underline
    }

    .form-tagline {
      text-align: center;
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      color: #c9b0a8;
      letter-spacing: .22em;
      text-transform: uppercase;
      margin-top: 18px
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

<body class="font-sans" style="background:#F9EBDE; min-height:100vh; display:flex; flex-direction:column;">

  <header><?php include_once('includes/header.php'); ?></header>

  <main class="flex-1">
    <div class="auth-shell">

      <!-- Left: Hotel Image -->
      <div class="hero-panel">
        <img class="hero-img"
          src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1200&q=80&auto=format&fit=crop"
          alt="Sea Horizon Hotel pool" width="1200" height="800" loading="eager"
          onerror="this.style.display='none'">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="hero-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="#F0D5C0">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
            Join Sea Horizon · Free
          </div>
          <h2 class="hero-title">
            First time here? <br><em>Let's get you sorted.</em>
          </h2>
          <p class="hero-desc">
            Takes barely a minute to register. Once you're in, you can browse rooms, make bookings, and manage everything from one place.
          </p>
          <div style="margin-top:24px;padding:18px;background:rgba(255,255,255,.09);border:1px solid rgba(255,255,255,.14);border-radius:12px;max-width:280px;">
            <p style="font-family:'DM Sans',sans-serif;font-size:.7rem;color:rgba(255,255,255,.8);line-height:1.7;margin:0;">
              "Stayed three nights, left wishing it was five. The staff just get it right every time."
            </p>
            <p style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:rgba(249,235,222,.5);margin:10px 0 0;font-weight:600;letter-spacing:.1em;">— Riya M., Mumbai</p>
          </div>
          <div style="display:flex;flex-wrap:wrap;gap:7px;margin-top:20px;">
            <span class="hero-feature">Easy Booking</span>
            <span class="hero-feature">Booking History</span>
            <span class="hero-feature">Member Perks</span>
          </div>
          <div style="display:flex;gap:6px;margin-top:20px;">
            <span class="hero-dot"></span>
            <span class="hero-dot active"></span>
            <span class="hero-dot"></span>
          </div>
        </div>
      </div>

      <!-- Right: Sign Up Form -->
      <div class="form-panel">
        <div style="width:100%;max-width:360px;">
          <div class="form-card">
            <div class="form-card-header">
              <div class="form-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                  <circle cx="9" cy="7" r="4" />
                  <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
              </div>
              <h2 class="form-title">Create Account</h2>
              <p class="form-subtitle">Join Sea Horizon today — it's free.</p>
            </div>
            <div class="form-body">
              <form method="post">
                <div class="form-group">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="fname" required placeholder="Your full name" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Mobile Number</label>
                  <input type="text" name="mobno" required maxlength="10" pattern="[0-9]+" placeholder="10-digit number" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" required placeholder="you@example.com" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" required placeholder="••••••••" class="form-input">
                </div>
                <button type="submit" name="submit" class="form-btn">Create My Account</button>
              </form>
              <p class="form-foot">Already a member? <a href="signin.php">Sign In</a></p>
            </div>
          </div>
          <p class="form-tagline">Sea Horizon Hotel · Est. 2010</p>
        </div>
      </div>
    </div>
  </main>

  <?php include_once('includes/getintouch.php'); ?>
  <?php include_once('includes/footer.php'); ?>
</body>

</html>