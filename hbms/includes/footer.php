<footer style="background:#F9EBDE; border-top:1px solid #F0D5C0;">
  <div style="max-width:1100px; margin:0 auto; padding:40px 24px 28px;">

    <div style="display:grid; grid-template-columns:1.4fr 1fr 1fr; gap:36px; padding-bottom:32px; border-bottom:1px solid #F0D5C0;">

      <div>
        <div style="display:flex; align-items:center; gap:9px; margin-bottom:14px;">
          <div style="width:28px; height:28px; background:#815854; border-radius:7px; display:flex; align-items:center; justify-content:center;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 22V12h6v10M3 9h18"/></svg>
          </div>
          <span style="font-family:'Playfair Display',serif; font-size:.95rem; font-weight:700; color:#815854;">Sea Horizon Hotel</span>
        </div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.76rem; color:#9a7c74; line-height:1.8; max-width:240px; margin:0 0 18px;">
          A quiet place by the sea. We've been looking after guests since 2010, and we still love what we do.
        </p>
        <div style="width:32px; height:2px; background:#815854; border-radius:2px; opacity:.4;"></div>
      </div>

      <div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.6rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:#b09080; margin:0 0 14px;">Quick Links</p>
        <?php
        $links = ['Home'=>'index.php','About Us'=>'about.php','Facilities'=>'services.php','Gallery'=>'gallery.php','Feedback'=>'contact.php'];
        foreach ($links as $label => $href):
        ?>
        <a href="<?= $href ?>" style="display:block; font-family:'DM Sans',sans-serif; font-size:.76rem; color:#7a6860; text-decoration:none; padding:3px 0; transition:color .2s;"
           onmouseover="this.style.color='#815854'" onmouseout="this.style.color='#7a6860'">
          <?= $label ?>
        </a>
        <?php endforeach; ?>
      </div>

      <div>
        <p style="font-family:'DM Sans',sans-serif; font-size:.6rem; font-weight:700; letter-spacing:.2em; text-transform:uppercase; color:#b09080; margin:0 0 14px;">Guest Info</p>
        <?php
        $info = ['Book a Room'=>'category-details.php','My Bookings'=>'my-booking.php','Sign In'=>'signin.php','Create Account'=>'signup.php'];
        foreach ($info as $label => $href):
        ?>
        <a href="<?= $href ?>" style="display:block; font-family:'DM Sans',sans-serif; font-size:.76rem; color:#7a6860; text-decoration:none; padding:3px 0; transition:color .2s;"
           onmouseover="this.style.color='#815854'" onmouseout="this.style.color='#7a6860'">
          <?= $label ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>

    <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:10px; padding-top:20px;">
      <p style="font-family:'DM Sans',sans-serif; font-size:.68rem; color:#b09080; margin:0;">
        © <?php echo date('Y'); ?> Sea Horizon Hotel. All rights reserved.
      </p>
      <a href="mailto:hotelseahorizon@gmail.com"
         style="font-family:'DM Sans',sans-serif; font-size:.68rem; color:#b09080; text-decoration:none;"
         onmouseover="this.style.color='#815854'" onmouseout="this.style.color='#b09080'">
        hotelseahorizon@gmail.com
      </a>
      <p style="font-family:'DM Sans',sans-serif; font-size:.65rem; color:#c9b0a8; margin:0; letter-spacing:.08em;">Est. 2010 · Sea Horizon</p>
    </div>
  </div>
</footer>
<style>
@media (max-width:680px) {
  footer > div > div:first-child { grid-template-columns: 1fr !important; }
}
</style>