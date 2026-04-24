<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsuid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $uid = $_SESSION['hbmsuid'];
    $currentpassword = md5($_POST['currentpassword']);
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT Password FROM tbluser WHERE ID=:uid and Password=:currentpassword";
    $query = $dbh->prepare($sql);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->bindParam(':currentpassword', $currentpassword, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tbluser set Password=:newpassword where ID=:uid";
      $chngpwd = $dbh->prepare($con);
      $chngpwd->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd->bindParam(':uid', $uid, PDO::PARAM_STR);
      $chngpwd->execute();
      echo "<script>alert('Password changed successfully');</script>";
    } else {
      echo "<script>alert('Your current password is incorrect');</script>";
    }
  }
?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <title>Sea Horizon Hotel | Change Password</title>
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
          transform: scale(.95)
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

      .pwd-card {
        animation: scaleIn .5s cubic-bezier(.16, 1, .3, 1) both;
        background: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 6px 32px rgba(107, 70, 68, .1);
      }

      .tips-card {
        animation: slideInL .55s cubic-bezier(.16, 1, .3, 1) both;
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

      .form-group {
        margin-bottom: 16px;
        animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
      }

      .form-group:nth-child(1) {
        animation-delay: .12s
      }

      .form-group:nth-child(2) {
        animation-delay: .2s
      }

      .form-group:nth-child(3) {
        animation-delay: .28s
      }

      .pwd-btn {
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
        box-shadow: 0 4px 16px rgba(129, 88, 84, .28);
        transition: transform .18s, box-shadow .18s;
      }

      .pwd-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(129, 88, 84, .36);
      }

      .pwd-btn:active {
        transform: scale(.98);
      }

      .tip-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 9px 0;
        border-bottom: 1px solid #F9EBDE;
      }

      .tip-item:last-child {
        border-bottom: none;
      }

      .tip-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #815854;
        flex-shrink: 0;
        margin-top: 5px;
        opacity: .5;
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
          alert("New Password and Confirm Password do not match!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
  </head>

  <body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

    <header><?php include_once('includes/header.php'); ?></header>

    <!-- Page Hero -->
    <div class="page-hero" style="height:200px;">
      <img class="page-hero-img"
        src="https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=1400&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel security" width="1400" height="400" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
          </svg>
          Security
        </div>
        <h1 class="page-hero-title">Change Password</h1>
        <p class="page-hero-sub">Keep your account safe — update your password whenever you feel like it.</p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:820px;margin:0 auto;padding:0 20px;display:grid;grid-template-columns:1fr 260px;gap:22px;align-items:start;">

        <!-- Password Form -->
        <div class="pwd-card">
          <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);padding:22px 28px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden;">
            <div style="position:absolute;top:-30px;right:-30px;width:90px;height:90px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
            <div style="width:40px;height:40px;background:rgba(255,255,255,.18);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;position:relative;z-index:1;">
              <svg width="18" height="18" fill="none" stroke="#fff" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                <path d="M7 11V7a5 5 0 0110 0v4" />
              </svg>
            </div>
            <div style="position:relative;z-index:1;">
              <h2 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#fff;margin:0;line-height:1.2;">Update Your Password</h2>
              <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:rgba(255,255,255,.55);margin:4px 0 0;">Confirm your current one first, then set the new one.</p>
            </div>
          </div>

          <div style="padding:26px 28px 28px;">
            <form method="post" name="chngpwd" onSubmit="return valid();">
              <div class="form-group">
                <label class="form-label">Current Password</label>
                <input type="password" name="currentpassword" required placeholder="Your existing password" class="form-input">
              </div>
              <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="newpassword" required placeholder="Something strong this time" class="form-input">
              </div>
              <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="confirmpassword" required placeholder="Same as above" class="form-input">
              </div>
              <button type="submit" name="submit" class="pwd-btn">Update Password</button>
            </form>

            <div style="margin-top:16px;display:flex;align-items:center;gap:8px;padding:12px 14px;background:#F9EBDE;border-radius:10px;">
              <svg width="14" height="14" fill="#815854" viewBox="0 0 20 20" style="flex-shrink:0;">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
              </svg>
              <p style="font-family:'DM Sans',sans-serif;font-size:.7rem;color:#7a6860;margin:0;line-height:1.6;">After changing your password, you'll still be signed in on this device.</p>
            </div>
          </div>
        </div>

        <!-- Tips Panel -->
        <div class="tips-card" style="background:#fff;border-radius:16px;padding:22px 20px;box-shadow:0 4px 20px rgba(107,70,68,.08);">
          <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#b09080;margin:0 0 16px;">Quick Tips</p>

          <div class="tip-item">
            <div class="tip-dot"></div>
            <p style="font-family:'DM Sans',sans-serif;font-size:.73rem;color:#6b5c56;margin:0;line-height:1.65;">Use at least 8 characters — mix letters, numbers, and symbols.</p>
          </div>
          <div class="tip-item">
            <div class="tip-dot"></div>
            <p style="font-family:'DM Sans',sans-serif;font-size:.73rem;color:#6b5c56;margin:0;line-height:1.65;">Avoid obvious ones like your name or "12345678".</p>
          </div>
          <div class="tip-item">
            <div class="tip-dot"></div>
            <p style="font-family:'DM Sans',sans-serif;font-size:.73rem;color:#6b5c56;margin:0;line-height:1.65;">Don't reuse passwords from other accounts.</p>
          </div>
          <div class="tip-item">
            <div class="tip-dot"></div>
            <p style="font-family:'DM Sans',sans-serif;font-size:.73rem;color:#6b5c56;margin:0;line-height:1.65;">A password manager makes all of this a lot easier.</p>
          </div>

          <div style="margin-top:20px;height:1px;background:#F0D5C0;"></div>

          <a href="profile.php" style="display:flex;align-items:center;gap:9px;margin-top:16px;font-family:'DM Sans',sans-serif;font-size:.72rem;font-weight:600;color:#815854;text-decoration:none;padding:9px 12px;border-radius:9px;transition:background .18s;"
            onmouseover="this.style.background='rgba(129,88,84,.07)'" onmouseout="this.style.background='transparent'">
            <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
              <circle cx="12" cy="7" r="4" />
            </svg>
            Back to Profile
          </a>
          <a href="my-booking.php" style="display:flex;align-items:center;gap:9px;font-family:'DM Sans',sans-serif;font-size:.72rem;font-weight:600;color:#815854;text-decoration:none;padding:9px 12px;border-radius:9px;transition:background .18s;"
            onmouseover="this.style.background='rgba(129,88,84,.07)'" onmouseout="this.style.background='transparent'">
            <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            My Bookings
          </a>
        </div>

      </div>
    </main>

    <style>
      @media(max-width:680px) {
        main>div {
          grid-template-columns: 1fr !important;
        }

        .tips-card {
          display: none;
        }
      }
    </style>

    <?php include_once('includes/getintouch.php'); ?>
    <?php include_once('includes/footer.php'); ?>
  </body>

  </html>
<?php } ?>