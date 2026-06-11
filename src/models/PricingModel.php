<?php
class PricingModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getPricingTiers() {
        $tiers = $this->pdo->query("SELECT * FROM pricingtier ORDER BY sortOrder ASC, id ASC")->fetchAll();
        foreach ($tiers as &$tier) {
            $stmt = $this->pdo->prepare("SELECT * FROM pricingfeature WHERE pricingTierId = ?");
            $stmt->execute([$tier['id']]);
            $tier['features'] = $stmt->fetchAll();
        }
        return $tiers;
    }

    public function getPricingTiersByType($type) {
        $stmt = $this->pdo->prepare("SELECT * FROM pricingtier WHERE deploymentType = ? ORDER BY sortOrder ASC, id ASC");
        $stmt->execute([$type]);
        $tiers = $stmt->fetchAll();
        foreach ($tiers as &$tier) {
            $stmtFeat = $this->pdo->prepare("SELECT * FROM pricingfeature WHERE pricingTierId = ?");
            $stmtFeat->execute([$tier['id']]);
            $tier['features'] = $stmtFeat->fetchAll();
        }
        return $tiers;
    }

    public function getPricingAddons() {
        return $this->pdo->query("SELECT * FROM pricingaddon")->fetchAll();
    }
    public function getPricingDeploymentOptions() {
        return $this->pdo->query("SELECT * FROM pricingdeploymentoption")->fetchAll();
    }
}
