<?php
require_once dirname(__DIR__, 2) . '/models/LandingModel.php';

class LandingAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $model = new LandingModel();
        $hero = $model->getHeroSection();
        $features = $model->getFeatures();
        $howItWorks = $model->getHowItWorksSteps();
        $deploymentOptions = $model->getDeploymentOptions();
        
        $pageTitle = "Landing Page - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/landing.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function updateHero() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE herosection SET eyebrowText=?, headline=?, subheadline=?, searchPlaceholder=?, ctaButtonText=? WHERE id=1");
        $stmt->execute([
            $_POST['eyebrowText'], $_POST['headline'], $_POST['subheadline'], 
            $_POST['searchPlaceholder'], $_POST['ctaButtonText']
        ]);
        $this->redirectSuccess("Hero section updated.");
    }

    public function createFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO feature (iconName, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['iconName'], $_POST['title'], $_POST['description']]);
        $this->redirectSuccess("Feature added.");
    }

    public function deleteFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM feature WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Feature deleted.");
    }

    public function createStep() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO howitworksstep (stepNumber, title, description) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['stepNumber'], $_POST['title'], $_POST['description']]);
        $this->redirectSuccess("Step added.");
    }

    public function deleteStep() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM howitworksstep WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Step deleted.");
    }

    public function createOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO deploymentoption (name, subtitle, description, bulletPoints, imageUrl) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['name'], $_POST['subtitle'], $_POST['description'], 
            $_POST['bulletPoints'], $_POST['imageUrl']
        ]);
        $this->redirectSuccess("Deployment option added.");
    }

    public function deleteOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM deploymentoption WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Deployment option deleted.");
    }

    public function updateFeature() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE feature SET iconName=?, title=?, description=? WHERE id=?");
        $stmt->execute([$_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['id']]);
        $this->redirectSuccess("Feature updated.");
    }

    public function updateStep() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE howitworksstep SET stepNumber=?, title=?, description=? WHERE id=?");
        $stmt->execute([$_POST['stepNumber'], $_POST['title'], $_POST['description'], $_POST['id']]);
        $this->redirectSuccess("Step updated.");
    }

    public function updateOption() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE deploymentoption SET name=?, subtitle=?, description=?, bulletPoints=?, imageUrl=? WHERE id=?");
        $stmt->execute([
            $_POST['name'], $_POST['subtitle'], $_POST['description'], 
            $_POST['bulletPoints'], $_POST['imageUrl'], $_POST['id']
        ]);
        $this->redirectSuccess("Deployment option updated.");
    }

    private function redirectSuccess($msg) {
        session_start();
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/landing'));
        exit;
    }
}
