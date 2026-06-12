<?php
// One-time database update script to clean up live rows and set emails to support@synalyze.net

require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    echo "Connected to database successfully.\n";

    $pdo->beginTransaction();

    // 1. Update global settings owner email
    $stmt = $pdo->prepare("UPDATE globalsettings SET ownerEmail = 'support@synalyze.net'");
    $stmt->execute();
    echo "Updated globalsettings ownerEmail to support@synalyze.net.\n";

    // 2. Update contact page emails
    $stmt = $pdo->prepare("UPDATE ContactPage SET 
        emailSalesValue = 'support@synalyze.net', 
        emailSupportValue = 'support@synalyze.net', 
        emailGeneralValue = 'support@synalyze.net'");
    $stmt->execute();
    echo "Updated ContactPage emails to support@synalyze.net.\n";

    // 3. Update docs page support email
    $stmt = $pdo->prepare("UPDATE DocsPage SET supportEmail = 'support@synalyze.net'");
    $stmt->execute();
    echo "Updated DocsPage supportEmail to support@synalyze.net.\n";

    $pdo->commit();
    echo "Database email cleanup migration completed successfully!\n";

} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("Database update failed: " . $e->getMessage() . "\n");
}
