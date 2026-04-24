<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hbmsuid'] == 0)) {
  header('location:logout.php');
} else {
?>
  <!DOCTYPE HTML>
  <html lang="en">

  <head>
    <title>Sea Horizon Hotel | Booking Detail</title>
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

      .detail-section {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(107, 70, 68, .08);
        animation: scaleIn .45s cubic-bezier(.16, 1, .3, 1) both;
      }

      .detail-section:nth-child(2) {
        animation-delay: .06s
      }

      .detail-section:nth-child(3) {
        animation-delay: .12s
      }

      .detail-section:nth-child(4) {
        animation-delay: .18s
      }

      .detail-section:nth-child(5) {
        animation-delay: .24s
      }

      .section-hdr {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 22px;
        border-bottom: 1px solid #F0D5C0;
        background: rgba(249, 235, 222, .4);
      }

      .section-hdr-icon {
        width: 32px;
        height: 32px;
        background: rgba(129, 88, 84, .1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
      }

      .section-hdr-title {
        font-family: 'Playfair Display', serif;
        font-size: .85rem;
        font-weight: 600;
        color: #3a2c28;
        margin: 0;
      }

      .detail-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 22px;
        border-bottom: 1px solid #F9EBDE;
      }

      .detail-row:last-child {
        border-bottom: none;
      }

      .detail-key {
        font-family: 'DM Sans', sans-serif;
        font-size: .58rem;
        font-weight: 700;
        letter-spacing: .16em;
        text-transform: uppercase;
        color: #b09080;
      }

      .detail-val {
        font-family: 'DM Sans', sans-serif;
        font-size: .76rem;
        font-weight: 500;
        color: #4a3830;
        text-align: right;
        max-width: 60%;
      }

      .back-link {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-family: 'DM Sans', sans-serif;
        font-size: .7rem;
        font-weight: 600;
        color: #815854;
        text-decoration: none;
        transition: color .2s;
      }

      .back-link:hover {
        color: #6b4644;
      }

      .back-link:hover svg {
        transform: translateX(-2px);
      }

      .back-link svg {
        transition: transform .2s;
      }

      .dot-pulse {
        animation: dotpulse 1.5s ease-in-out infinite;
      }

      @keyframes dotpulse {

        0%,
        100% {
          opacity: 1
        }

        50% {
          opacity: .3
        }
      }

      .invoice-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        font-family: 'DM Sans', sans-serif;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #fff;
        background: #815854;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(129, 88, 84, .28);
        transition: all .2s;
      }

      .invoice-btn:hover {
        background: #6b4644;
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(129, 88, 84, .35);
      }

      .invoice-btn:active {
        transform: scale(.98);
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
        src="https://images.unsplash.com/photo-1618773928121-c32242e63f39?w=1400&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel bedroom" width="1400" height="400" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          My Account
        </div>
        <h1 class="page-hero-title">Booking Detail</h1>
        <p class="page-hero-sub">Everything about your reservation, right here.</p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:820px;margin:0 auto;padding:0 20px;display:flex;flex-direction:column;gap:18px;">

        <!-- Back Link -->
        <a href="my-booking.php" class="back-link">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
            <path d="M15 19l-7-7 7-7" />
          </svg>
          Back to My Bookings
        </a>

        <?php
        $vid = $_GET['viewid'];
        $sql = "SELECT tblbooking.BookingNumber,tbluser.FullName,tbluser.MobileNumber,tbluser.Email,tblbooking.ID as tid,tblbooking.IDType,tblbooking.Gender,tblbooking.Address,tblbooking.CheckinDate,tblbooking.CheckoutDate,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblcategory.CategoryName,tblcategory.Description,tblcategory.Price,tblroom.RoomName,tblroom.MaxAdult,tblroom.MaxChild,tblroom.RoomDesc,tblroom.NoofBed,tblroom.Image,tblroom.RoomFacility
from tblbooking
join tblroom on tblbooking.RoomId=tblroom.ID
join tblcategory on tblcategory.ID=tblroom.RoomType
join tbluser on tblbooking.UserID=tbluser.ID
where tblbooking.ID=:vid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vid', $vid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) { ?>

            <!-- Booking Reference Banner -->
            <div class="detail-section">
              <div style="padding:20px 24px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:14px;">
                <div>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#b09080;margin:0 0 6px;">Booking Reference</p>
                  <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:700;color:#815854;margin:0;letter-spacing:.03em;">
                    #<?php echo $row->BookingNumber; ?>
                  </h2>
                </div>
                <div>
                  <?php if ($row->Status == "") { ?>
                    <span style="display:inline-flex;align-items:center;gap:7px;padding:6px 14px;font-family:'DM Sans',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:#fffbeb;color:#d97706;border:1px solid rgba(217,119,6,.2);border-radius:50px;">
                      <span class="dot-pulse" style="width:7px;height:7px;border-radius:50%;background:#d97706;display:inline-block;"></span>
                      Awaiting Confirmation
                    </span>
                  <?php } elseif ($row->Status == "Approved") { ?>
                    <span style="display:inline-flex;align-items:center;gap:7px;padding:6px 14px;font-family:'DM Sans',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:#f0fdf4;color:#16a34a;border:1px solid rgba(22,163,74,.2);border-radius:50px;">
                      <span style="width:7px;height:7px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
                      Approved
                    </span>
                  <?php } elseif ($row->Status == "Cancelled") { ?>
                    <span style="display:inline-flex;align-items:center;gap:7px;padding:6px 14px;font-family:'DM Sans',sans-serif;font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:#fef2f2;color:#dc2626;border:1px solid rgba(220,38,38,.2);border-radius:50px;">
                      <span style="width:7px;height:7px;border-radius:50%;background:#dc2626;display:inline-block;"></span>
                      Cancelled
                    </span>
                  <?php } ?>
                </div>
              </div>
            </div>

            <!-- Guest Details -->
            <div class="detail-section">
              <div class="section-hdr">
                <div class="section-hdr-icon">
                  <svg width="14" height="14" fill="#815854" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                  </svg>
                </div>
                <h3 class="section-hdr-title">Guest Details</h3>
              </div>
              <div style="display:grid;grid-template-columns:1fr 1fr;">
                <div style="border-right:1px solid #F9EBDE;">
                  <div class="detail-row"><span class="detail-key">Full Name</span><span class="detail-val"><?php echo $row->FullName; ?></span></div>
                  <div class="detail-row"><span class="detail-key">Email</span><span class="detail-val"><?php echo $row->Email; ?></span></div>
                  <div class="detail-row"><span class="detail-key">Gender</span><span class="detail-val"><?php echo $row->Gender; ?></span></div>
                  <div class="detail-row"><span class="detail-key">Check-in</span><span class="detail-val" style="color:#16a34a;font-weight:600;"><?php echo $row->CheckinDate; ?></span></div>
                </div>
                <div>
                  <div class="detail-row"><span class="detail-key">Mobile</span><span class="detail-val"><?php echo $row->MobileNumber; ?></span></div>
                  <div class="detail-row"><span class="detail-key">ID Type</span><span class="detail-val"><?php echo $row->IDType; ?></span></div>
                  <div class="detail-row"><span class="detail-key">Address</span><span class="detail-val"><?php echo $row->Address; ?></span></div>
                  <div class="detail-row"><span class="detail-key">Check-out</span><span class="detail-val" style="color:#dc2626;font-weight:600;"><?php echo $row->CheckoutDate; ?></span></div>
                </div>
              </div>
            </div>

            <!-- Room Details -->
            <div class="detail-section">
              <div class="section-hdr">
                <div class="section-hdr-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                  </svg>
                </div>
                <h3 class="section-hdr-title">Room Details</h3>
              </div>
              <div style="display:flex;flex-wrap:wrap;">
                <!-- Room Image -->
                <div style="width:180px;flex-shrink:0;border-right:1px solid #F0D5C0;">
                  <img src="admin/images/<?php echo $row->Image; ?>"
                    alt="<?php echo $row->RoomName; ?>"
                    style="width:100%;height:160px;object-fit:cover;display:block;">
                </div>
                <!-- Room Fields -->
                <div style="flex:1;min-width:200px;">
                  <div style="display:grid;grid-template-columns:1fr 1fr;border-bottom:1px solid #F9EBDE;">
                    <div style="padding:12px 18px;border-right:1px solid #F9EBDE;">
                      <p class="detail-key" style="margin:0 0 5px;">Room Type</p>
                      <p style="font-family:'DM Sans',sans-serif;font-size:.78rem;font-weight:600;color:#4a3830;margin:0;"><?php echo $row->CategoryName; ?></p>
                    </div>
                    <div style="padding:12px 18px;">
                      <p class="detail-key" style="margin:0 0 5px;">Price / Day</p>
                      <p style="font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:700;color:#815854;margin:0;">$<?php echo $row->Price; ?></p>
                    </div>
                  </div>
                  <div style="display:grid;grid-template-columns:1fr 1fr;border-bottom:1px solid #F9EBDE;">
                    <div style="padding:12px 18px;border-right:1px solid #F9EBDE;">
                      <p class="detail-key" style="margin:0 0 5px;">Room Name</p>
                      <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#4a3830;margin:0;"><?php echo $row->RoomName; ?></p>
                    </div>
                    <div style="padding:12px 18px;">
                      <p class="detail-key" style="margin:0 0 5px;">Booking Date</p>
                      <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#4a3830;margin:0;"><?php echo $row->BookingDate; ?></p>
                    </div>
                  </div>
                  <div style="display:grid;grid-template-columns:1fr 1fr 1fr;">
                    <div style="padding:12px 18px;text-align:center;border-right:1px solid #F9EBDE;">
                      <p class="detail-key" style="margin:0 0 4px;">Max Adults</p>
                      <p style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#3a2c28;margin:0;"><?php echo $row->MaxAdult; ?></p>
                    </div>
                    <div style="padding:12px 18px;text-align:center;border-right:1px solid #F9EBDE;">
                      <p class="detail-key" style="margin:0 0 4px;">Max Child</p>
                      <p style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#3a2c28;margin:0;"><?php echo $row->MaxChild; ?></p>
                    </div>
                    <div style="padding:12px 18px;text-align:center;">
                      <p class="detail-key" style="margin:0 0 4px;">No. of Beds</p>
                      <p style="font-family:'Playfair Display',serif;font-size:1.2rem;font-weight:700;color:#3a2c28;margin:0;"><?php echo $row->NoofBed; ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <div style="padding:12px 18px;border-top:1px solid #F0D5C0;background:rgba(249,235,222,.3);">
                <p class="detail-key" style="margin:0 0 5px;">Room Facilities</p>
                <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#6b5c56;margin:0;line-height:1.6;"><?php echo $row->RoomFacility; ?></p>
              </div>
            </div>

            <!-- Admin Remarks -->
            <div class="detail-section">
              <div class="section-hdr">
                <div class="section-hdr-icon">
                  <svg width="14" height="14" fill="none" stroke="#815854" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
                <h3 class="section-hdr-title">Admin Remarks</h3>
              </div>
              <div style="display:grid;grid-template-columns:1fr 1fr;border-top:1px solid #F9EBDE;">
                <div style="padding:18px 22px;border-right:1px solid #F9EBDE;">
                  <p class="detail-key" style="margin:0 0 10px;">Final Status</p>
                  <?php if ($row->Status == "Approved") { ?>
                    <div style="display:flex;align-items:center;gap:8px;">
                      <span style="width:8px;height:8px;border-radius:50%;background:#16a34a;display:inline-block;"></span>
                      <span style="font-family:'DM Sans',sans-serif;font-size:.76rem;font-weight:600;color:#16a34a;">Your booking's been approved — you're all set.</span>
                    </div>
                  <?php } elseif ($row->Status == "Cancelled") { ?>
                    <div style="display:flex;align-items:center;gap:8px;">
                      <span style="width:8px;height:8px;border-radius:50%;background:#dc2626;display:inline-block;"></span>
                      <span style="font-family:'DM Sans',sans-serif;font-size:.76rem;font-weight:600;color:#dc2626;">This one got cancelled. Feel free to rebook.</span>
                    </div>
                  <?php } elseif ($row->Status == "") { ?>
                    <div style="display:flex;align-items:center;gap:8px;">
                      <span class="dot-pulse" style="width:8px;height:8px;border-radius:50%;background:#d97706;display:inline-block;"></span>
                      <span style="font-family:'DM Sans',sans-serif;font-size:.76rem;font-weight:500;color:#d97706;">Still waiting on a response — shouldn't be long.</span>
                    </div>
                  <?php } ?>
                </div>
                <div style="padding:18px 22px;">
                  <p class="detail-key" style="margin:0 0 10px;">Admin Note</p>
                  <?php if ($row->Status == "") { ?>
                    <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#c9b0a8;font-style:italic;margin:0;">Nothing added yet.</p>
                  <?php } else { ?>
                    <p style="font-family:'DM Sans',sans-serif;font-size:.76rem;color:#6b5c56;line-height:1.7;margin:0;"><?php echo htmlentities($row->Remark); ?></p>
                  <?php } ?>
                </div>
              </div>
            </div>

            <!-- Invoice Button -->
            <div style="display:flex;justify-content:flex-end;">
              <a href="invoice.php?invid=<?php echo htmlentities($row->tid); ?>" class="invoice-btn">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round">
                  <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Download Invoice
              </a>
            </div>

        <?php $cnt = $cnt + 1;
          }
        } ?>

      </div>
    </main>

    <style>
      @media(max-width:600px) {
        .detail-section>div>div {
          grid-template-columns: 1fr !important;
        }

        .detail-section>div>div>div {
          border-right: none !important;
          border-bottom: 1px solid #F9EBDE;
        }
      }
    </style>

    <?php include_once('includes/getintouch.php'); ?>
    <?php include_once('includes/footer.php'); ?>

  </body>

  </html>
<?php } ?>