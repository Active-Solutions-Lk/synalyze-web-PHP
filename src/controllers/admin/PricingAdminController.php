<?php
require_once dirname(__DIR__, 2) . '/models/PricingModel.php';

class PricingAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $model = new PricingModel();
        
        $tiers = $model->getPricingTiers();
        $addons = $model->getPricingAddons();
        $deploymentOptions = $model->getPricingDeploymentOptions();
        
        $pageTitle = "Pricing Manager - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/pricing.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function createTier() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO pricingtier (name, displayTitle, idealForText, featuresSubtitle, deploymentOptions, monthlyPrice, annualPrice, ctaText) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], $_POST['displayTitle'], $_POST['idealForText'], 
            $_POST['featuresSubtitle'], $_POST['deploymentOptions'], 
            $_POST['monthlyPrice'], $_POST['annualPrice'], $_POST['ctaText']
        ]);
        $this->redirectSuccess("Pricing tier added.");
    }

    public function deleteTier() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM pricingtier WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Pricing tier deleted.");
    }

    public function createFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO pricingfeature (name, pricingTierId) VALUES (?, ?)");
        $stmt->execute([$_POST['name'], $_POST['pricingTierId']]);
        $this->redirectSuccess("Feature added.");
    }

    public function deleteFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM pricingfeature WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Feature deleted.");
    }

    public function createAddon() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO pricingaddon (name, description, price) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['description'], $_POST['price']]);
        $this->redirectSuccess("Add-on added.");
    }

    public function deleteAddon() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM pricingaddon WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Add-on deleted.");
    }

    public function updateTier() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE pricingtier SET name=?, displayTitle=?, idealForText=?, featuresSubtitle=?, deploymentOptions=?, monthlyPrice=?, annualPrice=?, ctaText=? WHERE id=?");
        $stmt->execute([
            $_POST['name'], $_POST['displayTitle'], $_POST['idealForText'], 
            $_POST['featuresSubtitle'], $_POST['deploymentOptions'], 
            $_POST['monthlyPrice'], $_POST['annualPrice'], $_POST['ctaText'],
            $_POST['id']
        ]);
        $this->redirectSuccess("Pricing tier updated.");
    }

    public function updateFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE pricingfeature SET name=? WHERE id=?");
        $stmt->execute([$_POST['name'], $_POST['id']]);
        $this->redirectSuccess("Feature updated.");
    }

    public function updateAddon() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE pricingaddon SET name=?, description=?, price=? WHERE id=?");
        $stmt->execute([$_POST['name'], $_POST['description'], $_POST['price'], $_POST['id']]);
        $this->redirectSuccess("Add-on updated.");
    }

    public function createOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO pricingdeploymentoption (name, subtitle, description, imageUrl) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], $_POST['subtitle'], $_POST['description'], $_POST['imageUrl']
        ]);
        $this->redirectSuccess("Deployment option added.");
    }

    public function deleteOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM pricingdeploymentoption WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Deployment option deleted.");
    }

    public function updateOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE pricingdeploymentoption SET name=?, subtitle=?, description=?, imageUrl=? WHERE id=?");
        $stmt->execute([
            $_POST['name'], $_POST['subtitle'], $_POST['description'], $_POST['imageUrl'], $_POST['id']
        ]);
        $this->redirectSuccess("Deployment option updated.");
    }

    private function redirectSuccess($msg) {
        session_start();
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/pricing'));
        exit;
    }
}
