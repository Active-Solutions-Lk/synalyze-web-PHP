<?php
require_once dirname(__DIR__) . '/models/LandingModel.php';

class HomeController {
    public function index() {
        $model = new LandingModel();
        $hero = $model->getHeroSection();
        $features = $model->getFeatures();
        $howItWorks = $model->getHowItWorksSteps();
        $deploymentOptions = $model->getDeploymentOptions();
        
        $pageTitle = $hero['headline'] . " - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/home.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}
