<?php
require_once dirname(__DIR__) . '/models/LandingModel.php';
require_once dirname(__DIR__) . '/models/DemoRequestModel.php';

class HomeController {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model = new LandingModel();
        $hero = $model->getHeroSection();
        $features = $model->getFeatures();
        $howItWorks = $model->getHowItWorksSteps();
        $deploymentOptions = $model->getDeploymentOptions();
        
        $hasDemoRequested = false;
        if (isset($_SESSION['user'])) {
            $demoModel = new DemoRequestModel();
            $hasDemoRequested = $demoModel->hasRequested($_SESSION['user']['id']);
        }
        
        $pageTitle = $hero['headline'] . " - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/home.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}
