<?php

require_once dirname(__DIR__) . '/src/core/Database.php';

use Core\Database;

echo "Running migration: adding 'reset_token' and 'reset_token_expires_at' columns to 'users' table...\n";

try {
    $pdo = Database::getInstance()->getConnection();
    
    // Check if columns exist
    $columnsInfo = $pdo->query("PRAGMA table_info(users)")->fetchAll(PDO::FETCH_ASSOC);
    $resetTokenExists = false;
    $resetTokenExpiresExists = false;
    
    foreach ($columnsInfo as $col) {
        if ($col['name'] === 'reset_token') {
            $resetTokenExists = true;
        }
        if ($col['name'] === 'reset_token_expires_at') {
            $resetTokenExpiresExists = true;
        }
    }
    
    if (!$resetTokenExists) {
        $pdo->exec("ALTER TABLE users ADD COLUMN reset_token TEXT;");
        echo "Success: 'reset_token' column successfully added to 'users' table.\n";
    } else {
        echo "Info: 'reset_token' column already exists in 'users' table.\n";
    }
    
    if (!$resetTokenExpiresExists) {
        $pdo->exec("ALTER TABLE users ADD COLUMN reset_token_expires_at DATETIME;");
        echo "Success: 'reset_token_expires_at' column successfully added to 'users' table.\n";
    } else {
        echo "Info: 'reset_token_expires_at' column already exists in 'users' table.\n";
    }
} catch (Exception $e) {
    echo "Error running migration: " . $e->getMessage() . "\n";
    exit(1);
}
