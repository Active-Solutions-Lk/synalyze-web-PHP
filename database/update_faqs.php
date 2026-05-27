<?php
/**
 * Database Seeder for exact FAQs from the design image.
 */

require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    // We can instantiate the Database class directly to get the connection
    $pdo = \Core\Database::getInstance()->getConnection();
    
    // Enable foreign keys
    $pdo->exec('PRAGMA foreign_keys = ON;');
    
    // Begin transaction
    $pdo->beginTransaction();
    
    // Clear existing FAQ items and categories
    $pdo->exec("DELETE FROM faqitem");
    $pdo->exec("DELETE FROM faqcategory");
    
    // Reset sequence if sqlite_sequence exists
    $pdo->exec("DELETE FROM sqlite_sequence WHERE name IN ('faqcategory', 'faqitem')");
    
    // Insert Categories
    $stmtCat = $pdo->prepare("INSERT INTO faqcategory (name) VALUES (?)");
    
    $stmtCat->execute(['General Questions']);
    $generalCatId = $pdo->lastInsertId();
    
    $stmtCat->execute(['Technical Questions']);
    $technicalCatId = $pdo->lastInsertId();
    
    // Insert Items
    $stmtItem = $pdo->prepare("INSERT INTO faqitem (question, answer, faqCategoryId) VALUES (?, ?, ?)");
    
    // General Questions
    $generalFaqs = [
        [
            'question' => 'What is SYNALYZE?',
            'answer' => 'SYNALYZE is a comprehensive NAS log analysis solution designed to help businesses audit NAS usage, manage data growth, enhance security, and ensure compliance by transforming complex syslog entries into actionable insights.'
        ],
        [
            'question' => 'Which NAS brands does SYNALYZE support?',
            'answer' => 'SYNALYZE is specifically designed to support major NAS brands, with native and fully optimized support for Synology and QNAP devices. We continuously work to expand compatibility with other industry-standard NAS operating systems.'
        ],
        [
            'question' => 'Is SYNALYZE a cloud-only solution?',
            'answer' => 'No, SYNALYZE offers flexible deployment options. It can be deployed as a fully-managed Cloud-Based service for convenience, or as an On-Premises solution on your own local infrastructure for complete data control and compliance.'
        ]
    ];
    
    foreach ($generalFaqs as $faq) {
        $stmtItem->execute([$faq['question'], $faq['answer'], $generalCatId]);
    }
    
    // Technical Questions
    $technicalFaqs = [
        [
            'question' => 'How does SYNALYZE collect data from my NAS?',
            'answer' => 'SYNALYZE collects data by configuring your Synology or QNAP NAS to send Syslog entries to our central system. This standard protocol ensures light-weight, reliable, and real-time log transmission without requiring any local agent installation on the NAS.'
        ],
        [
            'question' => 'What kind of reports can I generate with SYNALYZE?',
            'answer' => 'You can generate comprehensive reports including User Behavior Reports, Critical Folder Reports, File Copy & Access Behavior, Storage Trend Analysis, and Capacity Forecasting to audit network storage usage and permissions.'
        ],
        [
            'question' => 'Can I integrate SYNALYZE with my existing security tools?',
            'answer' => 'Yes, SYNALYZE can integrate with your existing security tools, SIEM platforms, and other business intelligence applications. We offer robust API options and custom integrations for Enterprise environments.'
        ],
        [
            'question' => 'What are Secure Folders and Honeypots?',
            'answer' => 'Secure Folders let you designate and monitor high-sensitivity directories for strict permission auditing. Honeypots act as decoy folders designed to instantly detect, alert, and prevent unauthorized file access or potential ransomware and malware attacks.'
        ]
    ];
    
    foreach ($technicalFaqs as $faq) {
        $stmtItem->execute([$faq['question'], $faq['answer'], $technicalCatId]);
    }
    
    $pdo->commit();
    echo "FAQs database updated successfully with the exact design items!\n";
    
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Error updating FAQs: " . $e->getMessage() . "\n";
    exit(1);
}
