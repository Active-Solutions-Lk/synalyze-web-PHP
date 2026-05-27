<?php
require_once dirname(__DIR__) . '/models/PricingModel.php';

class PricingController {
    public function index() {
        $pricingModel = new PricingModel();
        $tiers = $pricingModel->getPricingTiers();
        $addons = $pricingModel->getPricingAddons();
        
        $deploymentOptions = $pricingModel->getPricingDeploymentOptions();
        
        $pageTitle = "Pricing - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/pricing.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}
