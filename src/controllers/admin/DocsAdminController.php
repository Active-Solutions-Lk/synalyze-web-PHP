<?php
require_once dirname(__DIR__, 2) . '/models/DocsModel.php';

class DocsAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            header("Location: " . baseUrl('/admin/login'));
            exit;
        }
    }

    public function index() {
        $model = new DocsModel();
        $docsPage = $model->getDocsPage();
        $onboardingSteps = $model->getOnboardingSteps();
        $integrationFields = $model->getIntegrationFields();
        $modules = $model->getModules();
        $deploymentOptions = $model->getDeploymentOptions();
        $complianceItems = $model->getComplianceItems();
        $faqs = $model->getTroubleshootingFaqs();

        $pageTitle = "Docs Page - Admin";

        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/docs.php';
        $content = ob_get_clean();

        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    // --- Page settings ---
    public function updatePage() {
        $model = new DocsModel();
        $data = [
            'eyebrowText' => $_POST['eyebrowText'] ?? '',
            'headline' => $_POST['headline'] ?? '',
            'subheadline' => $_POST['subheadline'] ?? '',
            'gettingStartedIntro' => $_POST['gettingStartedIntro'] ?? '',
            'onboardingTitle' => $_POST['onboardingTitle'] ?? '',
            'integrationIntro' => $_POST['integrationIntro'] ?? '',
            'integrationSetupTitle' => $_POST['integrationSetupTitle'] ?? '',
            'integrationSetupSubtitle' => $_POST['integrationSetupSubtitle'] ?? '',
            'integrationSetupPortNote' => $_POST['integrationSetupPortNote'] ?? '',
            'modulesIntro' => $_POST['modulesIntro'] ?? '',
            'deploymentIntro' => $_POST['deploymentIntro'] ?? '',
            'complianceTitle' => $_POST['complianceTitle'] ?? '',
            'supportIntro' => $_POST['supportIntro'] ?? '',
            'supportFaqTitle' => $_POST['supportFaqTitle'] ?? '',
            'supportContactTitle' => $_POST['supportContactTitle'] ?? '',
            'supportPhone' => $_POST['supportPhone'] ?? '',
            'supportEmail' => $_POST['supportEmail'] ?? '',
            'supportEmailNote' => $_POST['supportEmailNote'] ?? '',
            'supportHoursWeekdays' => $_POST['supportHoursWeekdays'] ?? '',
            'supportHoursSaturdays' => $_POST['supportHoursSaturdays'] ?? '',
            'supportHoursSundays' => $_POST['supportHoursSundays'] ?? ''
        ];

        if ($model->updateDocsPage($data)) {
            $this->redirectSuccess("Docs page header settings updated.");
        } else {
            $this->redirectError("Failed to update page settings.");
        }
    }

    // --- Onboarding steps ---
    public function createOnboarding() {
        $model = new DocsModel();
        if ($model->createOnboardingStep($_POST['stepNumber'], $_POST['title'], $_POST['description'])) {
            $this->redirectSuccess("Onboarding step added successfully.");
        } else {
            $this->redirectError("Failed to add onboarding step.");
        }
    }

    public function updateOnboarding() {
        $model = new DocsModel();
        if ($model->updateOnboardingStep($_POST['id'], $_POST['stepNumber'], $_POST['title'], $_POST['description'])) {
            $this->redirectSuccess("Onboarding step updated successfully.");
        } else {
            $this->redirectError("Failed to update onboarding step.");
        }
    }

    public function deleteOnboarding() {
        $model = new DocsModel();
        if ($model->deleteOnboardingStep($_POST['id'])) {
            $this->redirectSuccess("Onboarding step deleted successfully.");
        } else {
            $this->redirectError("Failed to delete onboarding step.");
        }
    }

    // --- Syslog fields ---
    public function createIntegration() {
        $model = new DocsModel();
        if ($model->createIntegrationField($_POST['fieldName'], $_POST['fieldValue'], $_POST['description'])) {
            $this->redirectSuccess("Integration configuration field added.");
        } else {
            $this->redirectError("Failed to add integration field.");
        }
    }

    public function updateIntegration() {
        $model = new DocsModel();
        if ($model->updateIntegrationField($_POST['id'], $_POST['fieldName'], $_POST['fieldValue'], $_POST['description'])) {
            $this->redirectSuccess("Integration configuration field updated.");
        } else {
            $this->redirectError("Failed to update integration field.");
        }
    }

    public function deleteIntegration() {
        $model = new DocsModel();
        if ($model->deleteIntegrationField($_POST['id'])) {
            $this->redirectSuccess("Integration configuration field deleted.");
        } else {
            $this->redirectError("Failed to delete integration field.");
        }
    }

    // --- Core modules ---
    public function createModule() {
        $model = new DocsModel();
        if ($model->createModule($_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['bulletPoints'])) {
            $this->redirectSuccess("Core module card added successfully.");
        } else {
            $this->redirectError("Failed to add core module.");
        }
    }

    public function updateModule() {
        $model = new DocsModel();
        if ($model->updateModule($_POST['id'], $_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['bulletPoints'])) {
            $this->redirectSuccess("Core module card updated successfully.");
        } else {
            $this->redirectError("Failed to update core module.");
        }
    }

    public function deleteModule() {
        $model = new DocsModel();
        if ($model->deleteModule($_POST['id'])) {
            $this->redirectSuccess("Core module card deleted successfully.");
        } else {
            $this->redirectError("Failed to delete core module.");
        }
    }

    // --- Deployment options ---
    public function createDeployment() {
        $model = new DocsModel();
        if ($model->createDeploymentOption($_POST['badge'], $_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['bulletPoints'])) {
            $this->redirectSuccess("Deployment option card added successfully.");
        } else {
            $this->redirectError("Failed to add deployment option.");
        }
    }

    public function updateDeployment() {
        $model = new DocsModel();
        if ($model->updateDeploymentOption($_POST['id'], $_POST['badge'], $_POST['iconName'], $_POST['title'], $_POST['description'], $_POST['bulletPoints'])) {
            $this->redirectSuccess("Deployment option card updated successfully.");
        } else {
            $this->redirectError("Failed to update deployment option.");
        }
    }

    public function deleteDeployment() {
        $model = new DocsModel();
        if ($model->deleteDeploymentOption($_POST['id'])) {
            $this->redirectSuccess("Deployment option card deleted successfully.");
        } else {
            $this->redirectError("Failed to delete deployment option.");
        }
    }

    // --- Compliance items ---
    public function createCompliance() {
        $model = new DocsModel();
        if ($model->createComplianceItem($_POST['title'], $_POST['description'])) {
            $this->redirectSuccess("Compliance certificate standard added.");
        } else {
            $this->redirectError("Failed to add compliance item.");
        }
    }

    public function updateCompliance() {
        $model = new DocsModel();
        if ($model->updateComplianceItem($_POST['id'], $_POST['title'], $_POST['description'])) {
            $this->redirectSuccess("Compliance certificate standard updated.");
        } else {
            $this->redirectError("Failed to update compliance item.");
        }
    }

    public function deleteCompliance() {
        $model = new DocsModel();
        if ($model->deleteComplianceItem($_POST['id'])) {
            $this->redirectSuccess("Compliance certificate standard deleted.");
        } else {
            $this->redirectError("Failed to delete compliance item.");
        }
    }

    // --- FAQ accordion items ---
    public function createFaq() {
        $model = new DocsModel();
        if ($model->createTroubleshootingFaq($_POST['question'], $_POST['answer'])) {
            $this->redirectSuccess("Troubleshooting FAQ accordion item added.");
        } else {
            $this->redirectError("Failed to add troubleshooting FAQ.");
        }
    }

    public function updateFaq() {
        $model = new DocsModel();
        if ($model->updateTroubleshootingFaq($_POST['id'], $_POST['question'], $_POST['answer'])) {
            $this->redirectSuccess("Troubleshooting FAQ accordion item updated.");
        } else {
            $this->redirectError("Failed to update troubleshooting FAQ.");
        }
    }

    public function deleteFaq() {
        $model = new DocsModel();
        if ($model->deleteTroubleshootingFaq($_POST['id'])) {
            $this->redirectSuccess("Troubleshooting FAQ accordion item deleted.");
        } else {
            $this->redirectError("Failed to delete troubleshooting FAQ.");
        }
    }

    // --- Redirect helpers ---
    private function redirectSuccess($msg) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/docs'));
        exit;
    }

    private function redirectError($msg) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['error'] = $msg;
        header("Location: " . baseUrl('/admin/docs'));
        exit;
    }
}
