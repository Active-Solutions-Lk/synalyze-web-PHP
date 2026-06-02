<?php

require_once dirname(__DIR__) . '/src/core/Database.php';

use Core\Database;

echo "Checking / creating demo_requests table...\n";

try {
    $pdo = Database::getInstance()->getConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS demo_requests (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL UNIQUE,
        full_name TEXT NOT NULL,
        company_name TEXT,
        email TEXT NOT NULL,
        phone TEXT NOT NULL,
        status TEXT NOT NULL DEFAULT 'pending',
        requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        credential_sent_at DATETIME,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );";
    
    $pdo->exec($sql);
    echo "Success: 'demo_requests' table created or already exists.\n";
} catch (Exception $e) {
    echo "Error creating table: " . $e->getMessage() . "\n";
    exit(1);
}
