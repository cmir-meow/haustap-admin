<?php
// Shared header partial for both guest and client contexts
// Usage: set $context = 'guest' or 'client' before requiring this file

$context = isset($context) ? $context : 'guest';
$current = $_SERVER['REQUEST_URI'] ?? '';
$isActive = function(array $patterns) use ($current) {
  foreach ($patterns as $p) {
    if (stripos($current, $p) === 0) { return ' class="active"'; }
  }
  return '';
};

if ($context === 'client') {
  $logoHref = '/client/homepage.php';
  $logoSrc  = '/client/images/logo.png';
  $nav = [
    ['/client/homepage.php', 'Home', ['/client/homepage.php','/client/index.php','/index.php']],
    ['/client/services.php', 'Services', ['/client/services']],
    ['/bookings/booking.php', 'Bookings', ['/bookings']],
    ['/client/About.php', 'About', ['/client/About.php']],
    ['/client/contact_client.php', 'Contact', ['/client/contact_client.php']],
  ];
} else {
  $logoHref = '/guest/homepage.php';
  $logoSrc  = '/guest/images/logo.png';
  $nav = [
    ['/guest/homepage.php', 'Home', ['/guest/homepage.php','/index.php']],
    ['/guest/services.php', 'Services', ['/guest/services']],
    ['/bookings/booking.php', 'Bookings', ['/bookings']],
    ['/guest/About.php', 'About', ['/guest/About.php']],
    ['/guest/Contact.php', 'Contact', ['/guest/Contact.php']],
  ];
}
?>
<div class="header">
  <a href="<?= $logoHref ?>" class="logo-link"><img src="<?= $logoSrc ?>" alt="HausTap" class="logo-img"></a>
  <nav class="nav">
    <?php foreach ($nav as [$href, $label, $patterns]): ?>
      <a href="<?= $href ?>"<?= $isActive($patterns) ?>><?= $label ?></a>
    <?php endforeach; ?>
  </nav>
  <div class="header-right">
    <div class="search-box" role="search">
      <input type="text" placeholder="Search services" aria-label="Search">
      <?php if ($context === 'client'): ?>
        <button class="search-btn" type="button" aria-label="Search">
<i class="fa-solid fa-search"></i>
        </button>
      <?php else: ?>
<i class="fa-solid fa-search"></i>
      <?php endif; ?>
    </div>
    <?php if ($context === 'client'): ?>
      <a href="#" class="icon-link" id="notifBellBtn" aria-label="Notifications" style="position:relative;">
        <i class="fa-solid fa-bell"></i>
        <span class="notif-count" id="notifCount" aria-hidden="true" style="position:absolute; top:-6px; right:-6px; background:#ff3b30; color:#fff; border-radius:12px; padding:0 6px; font-size:12px; line-height:18px; min-width:18px; text-align:center; display:none;">0</span>
      </a>
      <div class="notif-dropdown hidden" id="notifDropdown" aria-label="Notifications" style="position:absolute; right:60px; top:90px; width:320px; background:#fff; border:1px solid #e5e7eb; box-shadow:0 8px 24px rgba(0,0,0,0.12); border-radius:10px; overflow:hidden; z-index:999;">
        <div class="notif-header" style="display:flex; justify-content:space-between; align-items:center; padding:10px 12px; background:#f7f9fa; border-bottom:1px solid #e5e7eb;">
          <strong>Notifications</strong>
          <button type="button" class="mark-all" id="notifMarkAll" style="background:transparent; border:none; color:#3dbfc3; cursor:pointer;">Mark all read</button>
        </div>
        <ul class="notif-list" id="notifList" style="list-style:none; margin:0; padding:0; max-height:360px; overflow:auto;"></ul>
        <div class="notif-footer" style="padding:8px 12px; border-top:1px solid #e5e7eb; text-align:right;">
          <a href="/bookings/booking.php" style="color:#3dbfc3; text-decoration:none; font-weight:500;">View bookings</a>
        </div>
      </div>
      <a href="/my_account/my_account.php" class="account-link">
<i class="fa-solid fa-user account-icon"></i>
        <span class="account-name" style="margin-left: 6px;">My Account</span>
      </a>
    <?php else: ?>
      <div class="auth-links">
        <div class="signup-link"><a href="/login_sign up/sign up.php">Sign up</a></div>
        <span>|</span>
        <div class="login-link"><a href="/login_sign up/login.php">Login</a></div>
      </div>
    <?php endif; ?>
  </div>
  
</div>
