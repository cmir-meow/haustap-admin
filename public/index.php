<?php
declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

use Core\Router;
use App\Controllers\Guest\HomeController;
use App\Controllers\Admin\DashboardController;

$router = new Router();

// Friendly routes using controllers
$router->get('/', fn() => (new HomeController())->index());
$router->get('/admin', fn() => (new DashboardController())->index());

// Friendly routes mapping legacy PHP pages to clean paths
// Auth
$router->get('/login', fn() => run_php(SITE_APP_PATH . '/login_sign up/login.php'));
$router->get('/signup', fn() => run_php(SITE_APP_PATH . '/login_sign up/sign up.php'));
$router->get('/reset-password', fn() => run_php(SITE_APP_PATH . '/login_sign up/Reset password.php'));
$router->get('/change-password', fn() => run_php(SITE_APP_PATH . '/login_sign up/Re-password.php'));

// Bookings overview and actions
$router->get('/bookings', fn() => run_php(SITE_APP_PATH . '/bookings/booking.php'));
$router->get('/bookings/details', fn() => run_php(SITE_APP_PATH . '/bookings/full_booking_details.php'));
$router->get('/bookings/rate', fn() => run_php(SITE_APP_PATH . '/bookings/rate_sp.php'));
$router->get('/bookings/return', fn() => run_php(SITE_APP_PATH . '/bookings/request_return.php'));

// Booking process steps
$router->get('/booking/overview', fn() => run_php(SITE_APP_PATH . '/booking_process/booking_overview.php'));
$router->get('/booking/schedule', fn() => run_php(SITE_APP_PATH . '/booking_process/booking_schedule.php'));
$router->get('/booking/location', fn() => run_php(SITE_APP_PATH . '/booking_process/booking_location.php'));
$router->get('/booking/choose-sp', fn() => run_php(SITE_APP_PATH . '/booking_process/choose_sp.php'));
$router->get('/booking/sp-details', fn() => run_php(SITE_APP_PATH . '/booking_process/show_sp_details.php'));
$router->get('/booking/confirm', fn() => run_php(SITE_APP_PATH . '/booking_process/confirm_booking.php'));
$router->get('/booking/voucher', fn() => run_php(SITE_APP_PATH . '/booking_process/booking_voucher.php'));
$router->get('/booking/edit-address', fn() => run_php(SITE_APP_PATH . '/booking_process/booking_edit_address.php'));

// Services - Cleaning
$router->get('/services/cleaning', fn() => run_php(SITE_APP_PATH . '/Homecleaning/cleaning_services.php'));
$router->get('/services/cleaning/ac', fn() => run_php(SITE_APP_PATH . '/Homecleaning/aircon.php'));
$router->get('/services/cleaning/ac-deep', fn() => run_php(SITE_APP_PATH . '/Homecleaning/aircon_deep_clean.php'));

// My Account
$router->get('/account', fn() => run_php(SITE_APP_PATH . '/my_account/my_account.php'));
$router->get('/account/voucher', fn() => run_php(SITE_APP_PATH . '/my_account/my_voucher.php'));
$router->get('/account/privacy', fn() => run_php(SITE_APP_PATH . '/my_account/privacy_settings.php'));
$router->get('/account/address', fn() => run_php(SITE_APP_PATH . '/my_account/account_address.php'));
$router->get('/account/referral', fn() => run_php(SITE_APP_PATH . '/my_account/account_referral.php'));
$router->get('/account/referral/success', fn() => run_php(SITE_APP_PATH . '/my_account/referral_success.php'));
$router->get('/account/connect', fn() => run_php(SITE_APP_PATH . '/my_account/connect_haustap.php'));
$router->get('/account/password/current', fn() => run_php(SITE_APP_PATH . '/my_account/current_password.php'));
$router->get('/account/password/saved', fn() => run_php(SITE_APP_PATH . '/my_account/password_saved.php'));

// If MVC routes handled it, stop here
if ($router->dispatch($_SERVER['REQUEST_URI'] ?? '/', $_SERVER['REQUEST_METHOD'] ?? 'GET')) {
    return true;
}

// Dual-root fallback router to serve legacy pages and static assets
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$normalized = str_replace('/', DIRECTORY_SEPARATOR, $uri);

// Resolve in site app first
$sitePath = SITE_APP_PATH . $normalized;

// Resolve admin paths by stripping the admin prefix before joining
$ADMIN_PREFIX = '/admin_haustap/admin_haustap';
$adminResolved = null;
if (strpos($uri, $ADMIN_PREFIX) === 0) {
    $rel = substr($uri, strlen($ADMIN_PREFIX)); // e.g. /dashboard.php or /css/style.css
    if ($rel === false || $rel === '') { $rel = '/'; }
    $adminResolved = ADMIN_APP_PATH . str_replace('/', DIRECTORY_SEPARATOR, $rel);
}

// Serve static assets by streaming with the correct content type
function serve_static(string $file): void {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $types = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'map' => 'application/json'
    ];
    if (isset($types[$ext])) {
        header('Content-Type: ' . $types[$ext]);
    }
    readfile($file);
}

// Helper to require PHP files
function run_php(string $file): void {
    $dir = dirname($file);
    if (is_dir($dir)) {
        chdir($dir);
    }
    require $file;
}

// Static assets
if (preg_match('/\.(?:png|jpg|jpeg|gif|svg|css|js|ico|woff2?|ttf|map)$/i', $uri)) {
    // Alias asset resolution for friendly routes
    $aliasStaticPath = (function(string $uri): ?string {
        $aliases = [
            '/booking/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'booking_process' . DIRECTORY_SEPARATOR,
            '/account/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'my_account' . DIRECTORY_SEPARATOR,
            '/login/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'login_sign up' . DIRECTORY_SEPARATOR,
            '/signup/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'login_sign up' . DIRECTORY_SEPARATOR,
            '/reset-password/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'login_sign up' . DIRECTORY_SEPARATOR,
            '/change-password/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'login_sign up' . DIRECTORY_SEPARATOR,
            '/services/' => SITE_APP_PATH . DIRECTORY_SEPARATOR . 'Homecleaning' . DIRECTORY_SEPARATOR,
        ];
        foreach ($aliases as $prefix => $root) {
            if (strpos($uri, $prefix) === 0) {
                $rel = substr($uri, strlen($prefix));
                if ($rel === false) { $rel = ''; }
                $candidate = rtrim($root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $rel);
                if (is_file($candidate)) { return $candidate; }
            }
        }
        return null;
    })($uri);
    if ($aliasStaticPath) { serve_static($aliasStaticPath); return true; }

    if (is_file($sitePath)) { serve_static($sitePath); return true; }
    if ($adminResolved && is_file($adminResolved)) { serve_static($adminResolved); return true; }
}

// Direct PHP file
if (is_file($sitePath) && substr($sitePath, -4) === '.php') { run_php($sitePath); return true; }
if ($adminResolved && is_file($adminResolved) && substr($adminResolved, -4) === '.php') { run_php($adminResolved); return true; }

// Directory index
if (is_dir($sitePath)) {
    $index = $sitePath . DIRECTORY_SEPARATOR . 'index.php';
    if (is_file($index)) { run_php($index); return true; }
}
if ($adminResolved && is_dir($adminResolved)) {
    $index = $adminResolved . DIRECTORY_SEPARATOR . 'index.php';
    if (is_file($index)) { run_php($index); return true; }
}

// If the request is for the admin prefix but no file matched, return 404 here
if (strpos($uri, $ADMIN_PREFIX) === 0) {
    http_response_code(404);
    echo 'Not Found';
    return true;
}

// Fallback to original site router for its custom logic (e.g., mock-api)
require SITE_APP_PATH . '/router.php';
