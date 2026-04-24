<?php
session_start();
error_reporting(0);
// Redirect already logged-in users
if (strlen($_SESSION['hbmsuid']) != 0) {
    header('location:index.php');
    exit();
}

include('includes/dbconnection.php');

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $sql = "SELECT ID FROM tbluser WHERE Email=:email and Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $_SESSION['hbmsuid'] = $result->ID;
    }
    $_SESSION['login'] = $_POST['email'];
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
  } else {
    echo "<script>alert('Invalid Details');</script>";
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Sign In</title>
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
      min-height: calc(100vh - 62px);
    }

    .hero-panel {
      display: none;
      flex: 1;
      position: relative;
      overflow: hidden;
    }

    @media(min-width:900px) {
      .hero-panel {
        display: flex;
      }
    }

    .hero-img {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      filter: brightness(.76) saturate(1.1);
      transition: transform 6s ease;
    }

    .hero-panel:hover .hero-img {
      transform: scale(1.03);
    }

    .hero-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(160deg, rgba(129, 88, 84, .62) 0%, rgba(40, 20, 18, .78) 100%);
    }

    .hero-content {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 52px 44px;
      animation: slideInLeft .7s cubic-bezier(.16, 1, .3, 1) both;
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
      animation: floatBadge 3.5s ease-in-out infinite;
    }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.6rem, 3vw, 2.4rem);
      font-weight: 600;
      color: #fff;
      line-height: 1.25;
      margin-bottom: 14px;
    }

    .hero-title em {
      font-style: italic;
      color: #F0D5C0;
    }

    .hero-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: .8rem;
      color: rgba(255, 255, 255, .62);
      line-height: 1.75;
      max-width: 300px;
    }

    .hero-feature {
      font-family: 'DM Sans', sans-serif;
      font-size: .63rem;
      font-weight: 500;
      color: rgba(255, 255, 255, .7);
      background: rgba(255, 255, 255, .1);
      border: 1px solid rgba(255, 255, 255, .15);
      border-radius: 50px;
      padding: 3px 10px;
    }

    .hero-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .3);
    }

    .hero-dot.active {
      background: #F0D5C0;
      width: 18px;
      border-radius: 3px;
    }

    .form-panel {
      flex: 0 0 auto;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 36px 20px;
      background: #F9EBDE;
    }

    @media(min-width:900px) {
      .form-panel {
        width: 420px;
      }
    }

    .form-card {
      width: 100%;
      max-width: 360px;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 40px rgba(107, 70, 68, .12);
      animation: scaleIn .55s cubic-bezier(.16, 1, .3, 1) both;
    }

    .form-card-header {
      background: linear-gradient(135deg, #815854 0%, #6b4644 100%);
      padding: 28px 30px 26px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .form-card-header::before {
      content: '';
      position: absolute;
      top: -40px;
      right: -40px;
      width: 120px;
      height: 120px;
      background: rgba(255, 255, 255, .06);
      border-radius: 50%;
    }

    .form-card-header::after {
      content: '';
      position: absolute;
      bottom: -30px;
      left: -20px;
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, .04);
      border-radius: 50%;
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
      z-index: 1;
    }

    .form-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 600;
      color: #fff;
      position: relative;
      z-index: 1;
    }

    .form-subtitle {
      font-family: 'DM Sans', sans-serif;
      font-size: .7rem;
      color: rgba(255, 255, 255, .58);
      margin-top: 5px;
      position: relative;
      z-index: 1;
    }

    .form-body {
      padding: 26px 28px 28px;
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
      animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
    }

    .form-input:focus {
      border-color: #815854;
      background: #fff;
      box-shadow: 0 0 0 3px rgba(129, 88, 84, .1);
    }

    .form-input::placeholder {
      color: #c9b0a8;
    }

    .form-group {
      margin-bottom: 14px;
    }

    .form-group:nth-child(1) .form-input {
      animation-delay: .1s;
    }

    .form-group:nth-child(2) .form-input {
      animation-delay: .18s;
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
      transition: transform .18s, box-shadow .18s;
    }

    .form-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 22px rgba(129, 88, 84, .38);
    }

    .form-btn:active {
      transform: scale(.98);
    }

    .form-foot {
      text-align: center;
      font-family: 'DM Sans', sans-serif;
      font-size: .72rem;
      color: #b09080;
      margin-top: 18px;
    }

    .form-foot a {
      color: #815854;
      font-weight: 600;
      text-decoration: none;
    }

    .form-foot a:hover {
      text-decoration: underline;
    }

    .form-tagline {
      text-align: center;
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      color: #c9b0a8;
      letter-spacing: .22em;
      text-transform: uppercase;
      margin-top: 18px;
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

      <!-- Left: Hotel Hero Image -->
      <div class="hero-panel">
        <img class="hero-img"
          src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=1200&q=80&auto=format&fit=crop"
          alt="Sea Horizon Hotel exterior" width="1200" height="800" loading="eager"
          onerror="this.style.display='none'">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="hero-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="#F0D5C0">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
            </svg>
            Sea Horizon · Est. 2010
          </div>
          <h2 class="hero-title">
            Been here a while? <br><em>Good to have you back.</em>
          </h2>
          <p class="hero-desc">
            Your room, your way. Everything's right where you left it — sign in and we'll take care of the rest.
          </p>
          <div style="display:flex;flex-wrap:wrap;gap:7px;margin-top:24px;">
            <span class="hero-feature">Sea View Rooms</span>
            <span class="hero-feature">Free Breakfast</span>
            <span class="hero-feature">Spa Access</span>
            <span class="hero-feature">Pool Deck</span>
          </div>
          <div style="display:flex;gap:6px;margin-top:24px;">
            <span class="hero-dot active"></span>
            <span class="hero-dot"></span>
            <span class="hero-dot"></span>
          </div>
        </div>
      </div>

      <!-- Right: Login Form -->
      <div class="form-panel">
        <div style="width:100%;max-width:360px;">
          <div class="form-card">
            <div class="form-card-header">
              <div class="form-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                  <circle cx="12" cy="7" r="4" />
                </svg>
              </div>
              <h2 class="form-title">Welcome Back</h2>
              <p class="form-subtitle">Sign in and let's get going.</p>
            </div>
            <div class="form-body">
              <form method="post">
                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" required placeholder="you@example.com" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input type="password" name="password" required placeholder="••••••••" class="form-input">
                </div>
                <div style="text-align:right;margin-bottom:14px;margin-top:-4px;">
                  <a href="forgot-password.php" style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:#815854;text-decoration:none;font-weight:500;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                    Forgot your password?
                  </a>
                </div>
                <button type="submit" name="login" class="form-btn">Sign In</button>
              </form>
              <p class="form-foot">New here? <a href="signup.php">Create an account</a></p>
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