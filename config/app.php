<?php
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$baseDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($baseDir === '/') $baseDir = '';

return [
    'base_url' => $protocol . "://" . $host . $baseDir,
    'db_path' => dirname(__DIR__) . '/database/synalyze.sqlite',
];
