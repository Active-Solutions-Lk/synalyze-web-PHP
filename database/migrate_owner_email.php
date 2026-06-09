<?php
// CLI Database Migration
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to SQLite database successfully.\n";

    // 1. Check and add ownerEmail to globalsettings
    $stmt = $pdo->query("PRAGMA table_info(globalsettings)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $hasOwnerEmail = false;
    foreach ($columns as $column) {
        if ($column['name'] === 'ownerEmail') {
            $hasOwnerEmail = true;
            break;
        }
    }

    if (!$hasOwnerEmail) {
        $pdo->exec("ALTER TABLE globalsettings ADD COLUMN ownerEmail TEXT NOT NULL DEFAULT 'system@synalyze.net'");
        echo "Successfully added 'ownerEmail' column to 'globalsettings' table.\n";
    } else {
        echo "'ownerEmail' column already exists in 'globalsettings' table.\n";
    }

    // 2. Create contact_submissions table
    $pdo->exec("CREATE TABLE IF NOT EXISTS contact_submissions (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL,
        company TEXT,
        subject TEXT NOT NULL,
        message TEXT NOT NULL,
        submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
    echo "Successfully verified/created 'contact_submissions' table.\n";

    echo "Migration completed successfully!\n";
} catch (Exception $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}
