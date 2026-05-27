<?php

require_once dirname(__DIR__) . '/src/core/Database.php';

use Core\Database;

echo "Checking / creating users table...\n";

try {
    $pdo = Database::getInstance()->getConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        full_name TEXT NOT NULL,
        company_name TEXT,
        address TEXT NOT NULL,
        phone TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    );";
    
    $pdo->exec($sql);
    echo "Success: 'users' table created or already exists.\n";
} catch (Exception $e) {
    echo "Error creating table: " . $e->getMessage() . "\n";
    exit(1);
}
