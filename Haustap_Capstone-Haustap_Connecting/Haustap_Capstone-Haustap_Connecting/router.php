<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$docRoot = __DIR__;
$normalized = str_replace('/', DIRECTORY_SEPARATOR, $uri);
$fullPath = $docRoot . $normalized;

// Friendly route aliases to legacy PHP files for local dev
$aliases = [
  '/login' => '/login_sign up/login.php',
  '/signup' => '/login_sign up/sign up.php',
  '/booking/choose-sp' => '/booking_process/choose_sp.php',
  '/booking/schedule' => '/booking_process/booking_schedule.php',
  '/booking/confirm' => '/booking_process/confirm_booking.php',
  '/booking/overview' => '/booking_process/booking_overview.php',
  '/services/cleaning' => '/Homecleaning/cleaning_services.php',
  '/services/cleaning/ac' => '/Homecleaning/aircon.php',
  '/services/cleaning/ac-deep' => '/Homecleaning/aircon_deep_clean.php',
];
if (isset($aliases[$uri])) {
  $aliasPath = $docRoot . str_replace('/', DIRECTORY_SEPARATOR, $aliases[$uri]);
  if (is_file($aliasPath)) {
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
  if (is_dir($fullPath)) {
    $index = $fullPath . DIRECTORY_SEPARATOR . 'index.php';
    if (is_file($index)) {
      require $index;
      return true;
    }
  }
  // If a direct PHP file under mock-api is targeted
  if (is_file($fullPath . '.php')) {
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
    require $index;
    return true;
  }
}

// If a PHP file exists for the requested path, run it
if (is_file($fullPath) && substr($fullPath, -4) === '.php') {
  require $fullPath;
  return true;
}

// Fallback to project root index.php
http_response_code(404);
echo 'Not Found';
