<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<style>
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-8px); }
  to   { opacity: 1; transform: translateY(0); }
}
.nav-header { animation: slideDown .45s cubic-bezier(.16,1,.3,1) both; }

.nav-link {
  position: relative;
  display: inline-flex;
  align-items: center;
  padding: 6px 12px;
  font-size: .7rem;
  font-weight: 600;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: #7a6860;
  border-radius: 6px;
  transition: color .2s ease, background .2s ease;
  text-decoration: none;
}
.nav-link::after {
  content: '';
  position: absolute;
  bottom: 2px; left: 12px; right: 12px;
  height: 1.5px;
  background: #815854;
  transform: scaleX(0);
  transform-origin: left;
  transition: transform .25s cubic-bezier(.16,1,.3,1);
  border-radius: 2px;
}
.nav-link:hover { color: #815854; background: rgba(129,88,84,.06); }
.nav-link:hover::after { transform: scaleX(1); }
.nav-link.is-active { color: #815854; background: rgba(129,88,84,.09); font-weight: 700; }
.nav-link.is-active::after { transform: scaleX(1); }

.btn-outline-primary {
  padding: 5px 14px; font-size: .68rem; font-weight: 600;
  letter-spacing: .1em; text-transform: uppercase;
  color: #815854; border: 1.5px solid #815854; border-radius: 50px;
  transition: all .2s ease; text-decoration: none;
}
.btn-outline-primary:hover {
  background: #815854; color: #fff;
  transform: translateY(-1px);
  box-shadow: 0 4px 14px rgba(129,88,84,.22);
}
.btn-filled-primary {
  padding: 5px 16px; font-size: .68rem; font-weight: 600;
  letter-spacing: .1em; text-transform: uppercase;
  color: #fff; background: #815854; border: 1.5px solid #815854;
  border-radius: 50px; transition: all .2s ease; text-decoration: none;
  box-shadow: 0 2px 8px rgba(129,88,84,.25);
}
.btn-filled-primary:hover {
  background: #6b4644; border-color: #6b4644;
  transform: translateY(-1px);
  box-shadow: 0 5px 16px rgba(129,88,84,.3);
}
.dropdown-menu {
  position: absolute; top: calc(100% + 8px); left: 0; min-width: 13rem;
  background: #fff; border: 1px solid #F0D5C0; border-radius: 12px;
  box-shadow: 0 12px 40px rgba(107,70,68,.13); overflow: hidden;
  opacity: 0; visibility: hidden; transform: translateY(-6px);
  transition: all .22s cubic-bezier(.16,1,.3,1); z-index: 100;
}
.dropdown-group:hover .dropdown-menu,
.dropdown-group:focus-within .dropdown-menu {
  opacity: 1; visibility: visible; transform: translateY(0);
}
.dropdown-item {
  display: block; padding: 10px 16px;
  font-size: .72rem; font-weight: 500; color: #5a4a44;
  text-decoration: none; transition: background .15s, color .15s;
  border-bottom: 1px solid #fdf4ed;
}
.dropdown-item:last-child { border-bottom: none; }
.dropdown-item:hover { background: #F9EBDE; color: #815854; }

@keyframes gentlePulse {
  0%, 100% { transform: scale(1); }
  50%       { transform: scale(1.04); }
}
.logo-icon { animation: gentlePulse 4s ease-in-out infinite; }
</style>

<div class="nav-header bg-white/95 backdrop-blur-md sticky top-0 z-50"
     style="border-bottom:1px solid #F0D5C0; box-shadow:0 1px 12px rgba(129,88,84,.07);">
  <nav style="max-width:1200px; margin:0 auto; padding:0 1.25rem;">
    <div style="display:flex; align-items:center; justify-content:space-between; height:62px;">

      <!-- Logo -->
      <a href="index.php" style="display:flex; align-items:center; gap:9px; text-decoration:none; flex-shrink:0;">
        <div class="logo-icon" style="width:32px; height:32px; background:#815854; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(129,88,84,.3);">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <path d="M9 22V12h6v10M3 9h18"/>
          </svg>
        </div>
        <div>
          <div style="font-family:'Playfair Display',serif; font-size:.9rem; font-weight:700; color:#815854; line-height:1.1;">Sea Horizon</div>
          <div style="font-family:'DM Sans',sans-serif; font-size:.55rem; font-weight:500; color:#b09080; letter-spacing:.18em; text-transform:uppercase;">Hotel & Resort</div>
        </div>
      </a>

      <!-- Desktop Nav -->
      <div class="hidden md:flex" style="align-items:center; gap:2px;">
        <?php
        $navItems = [
          'Home'       => 'index.php',
          'About'      => 'about.php',
          'Facilities' => 'services.php',
          'Rooms'      => 'index.php',
          'Gallery'    => 'gallery.php',
          'Feedback'   => 'contact.php',
        ];
        foreach ($navItems as $label => $page):
          $active = ($currentPage === $page) ? 'is-active' : '';
        ?>
          <?php if ($label === 'Rooms'): ?>
          <div class="dropdown-group" style="position:relative;">
            <a class="nav-link <?= $active ?>" href="services.php" style="gap:4px;">
              <?= $label ?>
              <svg width="11" height="11" viewBox="0 0 20 20" fill="currentColor" style="margin-top:1px;">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </a>
            <div class="dropdown-menu">
              <div style="padding:8px 16px 6px; font-size:.6rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:#b09080;">Room Types</div>
              <?php
                $ret = "SELECT * from tblcategory";
                $query1 = $dbh->prepare($ret);
                $query1->execute();
                $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                foreach ($resultss as $rows): ?>
              <a href="category-details.php?catid=<?= htmlentities($rows->ID) ?>" class="dropdown-item">
                <?= htmlentities($rows->CategoryName) ?>
              </a>
              <?php endforeach; ?>
            </div>
          </div>
          <?php else: ?>
          <a href="<?= $page ?>" class="nav-link <?= $active ?>"><?= $label ?></a>
          <?php endif; ?>
        <?php endforeach; ?>

        <div style="display:flex; align-items:center; gap:8px; margin-left:10px; padding-left:10px; border-left:1px solid #F0D5C0;">
          <?php if (strlen($_SESSION['hbmsuid'] == 0)) { ?>
          <a href="signup.php" class="btn-outline-primary">Sign Up</a>
          <a href="signin.php" class="btn-filled-primary">Login</a>
          <?php } ?>

          <?php if (strlen($_SESSION['hbmsuid'] != 0)) { ?>
          <div class="dropdown-group" style="position:relative;">
            <button style="display:flex; align-items:center; gap:7px; padding:5px 12px; font-size:.7rem; font-weight:600; color:#5a4a44; background:#F9EBDE; border:1.5px solid #F0D5C0; border-radius:50px; cursor:pointer; transition:all .2s; letter-spacing:.05em;">
              <span style="width:22px; height:22px; background:#815854; border-radius:50%; display:flex; align-items:center; justify-content:center;">
                <svg width="12" height="12" viewBox="0 0 20 20" fill="#fff"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
              </span>
              My Account
              <svg width="10" height="10" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
            <div class="dropdown-menu" style="right:0; left:auto; min-width:11rem;">
              <a href="profile.php" class="dropdown-item">Profile</a>
              <a href="my-booking.php" class="dropdown-item">My Bookings</a>
              <a href="change-password.php" class="dropdown-item">Change Password</a>
              <div style="height:1px; background:#F0D5C0;"></div>
              <a href="logout.php" class="dropdown-item" style="color:#c0392b;">Sign Out</a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

      <!-- Mobile Hamburger -->
      <button onclick="document.getElementById('mob-nav').classList.toggle('hidden')"
              class="md:hidden" style="padding:8px; border-radius:8px; color:#815854; background:transparent; border:none; cursor:pointer;">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round">
          <path d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mob-nav" class="hidden md:hidden" style="border-top:1px solid #F0D5C0; padding:10px 0 14px;">
      <?php
      foreach ($navItems as $label => $page):
        $isAct = ($currentPage === $page);
        $s = $isAct ? 'color:#815854; background:rgba(129,88,84,.08); font-weight:700;' : 'color:#6b5c56;';
      ?>
      <a href="<?= $page ?>" style="display:block; padding:9px 14px; font-size:.72rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase; border-radius:8px; margin:2px 6px; text-decoration:none; <?= $s ?>">
        <?= $label ?>
      </a>
      <?php endforeach; ?>
      <?php if (strlen($_SESSION['hbmsuid'] == 0)) { ?>
      <div style="display:flex; gap:8px; padding:8px 12px 0;">
        <a href="signup.php" class="btn-outline-primary" style="flex:1; text-align:center; padding:8px 12px;">Sign Up</a>
        <a href="signin.php" class="btn-filled-primary" style="flex:1; text-align:center; padding:8px 12px;">Login</a>
      </div>
      <?php } ?>
      <?php if (strlen($_SESSION['hbmsuid'] != 0)) { ?>
      <div style="margin:8px 6px 0; padding-top:8px; border-top:1px solid #F0D5C0;">
        <a href="profile.php" style="display:block; padding:9px 14px; font-size:.72rem; color:#6b5c56; border-radius:8px; text-decoration:none;">Profile</a>
        <a href="my-booking.php" style="display:block; padding:9px 14px; font-size:.72rem; color:#6b5c56; border-radius:8px; text-decoration:none;">My Bookings</a>
        <a href="change-password.php" style="display:block; padding:9px 14px; font-size:.72rem; color:#6b5c56; border-radius:8px; text-decoration:none;">Change Password</a>
        <a href="logout.php" style="display:block; padding:9px 14px; font-size:.72rem; color:#c0392b; border-radius:8px; text-decoration:none;">Sign Out</a>
      </div>
      <?php } ?>
    </div>
  </nav>
</div>