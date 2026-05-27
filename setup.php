<?php

require_once __DIR__ . '/src/core/Database.php';

use Core\Database;

echo "Starting SQLite database setup...\n";

$dbPath = __DIR__ . '/database/synalyze.sqlite';

if (file_exists($dbPath)) {
    echo "Database file already exists at $dbPath.\n";
    echo "Do you want to drop it and recreate? (y/n): ";
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    if(trim(strtolower($line)) != 'y'){
        echo "Aborting setup.\n";
        exit;
    }
    unlink($dbPath);
    echo "Deleted old database.\n";
}

$pdo = Database::getInstance()->getConnection();

echo "Running schema.sql...\n";
$schema = file_get_contents(__DIR__ . '/database/schema.sql');
try {
    $pdo->exec($schema);
    echo "Schema created successfully.\n";
} catch (PDOException $e) {
    die("Failed to create schema: " . $e->getMessage() . "\n");
}

echo "Running seed.sql...\n";
$seed = file_get_contents(__DIR__ . '/database/seed.sql');
try {
    $pdo->exec($seed);
    echo "Data seeded successfully.\n";
} catch (PDOException $e) {
    die("Failed to seed data: " . $e->getMessage() . "\n");
}

echo "Setup complete! The database is ready to use.\n";
