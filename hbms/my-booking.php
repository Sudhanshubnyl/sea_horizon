<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
if (strlen($_SESSION['hbmsuid'] == 0)) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <title>Sea Horizon Hotel | My Bookings</title>
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

      @keyframes slideDown {
        from {
          opacity: 0;
          transform: translateY(-10px)
        }

        to {
          opacity: 1;
          transform: translateY(0)
        }
      }

      @keyframes scaleIn {
        from {
          opacity: 0;
          transform: scale(.97)
        }

        to {
          opacity: 1;
          transform: scale(1)
        }
      }

      @keyframes rowIn {
        from {
          opacity: 0;
          transform: translateX(-8px)
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

      .table-card {
        animation: scaleIn .5s cubic-bezier(.16, 1, .3, 1) both;
      }

      .tbl-row {
        animation: rowIn .35s cubic-bezier(.16, 1, .3, 1) both;
      }

      .tbl-row:nth-child(1) {
        animation-delay: .05s
      }

      .tbl-row:nth-child(2) {
        animation-delay: .1s
      }

      .tbl-row:nth-child(3) {
        animation-delay: .15s
      }

      .tbl-row:nth-child(4) {
        animation-delay: .2s
      }

      .tbl-row:nth-child(5) {
        animation-delay: .25s
      }

      .tbl-row:hover {
        background: rgba(249, 235, 222, .45);
      }

      .tbl-row td {
        transition: background .15s;
      }

      .view-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: .6rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #815854;
        border: 1.5px solid rgba(129, 88, 84, .3);
        border-radius: 8px;
        text-decoration: none;
        transition: all .2s;
      }

      .view-btn:hover {
        background: #815854;
        color: #fff;
        border-color: #815854;
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(129, 88, 84, .25);
      }

      .view-btn:active {
        transform: scale(.97);
      }

      .badge-pending {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: .58rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        background: #fffbeb;
        color: #d97706;
        border: 1px solid rgba(217, 119, 6, .2);
        border-radius: 50px;
      }

      .badge-confirmed {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: .58rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
        background: #f0fdf4;
        color: #16a34a;
        border: 1px solid rgba(22, 163, 74, .2);
        border-radius: 50px;
      }

      .dot-pulse {
        animation: pulse 1.5s ease-in-out infinite;
      }

      @keyframes pulse {

        0%,
        100% {
          opacity: 1
        }

        50% {
          opacity: .4
        }
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
        src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1400&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel room" width="1400" height="400" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          My Account
        </div>
        <h1 class="page-hero-title">My Bookings</h1>
        <p class="page-hero-sub">All your reservations, in one tidy place.</p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:1100px;margin:0 auto;padding:0 20px;">

        <div class="table-card" style="background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 4px 28px rgba(107,70,68,.09);">

          <!-- Table Header Bar -->
          <div style="padding:20px 24px 18px;border-bottom:1px solid #F0D5C0;display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;">
            <div>
              <h2 style="font-family:'Playfair Display',serif;font-size:.95rem;font-weight:600;color:#3a2c28;margin:0;">Booking History</h2>
              <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:#b09080;margin:4px 0 0;">Every room you've stayed in, or are about to.</p>
            </div>
            <a href="services.php" style="display:inline-flex;align-items:center;gap:6px;padding:6px 14px;font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:#815854;background:rgba(129,88,84,.07);border:1.5px solid rgba(129,88,84,.2);border-radius:8px;text-decoration:none;transition:all .2s;"
              onmouseover="this.style.background='#815854';this.style.color='#fff'" onmouseout="this.style.background='rgba(129,88,84,.07)';this.style.color='#815854'">
              <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M12 5v14M5 12l7-7 7 7" />
              </svg>
              Book a Room
            </a>
          </div>

          <!-- Responsive Table -->
          <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
              <thead>
                <tr style="background:rgba(249,235,222,.55);border-bottom:1px solid #F0D5C0;">
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">#</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Booking No.</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Name</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Mobile</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Email</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Status</th>
                  <th style="text-align:left;padding:11px 20px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $uid = $_SESSION['hbmsuid'];
                $sql = "SELECT tbluser.*,tblbooking.BookingNumber,tblbooking.Status,tblbooking.ID as bid from tblbooking join tbluser on tblbooking.UserID=tbluser.ID where UserID=:uid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':uid', $uid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $row) { ?>

                    <tr class="tbl-row" style="border-bottom:1px solid #F9EBDE;">
                      <td style="padding:13px 20px;font-family:'DM Sans',sans-serif;font-size:.72rem;color:#c9b0a8;">
                        <?php echo htmlentities($cnt); ?>
                      </td>
                      <td style="padding:13px 20px;">
                        <span style="font-family:'DM Sans',sans-serif;font-size:.72rem;font-weight:600;color:#5a4a44;background:#F9EBDE;padding:3px 10px;border-radius:6px;">
                          <?php echo htmlentities($row->BookingNumber); ?>
                        </span>
                      </td>
                      <td style="padding:13px 20px;font-family:'DM Sans',sans-serif;font-size:.76rem;font-weight:600;color:#4a3830;">
                        <?php echo htmlentities($row->FullName); ?>
                      </td>
                      <td style="padding:13px 20px;font-family:'DM Sans',sans-serif;font-size:.72rem;color:#7a6860;">
                        <?php echo htmlentities($row->MobileNumber); ?>
                      </td>
                      <td style="padding:13px 20px;font-family:'DM Sans',sans-serif;font-size:.72rem;color:#7a6860;">
                        <?php echo htmlentities($row->Email); ?>
                      </td>
                      <td style="padding:13px 20px;">
                        <?php if ($row->Status == "") { ?>
                          <span class="badge-pending">
                            <span class="dot-pulse" style="width:5px;height:5px;border-radius:50%;background:#d97706;display:inline-block;"></span>
                            Pending
                          </span>
                        <?php } else { ?>
                          <span class="badge-confirmed">
                            <span style="width:5px;height:5px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
                            <?php echo htmlentities($row->Status); ?>
                          </span>
                        <?php } ?>
                      </td>
                      <td style="padding:13px 20px;">
                        <a href="view-application-detail.php?viewid=<?php echo htmlentities($row->bid); ?>" class="view-btn">
                          <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                          </svg>
                          View
                        </a>
                      </td>
                    </tr>

                  <?php $cnt = $cnt + 1;
                  }
                } else { ?>

                  <!-- Empty State -->
                  <tr>
                    <td colspan="7" style="padding:64px 20px;text-align:center;">
                      <div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
                        <div style="width:52px;height:52px;background:#F9EBDE;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                          <svg width="22" height="22" fill="none" stroke="#815854" stroke-width="1.4" viewBox="0 0 24 24" stroke-linecap="round" style="opacity:.4;">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                          </svg>
                        </div>
                        <p style="font-family:'Playfair Display',serif;font-size:.9rem;color:#5a4a44;font-weight:500;margin:0;">Nothing here yet</p>
                        <p style="font-family:'DM Sans',sans-serif;font-size:.72rem;color:#b09080;margin:0;max-width:260px;line-height:1.6;">You haven't made any reservations. Go have a look at what we've got.</p>
                        <a href="services.php" style="margin-top:8px;display:inline-flex;align-items:center;gap:6px;padding:8px 20px;font-family:'DM Sans',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:#fff;background:#815854;border-radius:8px;text-decoration:none;box-shadow:0 3px 12px rgba(129,88,84,.25);">
                          Explore Rooms
                        </a>
                      </div>
                    </td>
                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </main>

    <?php include_once('includes/getintouch.php'); ?>
    <?php include_once('includes/footer.php'); ?>

  </body>

  </html>
<?php } ?>