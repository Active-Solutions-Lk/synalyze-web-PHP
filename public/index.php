<?php
// Set global timezone to Asia/Colombo (Sri Lanka)
date_default_timezone_set('Asia/Colombo');

// If running via PHP built-in server, serve static files directly
if (php_sapi_name() === 'cli-server') {
    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    if (is_file(__DIR__ . $path)) {
        return false;
    }
}

// Front Controller
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Autoloading could be set up here if using composer. For now we will manually require.
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/app.php';
require_once dirname(__DIR__) . '/src/core/helpers.php';
require_once dirname(__DIR__) . '/src/core/Database.php';
require_once dirname(__DIR__) . '/src/core/Mailer.php';
require_once dirname(__DIR__) . '/src/core/Router.php';

// Instantiate Router
$router = new Core\Router();

// Define public routes
$router->add('/', 'HomeController@index');
$router->add('/about', 'AboutController@index');
$router->add('/pricing', 'PricingController@index');
$router->add('/contact', 'ContactController@index');
$router->add('/qa', 'QAController@index');
$router->add('/support', 'QAController@index');
$router->add('/docs', 'DocsController@index');
$router->add('/signup', 'SignupController@index');
$router->add('/login', 'LoginController@index');
$router->add('/dashboard', 'DashboardController@index');
$router->add('/logout', 'LoginController@logout');

// Google OAuth routes
$router->add('/auth/google', 'GoogleAuthController@redirect');
$router->add('/auth/google/login', 'GoogleAuthController@loginRedirect');
$router->add('/auth/google/callback', 'GoogleAuthController@callback');
$router->add('/signup/google/complete', 'GoogleAuthController@complete');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (strpos($requestPath, '/signup/google/complete') !== false || strpos($_GET['url'] ?? '', 'signup/google/complete') !== false) {
        $router->add('/signup/google/complete', 'GoogleAuthController@completeSubmit');
    } elseif (strpos($requestPath, '/signup') !== false || strpos($_GET['url'] ?? '', 'signup') !== false) {
        $router->add('/signup', 'SignupController@submit');
    }
    if (strpos($requestPath, '/login') !== false || strpos($_GET['url'] ?? '', 'login') !== false) {
        $router->add('/login', 'LoginController@submit');
    }
    if (strpos($requestPath, '/contact') !== false || strpos($_GET['url'] ?? '', 'contact') !== false) {
        $router->add('/contact', 'ContactController@submit');
    }
}

// Admin routes
$router->add('/admin', 'AdminController@dashboard');

$router->add('/admin/settings', 'SettingsAdminController@index');
$router->add('/admin/settings/update', 'SettingsAdminController@update');

$router->add('/admin/faqs', 'FaqsAdminController@index');
$router->add('/admin/faqs/category/create', 'FaqsAdminController@createCategory');
$router->add('/admin/faqs/category/delete', 'FaqsAdminController@deleteCategory');
$router->add('/admin/faqs/category/update', 'FaqsAdminController@updateCategory');
$router->add('/admin/faqs/item/create', 'FaqsAdminController@createItem');
$router->add('/admin/faqs/item/delete', 'FaqsAdminController@deleteItem');
$router->add('/admin/faqs/item/update', 'FaqsAdminController@updateItem');

$router->add('/admin/landing', 'LandingAdminController@index');
$router->add('/admin/landing/hero/update', 'LandingAdminController@updateHero');
$router->add('/admin/landing/feature/create', 'LandingAdminController@createFeature');
$router->add('/admin/landing/feature/delete', 'LandingAdminController@deleteFeature');
$router->add('/admin/landing/feature/update', 'LandingAdminController@updateFeature');
$router->add('/admin/landing/step/create', 'LandingAdminController@createStep');
$router->add('/admin/landing/step/delete', 'LandingAdminController@deleteStep');
$router->add('/admin/landing/step/update', 'LandingAdminController@updateStep');
$router->add('/admin/landing/option/create', 'LandingAdminController@createOption');
$router->add('/admin/landing/option/delete', 'LandingAdminController@deleteOption');
$router->add('/admin/landing/option/update', 'LandingAdminController@updateOption');

$router->add('/admin/pricing', 'PricingAdminController@index');
$router->add('/admin/pricing/tier/create', 'PricingAdminController@createTier');
$router->add('/admin/pricing/tier/delete', 'PricingAdminController@deleteTier');
$router->add('/admin/pricing/tier/update', 'PricingAdminController@updateTier');
$router->add('/admin/pricing/feature/create', 'PricingAdminController@createFeature');
$router->add('/admin/pricing/feature/delete', 'PricingAdminController@deleteFeature');
$router->add('/admin/pricing/feature/update', 'PricingAdminController@updateFeature');
$router->add('/admin/pricing/addon/create', 'PricingAdminController@createAddon');
$router->add('/admin/pricing/addon/delete', 'PricingAdminController@deleteAddon');
$router->add('/admin/pricing/addon/update', 'PricingAdminController@updateAddon');
$router->add('/admin/pricing/option/create', 'PricingAdminController@createOption');
$router->add('/admin/pricing/option/delete', 'PricingAdminController@deleteOption');
$router->add('/admin/pricing/option/update', 'PricingAdminController@updateOption');

$router->add('/admin/contact', 'ContactAdminController@index');
$router->add('/admin/contact/update', 'ContactAdminController@update');

$router->add('/admin/users', 'UsersAdminController@index');
$router->add('/admin/users/delete', 'UsersAdminController@delete');

// Newsletter subscriber public and admin routes
$router->add('/subscribe', 'SubscribeController@submit');
$router->add('/unsubscribe', 'SubscribeController@unsubscribe');
$router->add('/admin/subscribers', 'SubscribersAdminController@index');
$router->add('/admin/subscribers/delete', 'SubscribersAdminController@delete');
$router->add('/admin/subscribers/send', 'SubscribersAdminController@sendEmail');


// Demo Request public and admin routes
$router->add('/demo/request', 'DemoController@submit');
$router->add('/admin/demo', 'DemoAdminController@index');
$router->add('/admin/demo/send', 'DemoAdminController@sendCredentials');
$router->add('/admin/demo/delete', 'DemoAdminController@delete');


$router->add('/admin/about', 'AboutAdminController@index');
$router->add('/admin/about/hero/update', 'AboutAdminController@updateHero');
$router->add('/admin/about/card/create', 'AboutAdminController@createCard');
$router->add('/admin/about/card/delete', 'AboutAdminController@deleteCard');
$router->add('/admin/about/card/update', 'AboutAdminController@updateCard');
$router->add('/admin/about/why/create', 'AboutAdminController@createWhyItem');
$router->add('/admin/about/why/delete', 'AboutAdminController@deleteWhyItem');
$router->add('/admin/about/why/update', 'AboutAdminController@updateWhyItem');

$router->add('/admin/docs', 'DocsAdminController@index');
$router->add('/admin/docs/page/update', 'DocsAdminController@updatePage');

$router->add('/admin/docs/onboarding/create', 'DocsAdminController@createOnboarding');
$router->add('/admin/docs/onboarding/update', 'DocsAdminController@updateOnboarding');
$router->add('/admin/docs/onboarding/delete', 'DocsAdminController@deleteOnboarding');

$router->add('/admin/docs/integration/create', 'DocsAdminController@createIntegration');
$router->add('/admin/docs/integration/update', 'DocsAdminController@updateIntegration');
$router->add('/admin/docs/integration/delete', 'DocsAdminController@deleteIntegration');

$router->add('/admin/docs/module/create', 'DocsAdminController@createModule');
$router->add('/admin/docs/module/update', 'DocsAdminController@updateModule');
$router->add('/admin/docs/module/delete', 'DocsAdminController@deleteModule');

$router->add('/admin/docs/deployment/create', 'DocsAdminController@createDeployment');
$router->add('/admin/docs/deployment/update', 'DocsAdminController@updateDeployment');
$router->add('/admin/docs/deployment/delete', 'DocsAdminController@deleteDeployment');

$router->add('/admin/docs/compliance/create', 'DocsAdminController@createCompliance');
$router->add('/admin/docs/compliance/update', 'DocsAdminController@updateCompliance');
$router->add('/admin/docs/compliance/delete', 'DocsAdminController@deleteCompliance');

$router->add('/admin/docs/faq/create', 'DocsAdminController@createFaq');
$router->add('/admin/docs/faq/update', 'DocsAdminController@updateFaq');
$router->add('/admin/docs/faq/delete', 'DocsAdminController@deleteFaq');

// Resolve URL path using REQUEST_URI instead of $_GET
$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($basePath === '/') $basePath = '';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Strip the base path from the URL if it exists
if ($basePath && strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}

if (empty($url)) {
    $url = '/';
}

$router->dispatch($url);
