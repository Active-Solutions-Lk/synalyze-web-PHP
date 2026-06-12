<?php
// CLI Database Migration for Contact Inbox management columns
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to SQLite database successfully.\n";

    $pdo->beginTransaction();

    // Check columns of contact_submissions
    $stmt = $pdo->query("PRAGMA table_info(contact_submissions)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $hasStatus = false;
    $hasActionNote = false;
    $hasActionedAt = false;

    foreach ($columns as $column) {
        if ($column['name'] === 'status') {
            $hasStatus = true;
        }
        if ($column['name'] === 'action_note') {
            $hasActionNote = true;
        }
        if ($column['name'] === 'actioned_at') {
            $hasActionedAt = true;
        }
    }

    if (!$hasStatus) {
        $pdo->exec("ALTER TABLE contact_submissions ADD COLUMN status TEXT NOT NULL DEFAULT 'unread'");
        echo "Successfully added 'status' column to 'contact_submissions' table.\n";
        
        // Update existing submissions to 'read' so they don't clutter the unread badge
        $pdo->exec("UPDATE contact_submissions SET status = 'read'");
        echo "Marked existing contact submissions as 'read'.\n";
    } else {
        echo "'status' column already exists.\n";
    }

    if (!$hasActionNote) {
        $pdo->exec("ALTER TABLE contact_submissions ADD COLUMN action_note TEXT");
        echo "Successfully added 'action_note' column to 'contact_submissions' table.\n";
    } else {
        echo "'action_note' column already exists.\n";
    }

    if (!$hasActionedAt) {
        $pdo->exec("ALTER TABLE contact_submissions ADD COLUMN actioned_at DATETIME");
        echo "Successfully added 'actioned_at' column to 'contact_submissions' table.\n";
    } else {
        echo "'actioned_at' column already exists.\n";
    }

    $pdo->commit();
    echo "Migration completed successfully!\n";
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("Migration failed: " . $e->getMessage() . "\n");
}
