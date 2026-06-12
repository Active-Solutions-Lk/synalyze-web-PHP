<?php
// CLI Database Migration for SMTP Settings
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to SQLite database successfully.\n";

    $pdo->beginTransaction();

    // 1. Fetch table columns of globalsettings
    $stmt = $pdo->query("PRAGMA table_info(globalsettings)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $existingColumns = array_column($columns, 'name');

    // Add smtpHost if not exists
    if (!in_array('smtpHost', $existingColumns)) {
        $pdo->exec("ALTER TABLE globalsettings ADD COLUMN smtpHost TEXT NOT NULL DEFAULT 'mail.synalyze.net'");
        echo "Successfully added 'smtpHost' column to 'globalsettings' table.\n";
    } else {
        echo "'smtpHost' column already exists in 'globalsettings' table.\n";
    }

    // Add smtpPort if not exists
    if (!in_array('smtpPort', $existingColumns)) {
        $pdo->exec("ALTER TABLE globalsettings ADD COLUMN smtpPort INTEGER NOT NULL DEFAULT 465");
        echo "Successfully added 'smtpPort' column to 'globalsettings' table.\n";
    } else {
        echo "'smtpPort' column already exists in 'globalsettings' table.\n";
    }

    // Add smtpFromName if not exists
    if (!in_array('smtpFromName', $existingColumns)) {
        $pdo->exec("ALTER TABLE globalsettings ADD COLUMN smtpFromName TEXT NOT NULL DEFAULT 'Synalyze'");
        echo "Successfully added 'smtpFromName' column to 'globalsettings' table.\n";
    } else {
        echo "'smtpFromName' column already exists in 'globalsettings' table.\n";
    }

    // 2. Initialize the default values for smtpHost, smtpPort, smtpFromName and update smtpUsername
    $stmt = $pdo->prepare("UPDATE globalsettings SET 
        smtpHost = 'mail.synalyze.net', 
        smtpPort = 465, 
        smtpFromName = 'Synalyze',
        smtpUsername = '_mainaccount@synalyze.net'
        WHERE id = 1");
    $stmt->execute();
    echo "Updated globalsettings row 1 with default SMTP configurations and username.\n";

    $pdo->commit();
    echo "Migration completed successfully!\n";
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("Migration failed: " . $e->getMessage() . "\n");
}
