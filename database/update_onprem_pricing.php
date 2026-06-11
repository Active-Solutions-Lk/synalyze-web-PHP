<?php
require_once dirname(__DIR__) . '/src/core/Database.php';

try {
    $pdo = \Core\Database::getInstance()->getConnection();
    
    // Update ID 4: "Non-Manageable" -> Hardware Appliance (We provide the hardware)
    $stmt1 = $pdo->prepare("UPDATE pricingtier SET 
        name = 'Turnkey Appliance',
        displayTitle = 'Turnkey Appliance',
        idealForText = 'Organizations seeking a plug-and-play hardware solution delivered directly to their data center.',
        featuresSubtitle = ' '
        WHERE id = 4");
    $stmt1->execute();
    
    // Update ID 5: "Manageable" -> Software Appliance (Client provides hardware)
    $stmt2 = $pdo->prepare("UPDATE pricingtier SET 
        name = 'Software License',
        displayTitle = 'Software License',
        idealForText = 'Enterprises with existing infrastructure preferring to deploy Synalyze on their own hardware or VMs.',
        featuresSubtitle = ' '
        WHERE id = 5");
    $stmt2->execute();
    
    // Now let's delete existing features and add new professional ones
    $pdo->query("DELETE FROM pricingfeature WHERE pricingTierId IN (4, 5)");
    
    // Insert new features for ID 4 (Hardware Appliance)
    $features4 = [
        'Enterprise-grade 1U Rackmount Server included',
        'Pre-installed & configured Synalyze Engine',
        'On-site hardware warranty & replacement SLA',
        'Isolated air-gapped network compatibility',
        'Universal Search & Advanced Security Monitoring'
    ];
    
    $stmt3 = $pdo->prepare("INSERT INTO pricingfeature (pricingTierId, name) VALUES (?, ?)");
    foreach ($features4 as $f) {
        $stmt3->execute([4, $f]);
    }
    
    // Insert new features for ID 5 (Software License)
    $features5 = [
        'Deployable on VMware, Hyper-V, or Bare-Metal',
        'Leverage existing enterprise storage & compute',
        'Complete data sovereignty & physical control',
        'Dedicated account manager & integration support',
        'Advanced threat & malware monitoring'
    ];
    
    foreach ($features5 as $f) {
        $stmt3->execute([5, $f]);
    }
    
    echo "Successfully updated on-premises pricing tiers and features.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
