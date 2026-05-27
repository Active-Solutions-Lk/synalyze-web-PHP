<?php
class PricingModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getPricingTiers() {
        $tiers = $this->pdo->query("SELECT * FROM pricingtier")->fetchAll();
        foreach ($tiers as &$tier) {
            $stmt = $this->pdo->prepare("SELECT * FROM pricingfeature WHERE pricingTierId = ?");
            $stmt->execute([$tier['id']]);
            $tier['features'] = $stmt->fetchAll();
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
