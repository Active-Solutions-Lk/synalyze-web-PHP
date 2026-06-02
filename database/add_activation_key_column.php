<?php

require_once dirname(__DIR__) . '/src/core/Database.php';

use Core\Database;

echo "Running migration: adding 'activation_key' column to 'demo_requests' table...\n";

try {
    $pdo = Database::getInstance()->getConnection();
    
    // Check if column already exists
    $columnsInfo = $pdo->query("PRAGMA table_info(demo_requests)")->fetchAll(PDO::FETCH_ASSOC);
    $columnExists = false;
    foreach ($columnsInfo as $col) {
        if ($col['name'] === 'activation_key') {
            $columnExists = true;
            break;
        }
    }
    
    if (!$columnExists) {
        $pdo->exec("ALTER TABLE demo_requests ADD COLUMN activation_key TEXT;");
        echo "Success: 'activation_key' column successfully added to 'demo_requests' table.\n";
    } else {
        echo "Info: 'activation_key' column already exists in 'demo_requests' table.\n";
    }
} catch (Exception $e) {
    echo "Error running migration: " . $e->getMessage() . "\n";
    exit(1);
}
