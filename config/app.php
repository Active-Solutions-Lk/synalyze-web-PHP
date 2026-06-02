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
];
