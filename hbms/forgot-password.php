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
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $newpassword = md5($_POST['newpassword']);
  $sql = "SELECT Email FROM tbluser WHERE Email=:email and MobileNumber=:mobile";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    $con = "update tbluser set Password=:newpassword where Email=:email and MobileNumber=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('Your Password succesfully changed');</script>";
  } else {
    echo "<script>alert('Email id or Mobile no is invalid');</script>";
  }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
  <title>Sea Horizon Hotel | Reset Password</title>
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
    /* same base styles as signin/signup — copy all .auth-shell → .form-tagline */
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
      background: linear-gradient(160deg, rgba(90, 60, 58, .7) 0%, rgba(25, 12, 10, .85) 100%)
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

    .form-divider {
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 14px 0
    }

    .form-divider-line {
      flex: 1;
      height: 1px;
      background: #F0D5C0
    }

    .form-divider-text {
      font-family: 'DM Sans', sans-serif;
      font-size: .58rem;
      font-weight: 600;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: #c9b0a8
    }

    .form-info {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      background: rgba(249, 235, 222, .7);
      border: 1px solid #F0D5C0;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 18px
    }

    .form-info p {
      font-family: 'DM Sans', sans-serif;
      font-size: .72rem;
      color: #7a6860;
      line-height: 1.65;
      margin: 0
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
  <!-- Existing password validation JS (untouched) -->
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("New Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body class="font-sans" style="background:#F9EBDE; min-height:100vh; display:flex; flex-direction:column;">

  <header><?php include_once('includes/header.php'); ?></header>

  <main class="flex-1">
    <div class="auth-shell">

      <!-- Left: Hotel Image -->
      <div class="hero-panel">
        <img class="hero-img"
          src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=1200&q=80&auto=format&fit=crop"
          alt="Sea Horizon Hotel luxury suite" width="1200" height="800" loading="eager"
          onerror="this.style.display='none'">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <div class="hero-badge">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#F0D5C0" stroke-width="2.5" stroke-linecap="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
            </svg>
            Secure Reset
          </div>
          <h2 class="hero-title">
            Forgot your password? <br><em>Relax, happens to everyone.</em>
          </h2>
          <p class="hero-desc">
            Just verify your email and the number you signed up with. Thirty seconds, tops. We'll get you back in.
          </p>
          <div style="margin-top:24px;display:flex;flex-direction:column;gap:10px;max-width:260px;">
            <?php foreach (['Enter your registered email', 'Confirm your mobile number', 'Set your new password'] as $i => $step): ?>
              <div style="display:flex;align-items:center;gap:12px;">
                <div style="width:28px;height:28px;background:rgba(249,235,222,.12);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                  <span style="font-family:'DM Sans',sans-serif;font-size:.65rem;font-weight:700;color:#F0D5C0;"><?= $i + 1 ?></span>
                </div>
                <p style="font-family:'DM Sans',sans-serif;font-size:.74rem;color:rgba(255,255,255,.7);margin:0;"><?= $step ?></p>
              </div>
            <?php endforeach; ?>
          </div>
          <div style="display:flex;gap:6px;margin-top:24px;">
            <span class="hero-dot"></span>
            <span class="hero-dot"></span>
            <span class="hero-dot active"></span>
          </div>
        </div>
      </div>

      <!-- Right: Reset Form -->
      <div class="form-panel">
        <div style="width:100%;max-width:360px;">
          <div class="form-card">
            <div class="form-card-header">
              <div class="form-icon-wrap">
                <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path d="M7 11V7a5 5 0 0110 0v4" />
                </svg>
              </div>
              <h2 class="form-title">Reset Password</h2>
              <p class="form-subtitle">Verify who you are, then we're good.</p>
            </div>
            <div class="form-body">
              <div class="form-info">
                <svg width="16" height="16" fill="#815854" viewBox="0 0 20 20" style="flex-shrink:0;margin-top:1px;">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <p>Enter the email and mobile number you registered with to reset your password.</p>
              </div>
              <form method="post" name="chngpwd" onSubmit="return valid();">
                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" required placeholder="you@example.com" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Mobile Number</label>
                  <input type="text" name="mobile" required placeholder="Registered mobile number" class="form-input">
                </div>
                <div class="form-divider">
                  <div class="form-divider-line"></div>
                  <span class="form-divider-text">New Password</span>
                  <div class="form-divider-line"></div>
                </div>
                <div class="form-group">
                  <label class="form-label">New Password</label>
                  <input type="password" name="newpassword" required placeholder="••••••••" class="form-input">
                </div>
                <div class="form-group">
                  <label class="form-label">Confirm Password</label>
                  <input type="password" name="confirmpassword" required placeholder="••••••••" class="form-input">
                </div>
                <button type="submit" name="submit" class="form-btn">Reset My Password</button>
              </form>
              <p class="form-foot">Remembered it? <a href="signin.php">Sign In</a></p>
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