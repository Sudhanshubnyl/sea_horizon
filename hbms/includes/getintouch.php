<style>
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(18px); }
  to   { opacity: 1; transform: translateY(0); }
}
.contact-card {
  flex: 1; min-width: 200px; max-width: 300px;
  background: rgba(255,255,255,.09);
  border: 1px solid rgba(255,255,255,.13);
  border-radius: 16px; padding: 28px 24px; text-align: center;
  transition: background .25s, transform .25s;
  animation: fadeInUp .6s cubic-bezier(.16,1,.3,1) both;
}
.contact-card:hover { background: rgba(255,255,255,.15); transform: translateY(-3px); }
.contact-card:nth-child(2) { animation-delay: .1s; }
.contact-card:nth-child(3) { animation-delay: .2s; }
.contact-icon {
  width:44px; height:44px; background:rgba(249,235,222,.13);
  border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px;
}
</style>

<section style="background:linear-gradient(135deg,#815854 0%,#6b4644 100%); padding:64px 20px;">
  <div style="max-width:960px; margin:0 auto;">
    <div style="text-align:center; margin-bottom:44px;">
      <p style="font-family:'DM Sans',sans-serif; font-size:.62rem; font-weight:700; letter-spacing:.28em; text-transform:uppercase; color:rgba(249,235,222,.5); margin-bottom:10px;">Reach Out</p>
      <h3 style="font-family:'Playfair Display',serif; font-size:1.8rem; font-weight:600; color:#fff; margin:0 0 14px;">Get In Touch</h3>
      <p style="font-family:'DM Sans',sans-serif; font-size:.8rem; color:rgba(255,255,255,.55); max-width:380px; margin:0 auto; line-height:1.7;">
        Got something on your mind? We're usually pretty quick to get back.
      </p>
      <div style="width:36px; height:1.5px; background:rgba(249,235,222,.3); margin:20px auto 0; border-radius:2px;"></div>
    </div>

    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:18px;">
      <?php
        $sql = "SELECT * from tblpage where PageType='contactus'";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) {
      ?>
      <div class="contact-card">
        <div class="contact-icon">
          <svg width="20" height="20" fill="none" stroke="#F9EBDE" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.6rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:rgba(249,235,222,.55); margin:0 0 10px;">Where to find us</p>
        <p style="font-family:'DM Sans',sans-serif; font-size:.78rem; color:rgba(255,255,255,.75); line-height:1.7; margin:0;">
          <?php echo strip_tags(html_entity_decode($row->PageDescription)); ?>
        </p>
      </div>

      <div class="contact-card">
        <div class="contact-icon">
          <svg width="20" height="20" fill="none" stroke="#F9EBDE" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
          </svg>
        </div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.6rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:rgba(249,235,222,.55); margin:0 0 5px;">Call us</p>
        <p style="font-family:'DM Sans',sans-serif; font-size:.7rem; color:rgba(249,235,222,.45); margin:0 0 12px;">We pick up.</p>
        <p style="font-family:'DM Sans',sans-serif; font-size:.82rem; font-weight:600; color:rgba(255,255,255,.85); margin:0 0 6px;">
          +<?php echo htmlentities($row->MobileNumber); ?>
        </p>
        <p style="font-family:'DM Sans',sans-serif; font-size:.78rem; color:rgba(255,255,255,.65); margin:0;">
          <?php echo htmlentities($row->Email); ?>
        </p>
      </div>

      <div class="contact-card">
        <div class="contact-icon">
          <svg width="20" height="20" fill="none" stroke="#F9EBDE" stroke-width="1.7" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
          </svg>
        </div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.6rem; font-weight:700; letter-spacing:.18em; text-transform:uppercase; color:rgba(249,235,222,.55); margin:0 0 10px;">We're around</p>
        <p style="font-family:'DM Sans',sans-serif; font-size:.78rem; color:rgba(255,255,255,.75); line-height:1.8; margin:0;">
          Front Desk — 24 hrs<br>
          Restaurant — 7am to 11pm<br>
          Spa & Pool — 6am to 10pm
        </p>
      </div>

      <?php $cnt = $cnt + 1; } } ?>
    </div>
  </div>
</section>