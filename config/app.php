<?php
// Load environment variables from .env file if it exists
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $val = trim($parts[1]);
            // Strip surrounding quotes if present
            if ((strpos($val, '"') === 0 && strrpos($val, '"') === strlen($val) - 1) ||
                (strpos($val, "'") === 0 && strrpos($val, "'") === strlen($val) - 1)) {
                $val = substr($val, 1, -1);
            }
            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $val;
            }
            if (!array_key_exists($key, $_SERVER)) {
                $_SERVER[$key] = $val;
            }
            putenv("{$key}={$val}");
        }
    }
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($baseDir === '/') $baseDir = '';

return [
    'base_url' => $protocol . "://" . $host . $baseDir,
    'db_path' => dirname(__DIR__) . '/' . ($_ENV['DB_PATH'] ?? 'database/synalyze.sqlite'),
    
    // SMTP Settings for Contact Form notifications
    'smtp_host'      => $_ENV['SMTP_HOST'] ?? 'mail.synalyze.net',
    'smtp_port'      => (int)($_ENV['SMTP_PORT'] ?? 465),
    'smtp_username'  => $_ENV['SMTP_USERNAME'] ?? '_mainaccount@synalyze.net',
    'smtp_password'  => $_ENV['SMTP_PASSWORD'] ?? 'adI&&&min',
    'smtp_from_name' => $_ENV['SMTP_FROM_NAME'] ?? 'Synalyze',

    // Google OAuth 2.0 Credentials
    'google_client_id'     => $_ENV['GOOGLE_CLIENT_ID'] ?? '1084912737312-5hk94u3458gapug4k477oia3faccb7sp.apps.googleusercontent.com',
    'google_client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? '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',
    'google_redirect_uri'  => $_ENV['GOOGLE_REDIRECT_URI'] ?? 'http://localhost:8000/auth/google/callback',

    // Admin Credentials
    'admin_username'       => $_ENV['ADMIN_USERNAME'] ?? 'admin',
    'admin_password'       => $_ENV['ADMIN_PASSWORD'] ?? '$2y$10$PX9c8/qQxzhWNh8CIHC3JuFITiETbXMYZOnXr0U981.no7jR3atA6', // default admin123
];
