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
      <a href="#" class="icon-link" aria-label="Notifications">
<i class="fa-solid fa-bell"></i>
      </a>
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
