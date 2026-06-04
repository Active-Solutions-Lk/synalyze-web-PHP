<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($baseDir === '/') $baseDir = '';

return [
    'base_url' => $protocol . "://" . $host . $baseDir,
    'db_path' => dirname(__DIR__) . '/database/synalyze.sqlite',
    
    // SMTP Settings for Contact Form notifications
    'smtp_host'      => 'smtp.gmail.com',
    'smtp_port'      => 587,
    'smtp_username'  => 'heshanithennakoon118@gmail.com',
    'smtp_password'  => 'jeae qurl uzzf trku',
    'smtp_from_name' => 'Synalyze Contact Form',

    // Google OAuth 2.0 Credentials
    'google_client_id'     => '1084912737312-81u4g5rciv5j7l8r556lsgk3l3lv299o.apps.googleusercontent.com',
    'google_client_secret' => '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',
    'google_redirect_uri'  => 'https://www.synalyze.net/auth/google/callback',
];
