<?php
// Database script to fix invalid demo_requests foreign key reference
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to SQLite database successfully.\n";

    // Disable foreign keys temporarily during the migration
    $pdo->exec("PRAGMA foreign_keys = OFF");

    $pdo->beginTransaction();

    // 1. Rename table
    $pdo->exec("ALTER TABLE demo_requests RENAME TO demo_requests_old");
    echo "Renamed demo_requests to demo_requests_old.\n";

    // 2. Create new table with correct FK constraint pointing to 'users'
    $sql = "CREATE TABLE demo_requests (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER NOT NULL UNIQUE,
        full_name TEXT NOT NULL,
        company_name TEXT,
        email TEXT NOT NULL,
        phone TEXT NOT NULL,
        status TEXT NOT NULL DEFAULT 'pending',
        requested_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        credential_sent_at DATETIME,
        activation_key TEXT,
        synalyze_url TEXT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );";
    $pdo->exec($sql);
    echo "Created new demo_requests table with correct foreign key constraint.\n";

    // 3. Copy data
    $pdo->exec("INSERT INTO demo_requests (
        id, user_id, full_name, company_name, email, phone, status, requested_at, credential_sent_at, activation_key, synalyze_url
    ) SELECT 
        id, user_id, full_name, company_name, email, phone, status, requested_at, credential_sent_at, activation_key, synalyze_url 
    FROM demo_requests_old");
    echo "Copied data from demo_requests_old to demo_requests.\n";

    // 4. Drop old table
    $pdo->exec("DROP TABLE demo_requests_old");
    echo "Dropped demo_requests_old table.\n";

    $pdo->commit();
    
    // Enable foreign keys back
    $pdo->exec("PRAGMA foreign_keys = ON");
    
    echo "Migration completed successfully! Foreign key reference to users has been fixed.\n";
} catch (Exception $e) {
    if (isset($pdo)) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $pdo->exec("PRAGMA foreign_keys = ON");
    }
    die("Migration failed: " . $e->getMessage() . "\n");
}
