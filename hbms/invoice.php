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
    <title>Sea Horizon Hotel | Invoice</title>
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

      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(14px)
        }

        to {
          opacity: 1;
          transform: translateY(0)
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

      .invoice-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 6px 32px rgba(107, 70, 68, .12);
        animation: scaleIn .5s cubic-bezier(.16, 1, .3, 1) both;
      }

      .inv-section {
        padding: 26px 32px;
        border-bottom: 1px solid #F0D5C0;
        animation: fadeInUp .4s cubic-bezier(.16, 1, .3, 1) both;
      }

      .inv-section:nth-child(2) {
        animation-delay: .06s
      }

      .inv-section:nth-child(3) {
        animation-delay: .12s
      }

      .inv-section:nth-child(4) {
        animation-delay: .18s
      }

      .inv-section:last-child {
        border-bottom: none;
      }

      .inv-label {
        font-family: 'DM Sans', sans-serif;
        font-size: .58rem;
        font-weight: 700;
        letter-spacing: .18em;
        text-transform: uppercase;
        color: #b09080;
        margin: 0 0 5px;
      }

      .inv-val {
        font-family: 'DM Sans', sans-serif;
        font-size: .8rem;
        font-weight: 500;
        color: #4a3830;
        margin: 0;
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

      .print-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 26px;
        font-family: 'DM Sans', sans-serif;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        color: #fff;
        background: #815854;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        box-shadow: 0 4px 16px rgba(129, 88, 84, .28);
        transition: all .2s;
      }

      .print-btn:hover {
        background: #6b4644;
        transform: translateY(-1px);
        box-shadow: 0 6px 22px rgba(129, 88, 84, .35);
      }

      .print-btn:active {
        transform: scale(.98);
      }

      @media print {

        header,
        .no-print,
        #get-in-touch-section,
        footer {
          display: none !important
        }

        body {
          background: white !important
        }

        .invoice-card {
          box-shadow: none !important;
          border-radius: 0 !important
        }

        .inv-section {
          page-break-inside: avoid
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
    <!-- Existing print/close JS (untouched) -->
    <script language="javascript" type="text/javascript">
      function f2() {
        window.close();
      }

      function f3() {
        window.print();
      }
    </script>
  </head>

  <body class="font-sans min-h-screen flex flex-col" style="background:#F9EBDE;">

    <header class="no-print"><?php include_once('includes/header.php'); ?></header>

    <!-- Page Hero -->
    <div class="page-hero no-print" style="height:200px;">
      <img class="page-hero-img"
        src="https://images.unsplash.com/photo-1590490360182-c33d57733427?w=1400&q=80&auto=format&fit=crop"
        alt="Sea Horizon Hotel premium room" width="1400" height="400" loading="eager"
        onerror="this.style.display='none'">
      <div class="page-hero-overlay"></div>
      <div class="page-hero-content">
        <div class="hero-badge">
          <svg width="9" height="9" viewBox="0 0 24 24" fill="#F0D5C0">
            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Booking Receipt
        </div>
        <h1 class="page-hero-title">Invoice</h1>
        <p class="page-hero-sub">Your official receipt — save it, print it, keep it.</p>
        <div class="hero-divider"></div>
      </div>
    </div>

    <main class="flex-1 py-12">
      <div style="max-width:740px;margin:0 auto;padding:0 20px;display:flex;flex-direction:column;gap:18px;">

        <!-- Back Button -->
        <div class="no-print">
          <a href="my-booking.php" class="back-link">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round">
              <path d="M15 19l-7-7 7-7" />
            </svg>
            Back to My Bookings
          </a>
        </div>

        <?php
        $invid = $_GET['invid'];
        $sql = "SELECT tblbooking.BookingNumber,tbluser.FullName,DATEDIFF(tblbooking.CheckoutDate,tblbooking.CheckinDate) as ddf,tbluser.MobileNumber,tbluser.Email,tblbooking.IDType,tblbooking.Gender,tblbooking.Address,tblbooking.CheckinDate,tblbooking.CheckoutDate,tblbooking.BookingDate,tblbooking.Remark,tblbooking.Status,tblbooking.UpdationDate,tblcategory.CategoryName,tblcategory.Description,tblcategory.Price,tblroom.RoomName,tblroom.MaxAdult,tblroom.MaxChild,tblroom.RoomDesc,tblroom.NoofBed,tblroom.Image,tblroom.RoomFacility
from tblbooking
join tblroom on tblbooking.RoomId=tblroom.ID
join tblcategory on tblcategory.ID=tblroom.RoomType
join tbluser on tblbooking.UserID=tbluser.ID
where tblbooking.ID=:invid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':invid', $invid, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) { ?>

            <!-- Invoice Card -->
            <div class="invoice-card print-area">

              <!-- Invoice Header -->
              <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);padding:28px 32px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:16px;position:relative;overflow:hidden;">
                <div style="position:absolute;top:-40px;right:-40px;width:120px;height:120px;background:rgba(255,255,255,.05);border-radius:50%;"></div>
                <div style="position:relative;z-index:1;">
                  <p style="font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:rgba(249,235,222,.55);margin:0 0 6px;">Sea Horizon Hotel & Resort</p>
                  <h2 style="font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:700;color:#fff;margin:0;letter-spacing:.04em;">
                    #<?php echo $row->BookingNumber; ?>
                  </h2>
                  <p style="font-family:'DM Sans',sans-serif;font-size:.68rem;color:rgba(255,255,255,.5);margin:6px 0 0;">Booking Date: <?php echo $row->BookingDate; ?></p>
                </div>
                <div style="position:relative;z-index:1;display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
                  <p style="font-family:'DM Sans',sans-serif;font-size:.55rem;font-weight:700;letter-spacing:.18em;text-transform:uppercase;color:rgba(249,235,222,.45);margin:0;">Status</p>
                  <?php if ($row->Status == "Approved") { ?>
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:rgba(34,197,94,.15);color:#86efac;border:1px solid rgba(134,239,172,.25);border-radius:50px;">
                      <span style="width:6px;height:6px;border-radius:50%;background:#86efac;display:inline-block;"></span>Approved
                    </span>
                  <?php } elseif ($row->Status == "Cancelled") { ?>
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:rgba(239,68,68,.15);color:#fca5a5;border:1px solid rgba(252,165,165,.25);border-radius:50px;">
                      <span style="width:6px;height:6px;border-radius:50%;background:#fca5a5;display:inline-block;"></span>Cancelled
                    </span>
                  <?php } else { ?>
                    <span style="display:inline-flex;align-items:center;gap:6px;padding:5px 12px;font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;background:rgba(251,191,36,.15);color:#fde68a;border:1px solid rgba(253,230,138,.25);border-radius:50px;">
                      <span style="width:6px;height:6px;border-radius:50%;background:#fde68a;display:inline-block;animation:dotpulse 1.5s ease-in-out infinite;"></span>Pending
                    </span>
                  <?php } ?>
                </div>
              </div>

              <!-- Guest Information -->
              <div class="inv-section">
                <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#815854;margin:0 0 18px;">Guest Information</p>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px 32px;">
                  <div>
                    <p class="inv-label">Customer Name</p>
                    <p class="inv-val"><?php echo $row->FullName; ?></p>
                  </div>
                  <div>
                    <p class="inv-label">Mobile Number</p>
                    <p class="inv-val"><?php echo $row->MobileNumber; ?></p>
                  </div>
                  <div>
                    <p class="inv-label">Email Address</p>
                    <p class="inv-val"><?php echo $row->Email; ?></p>
                  </div>
                  <div>
                    <p class="inv-label">Booking Date</p>
                    <p class="inv-val"><?php echo $row->BookingDate; ?></p>
                  </div>
                </div>
              </div>

              <div style="margin:0 32px;height:1px;background:#F0D5C0;"></div>

              <!-- Room Information -->
              <div class="inv-section">
                <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#815854;margin:0 0 18px;">Room Information</p>
                <div style="display:flex;gap:20px;flex-wrap:wrap;align-items:flex-start;">
                  <div style="width:120px;flex-shrink:0;border-radius:10px;overflow:hidden;border:1px solid #F0D5C0;">
                    <img src="admin/images/<?php echo $row->Image; ?>"
                      alt="Room" style="width:100%;height:96px;object-fit:cover;display:block;">
                  </div>
                  <div style="flex:1;min-width:200px;display:grid;grid-template-columns:1fr 1fr;gap:14px 28px;">
                    <div>
                      <p class="inv-label">Room Type</p>
                      <p class="inv-val"><?php echo $row->CategoryName; ?></p>
                    </div>
                    <div>
                      <p class="inv-label">Room Name</p>
                      <p class="inv-val"><?php echo $row->RoomName; ?></p>
                    </div>
                    <div>
                      <p class="inv-label">Check-in</p>
                      <p class="inv-val" style="color:#16a34a;font-weight:600;"><?php echo $row->CheckinDate; ?></p>
                    </div>
                    <div>
                      <p class="inv-label">Check-out</p>
                      <p class="inv-val" style="color:#dc2626;font-weight:600;"><?php echo $row->CheckoutDate; ?></p>
                    </div>
                    <div>
                      <p class="inv-label">Price / Day</p>
                      <p class="inv-val" style="color:#815854;font-weight:700;">$<?php echo $row->Price; ?></p>
                    </div>
                    <div>
                      <p class="inv-label">Total Days</p>
                      <p class="inv-val"><?php echo $row->ddf; ?> day(s)</p>
                    </div>
                  </div>
                </div>
              </div>

              <div style="margin:0 32px;height:1px;background:#F0D5C0;"></div>

              <!-- Invoice Summary -->
              <div class="inv-section">
                <p style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:#815854;margin:0 0 16px;">Invoice Summary</p>

                <div style="border:1px solid #F0D5C0;border-radius:12px;overflow:hidden;">
                  <div style="display:grid;grid-template-columns:1fr 1fr 1fr;background:rgba(249,235,222,.6);border-bottom:1px solid #F0D5C0;">
                    <div style="padding:10px 16px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;text-align:center;">Total Days</div>
                    <div style="padding:10px 16px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;text-align:center;border-left:1px solid #F0D5C0;border-right:1px solid #F0D5C0;">Room Price / Day</div>
                    <div style="padding:10px 16px;font-family:'DM Sans',sans-serif;font-size:.58rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase;color:#b09080;text-align:center;">Total Amount</div>
                  </div>
                  <?php
                  $ddf = $row->ddf;
                  $tp  = $row->Price;
                  $total = $ddf * $tp;
                  $grandtotal += $total;
                  ?>
                  <div style="display:grid;grid-template-columns:1fr 1fr 1fr;background:#fff;">
                    <div style="padding:14px 16px;font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:600;color:#4a3830;text-align:center;"><?php echo $ddf; ?></div>
                    <div style="padding:14px 16px;font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:600;color:#4a3830;text-align:center;border-left:1px solid #F9EBDE;border-right:1px solid #F9EBDE;">$<?php echo $tp; ?></div>
                    <div style="padding:14px 16px;font-family:'DM Sans',sans-serif;font-size:.82rem;font-weight:600;color:#4a3830;text-align:center;">$<?php echo $total; ?></div>
                  </div>
                </div>

                <!-- Grand Total -->
                <div style="margin-top:16px;display:flex;justify-content:flex-end;">
                  <div style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%);border-radius:12px;padding:14px 28px;display:flex;align-items:center;gap:20px;box-shadow:0 4px 16px rgba(129,88,84,.25);">
                    <span style="font-family:'DM Sans',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:rgba(249,235,222,.6);">Grand Total</span>
                    <span style="font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:700;color:#fff;">$<?php echo $grandtotal; ?></span>
                  </div>
                </div>
              </div>

              <!-- Invoice Footer -->
              <div style="background:rgba(249,235,222,.45);border-top:1px solid #F0D5C0;padding:14px 32px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:8px;">
                <p style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#b09080;font-style:italic;margin:0;">Thanks for choosing Sea Horizon — genuinely means a lot.</p>
                <p style="font-family:'DM Sans',sans-serif;font-size:.62rem;color:#c9b0a8;margin:0;">hotelseahorizon@gmail.com</p>
              </div>

            </div>
            <!-- End Invoice Card -->

        <?php $cnt = $cnt + 1;
          }
        } ?>

        <!-- Print Button -->
        <div style="display:flex;justify-content:center;" class="no-print">
          <input name="Submit2" type="submit" value="Print Invoice"
            onClick="return f3();"
            class="print-btn"
            style="background:linear-gradient(135deg,#815854,#6b4644);border:none;color:#fff;cursor:pointer;">
        </div>

      </div>
    </main>

    <style>
      @keyframes dotpulse {

        0%,
        100% {
          opacity: 1
        }

        50% {
          opacity: .3
        }
      }

      @media(max-width:500px) {
        .inv-section>div {
          grid-template-columns: 1fr !important;
        }
      }
    </style>

    <div id="get-in-touch-section">
      <?php include_once('includes/getintouch.php'); ?>
    </div>
    <?php include_once('includes/footer.php'); ?>

  </body>

  </html>
<?php } ?>