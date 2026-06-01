<?php
require_once dirname(__DIR__) . '/models/DocsModel.php';

class DocsController {
    public function index() {
        $model = new DocsModel();
        $docsPage = $model->getDocsPage();
        
        $onboardingSteps = $model->getOnboardingSteps();
        $integrationFields = $model->getIntegrationFields();
        $modules = $model->getModules();
        $deploymentOptions = $model->getDeploymentOptions();
        $complianceItems = $model->getComplianceItems();
        $faqs = $model->getTroubleshootingFaqs();
        
        $pageTitle = ($docsPage['headline'] ?? "Documentation") . " - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/docs.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}
