<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsuid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $uid = $_SESSION['hbmsuid'];
    $AName = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $sql = "update tbluser set FullName=:name,MobileNumber=:mobilenumber where ID=:uid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $AName, PDO::PARAM_STR);
    $query->bindParam(':mobilenumber', $mobno, PDO::PARAM_STR);
    $query->bindParam(':uid', $uid, PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Profile has been updated")</script>';
  }
?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <title>Sea Horizon Hotel | My Profile</title>
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
          transform: translateY(16px)
        }

        to {
          opacity: 1;
          transform: translateY(0)
        }
      }

      @keyframes slideLeft {
        from {
          opacity: 0;
          transform: translateX(-20px)
        }

        to {
          opacity: 1;
          transform: translateX(0)
        }
      }

      @keyframes slideRight {
        from {
          opacity: 0;
          transform: translateX(20px)
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

      @keyframes shimmer {
        0% {
          opacity: .6
        }

        50% {
          opacity: 1
        }

        100% {
          opacity: .6
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
        animation: slideLeft .55s cubic-bezier(.16, 1, .3, 1) both;
      }

      .side-panel {
        animation: slideRight .55s cubic-bezier(.16, 1, .3, 1) both;
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

      .form-input-readonly {
        background: #f8f5f2;
        border-color: #ece7e2;
        color: #b09080;
        cursor: not-allowed;
      }

      .form-group {
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

      .form-group:nth-child(4) {
        animation-delay: .36s
      }

      .update-btn {
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

      .update-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(129, 88, 84, .36);
      }

      .update-btn:active {
        transform: scale(.98);
      }

      .quick-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        transition: background .18s, color .18s;
        font-family: 'DM Sans', sans-serif;
        font-size: .76rem;
        color: #6b5c56;
      }

      .quick-link:hover {
        background: rgba(129, 88, 84, .07);
        color: #815854;
      }

      .quick-link-danger:hover {
        background: rgba(239, 68, 68, .06);
        color: #dc2626;
      }

      .quick-link svg {
        flex-shrink: 0;
      }

      .stat-pill {
        background: #fff;
        border: 1px solid #F0D5C0;
        border-radius: 12px;
        padding: 12px 16px;
        text-align: center;
        transition: box-shadow .2s;
      }

      .stat-pill:hover {
        box-shadow: 0 4px 16px rgba(129, 88, 84, .1);
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
    <div class="page-hero" style="height:200px;">
      <img class="page-hero-img"
        src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1400&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel lobby" width="1400" height="400" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 20 20" fill="#F0D5C0">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
          </svg>
          My Account
        </div>
        <h1 class="page-hero-title">My Profile</h1>
        <p class="page-hero-sub">Keep your details up to date — it helps us take better care of you.</p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:960px;margin:0 auto;padding:0 20px;">
        <div style="display:grid;grid-template-columns:1fr 280px;gap:24px;align-items:start;">

          <!-- LEFT: Form -->
          <div class="form-card" style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 4px 24px rgba(107,70,68,.08);">
            <!-- Card Header -->
            <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);padding:22px 28px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden;">
              <div style="position:absolute;top:-30px;right:-30px;width:90px;height:90px;background:rgba(255,255,255,.06);border-radius:50%;"></div>
              <div style="width:40px;height:40px;background:rgba(255,255,255,.18);border-radius:50%;display:flex;align-items:center;justify-content:center;ring:2px solid rgba(255,255,255,.25);flex-shrink:0;position:relative;z-index:1;">
                <svg width="18" height="18" fill="#fff" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
              </div>
              <div style="position:relative;z-index:1;">
                <h2 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#fff;margin:0;line-height:1.2;">Profile Information</h2>
                <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:rgba(255,255,255,.55);margin:4px 0 0;">Your name and number — that's all we need.</p>
              </div>
            </div>

            <!-- Form Body -->
            <div style="padding:26px 28px 28px;">
              <form method="post">
                <?php
                $uid = $_SESSION['hbmsuid'];
                $sql = "SELECT * from tbluser where ID=:uid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $row) { ?>

                    <div class="form-group" style="margin-bottom:16px;">
                      <label class="form-label">Full Name</label>
                      <input type="text" name="fname" required placeholder="Your full name" class="form-input"
                        value="<?php echo $row->FullName; ?>">
                    </div>

                    <div class="form-group" style="margin-bottom:16px;">
                      <label class="form-label">Mobile Number</label>
                      <input type="text" name="mobno" required maxlength="10" pattern="[0-9]+" class="form-input"
                        placeholder="10-digit number"
                        value="<?php echo $row->MobileNumber; ?>">
                    </div>

                    <div class="form-group" style="margin-bottom:16px;">
                      <label class="form-label">
                        Email Address
                        <span style="font-size:.55rem;font-weight:400;color:#c9b0a8;letter-spacing:.05em;text-transform:none;margin-left:6px;">(can't be changed)</span>
                      </label>
                      <input type="email" name="email" readonly class="form-input form-input-readonly"
                        value="<?php echo $row->Email; ?>">
                    </div>

                    <div class="form-group" style="margin-bottom:20px;">
                      <label class="form-label">Member Since</label>
                      <div style="display:flex;align-items:center;gap:8px;" class="form-input form-input-readonly">
                        <svg width="14" height="14" fill="none" stroke="#c9b0a8" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round">
                          <rect x="3" y="4" width="18" height="18" rx="2" />
                          <line x1="16" y1="2" x2="16" y2="6" />
                          <line x1="8" y1="2" x2="8" y2="6" />
                          <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                        <input type="text" readonly style="border:none;outline:none;background:transparent;font-family:'DM Sans',sans-serif;font-size:.82rem;color:#b09080;flex:1;"
                          value="<?php echo $row->RegDate; ?>">
                      </div>
                    </div>

                <?php $cnt = $cnt + 1;
                  }
                } ?>

                <button type="submit" name="submit" class="update-btn">
                  Save Changes
                </button>
              </form>
            </div>
          </div>

          <!-- RIGHT: Side Panel -->
          <div class="side-panel" style="display:flex;flex-direction:column;gap:16px;">

            <!-- Hotel Image Card -->
            <div style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(107,70,68,.08);">
              <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=560&q=80&auto=format&fit=crop"
                alt="Sea Horizon Hotel" width="560" height="320" loading="lazy"
                style="width:100%;height:180px;object-fit:cover;display:block;"
                onerror="this.style.display='none'">
              <div style="padding:14px 18px;text-align:center;border-top:1px solid #F0D5C0;">
                <p style="font-family:'Playfair Display',serif;font-size:.85rem;font-weight:600;color:#815854;margin:0;">Sea Horizon Hotel</p>
                <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:600;letter-spacing:.2em;text-transform:uppercase;color:#b09080;margin:5px 0 0;">Guest Member</p>
              </div>
            </div>

            <!-- Quick Stats -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
              <div class="stat-pill">
                <svg width="16" height="16" fill="none" stroke="#815854" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" style="margin:0 auto 6px;display:block;">
                  <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;color:#b09080;text-transform:uppercase;letter-spacing:.12em;margin:0;">My Bookings</p>
              </div>
              <div class="stat-pill">
                <svg width="16" height="16" fill="none" stroke="#815854" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round" style="margin:0 auto 6px;display:block;">
                  <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;color:#b09080;text-transform:uppercase;letter-spacing:.12em;margin:0;">Security</p>
              </div>
            </div>

            <!-- Quick Links -->
            <div style="background:#fff;border-radius:16px;padding:16px 14px;box-shadow:0 4px 20px rgba(107,70,68,.08);">
              <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#b09080;margin:0 0 12px;padding:0 8px;">Quick Links</p>
              <a href="my-booking.php" class="quick-link">
                <svg width="15" height="15" fill="none" stroke="#815854" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round">
                  <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                My Bookings
              </a>
              <a href="change-password.php" class="quick-link">
                <svg width="15" height="15" fill="none" stroke="#815854" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round">
                  <path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                Change Password
              </a>
              <div style="height:1px;background:#F0D5C0;margin:6px 8px;"></div>
              <a href="logout.php" class="quick-link quick-link-danger" style="color:#b09080;">
                <svg width="15" height="15" fill="none" stroke="#ef4444" stroke-width="1.5" viewBox="0 0 24 24" stroke-linecap="round">
                  <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span style="color:#ef4444;">Sign Out</span>
              </a>
            </div>

          </div>
        </div>
      </div>
    </main>

    <style>
      @media(max-width:720px) {
        main>div>div {
          grid-template-columns: 1fr !important;
        }

        .side-panel {
          display: none !important;
        }
      }
    </style>

    <?php include_once('includes/getintouch.php'); ?>
    <?php include_once('includes/footer.php'); ?>

  </body>

  </html>
<?php } ?>