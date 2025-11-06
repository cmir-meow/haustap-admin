<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$docRoot = __DIR__;
$normalized = str_replace('/', DIRECTORY_SEPARATOR, $uri);
$fullPath = $docRoot . $normalized;

// Ensure UTF-8 Content-Type for dynamic HTML responses
function ensureUtf8HtmlHeader() {
  if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
  }
}

// Friendly route aliases to legacy PHP files for local dev
$aliases = [
  '/login' => '/login_sign up/login.php',
  '/signup' => '/login_sign up/sign up.php',
  '/booking/choose-sp' => '/booking_process/choose_sp.php',
  '/booking/location' => '/booking_process/booking_location.php',
  '/booking/schedule' => '/booking_process/booking_schedule.php',
  '/booking/confirm' => '/booking_process/confirm_booking.php',
  '/booking/overview' => '/booking_process/booking_overview.php',
  '/services/cleaning' => '/Homecleaning/cleaning_services.php',
  '/services/cleaning/ac' => '/Homecleaning/aircon.php',
  '/services/cleaning/ac-deep' => '/Homecleaning/aircon_deep_clean.php',
  // Additional category aliases
  '/services/outdoor' => '/Outdoor_Services/Outdoor-Services.php',
  '/services/repairs' => '/Indoor_services/Handyman.php',
  '/services/beauty' => '/beauty_services/packages_services.php',
  '/services/wellness' => '/wellness_services/packages.php',
  '/services/tech' => '/tech_gadget/mobile_phone.php',
  // Account pages
  '/account' => '/my_account/my_account.php',
  '/account/address' => '/my_account/account_address.php',
  '/account/privacy' => '/my_account/privacy_settings.php',
  '/account/change-password' => '/my_account/change_password.php',
  '/account/current-password' => '/my_account/current_password.php',
  '/account/password-saved' => '/my_account/password_saved.php',
  '/account/verification-code' => '/my_account/verification_code.php',
  '/account/voucher' => '/my_account/my_voucher.php',
  '/account/referral' => '/my_account/account_referral.php',
  '/account/referral-success' => '/my_account/referral_success.php',
  '/account/connect' => '/my_account/connect_haustap.php',
    '/account/terms' => '/client/terms.php',
  '/about' => '/client/About.php',
];
if (isset($aliases[$uri])) {
  $aliasPath = $docRoot . str_replace('/', DIRECTORY_SEPARATOR, $aliases[$uri]);
  if (is_file($aliasPath)) {
    ensureUtf8HtmlHeader();
    require $aliasPath;
    return true;
  }
}

// If the requested file exists (including .php), let the server handle it
if (is_file($fullPath)) {
  return false;
}

// Explicit routing for mock-api: map directories to their index.php
if (strpos($uri, '/mock-api/') === 0) {
  // Special-case: forward any /mock-api/bookings/* request to bookings/index.php
  if (strpos($uri, '/mock-api/bookings/') === 0) {
    ensureUtf8HtmlHeader();
    require __DIR__ . DIRECTORY_SEPARATOR . 'mock-api' . DIRECTORY_SEPARATOR . 'bookings' . DIRECTORY_SEPARATOR . 'index.php';
    return true;
  }
  if (is_dir($fullPath)) {
    $index = $fullPath . DIRECTORY_SEPARATOR . 'index.php';
    if (is_file($index)) {
      ensureUtf8HtmlHeader();
      require $index;
      return true;
    }
  }
  // If a direct PHP file under mock-api is targeted
  if (is_file($fullPath . '.php')) {
    ensureUtf8HtmlHeader();
    require $fullPath . '.php';
    return true;
  }
}

// Serve static assets directly
if (preg_match('/\.(?:png|jpg|jpeg|gif|svg|css|js|ico|woff2?|ttf|map)$/i', $uri)) {
  if (is_file($fullPath)) {
    return false; // let built-in server handle
  }
}

// If a directory is requested, load its index.php if present
if (is_dir($fullPath)) {
  $index = $fullPath . DIRECTORY_SEPARATOR . 'index.php';
  if (is_file($index)) {
    ensureUtf8HtmlHeader();
    require $index;
    return true;
  }
}

// If a PHP file exists for the requested path, run it
if (is_file($fullPath) && substr($fullPath, -4) === '.php') {
  ensureUtf8HtmlHeader();
  require $fullPath;
  return true;
}

// Fallback to project root index.php
http_response_code(404);
ensureUtf8HtmlHeader();
echo 'Not Found';
