<?php
// CLI Database Migration for Phone Number management
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to SQLite database successfully.\n";

    $pdo->beginTransaction();

    // 1. Check and add ownerPhone to globalsettings
    $stmt = $pdo->query("PRAGMA table_info(globalsettings)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $hasOwnerPhone = false;
    foreach ($columns as $column) {
        if ($column['name'] === 'ownerPhone') {
            $hasOwnerPhone = true;
            break;
        }
    }

    if (!$hasOwnerPhone) {
        $pdo->exec("ALTER TABLE globalsettings ADD COLUMN ownerPhone TEXT NOT NULL DEFAULT '+94764404456'");
        echo "Successfully added 'ownerPhone' column to 'globalsettings' table.\n";
    } else {
        echo "'ownerPhone' column already exists in 'globalsettings' table.\n";
    }

    // 2. Update global settings owner phone
    $stmt = $pdo->prepare("UPDATE globalsettings SET ownerPhone = '+94764404456'");
    $stmt->execute();
    echo "Updated globalsettings ownerPhone to +94764404456.\n";

    // 3. Update contact page phone numbers
    $stmt = $pdo->prepare("UPDATE ContactPage SET 
        phoneSalesValue = '+94764404456', 
        phoneSupportValue = '+94764404456'");
    $stmt->execute();
    echo "Updated ContactPage phone numbers to +94764404456.\n";

    // 4. Update docs page support phone
    $stmt = $pdo->prepare("UPDATE DocsPage SET supportPhone = '+94764404456'");
    $stmt->execute();
    echo "Updated DocsPage supportPhone to +94764404456.\n";

    $pdo->commit();
    echo "Migration completed successfully!\n";
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("Migration failed: " . $e->getMessage() . "\n");
}
