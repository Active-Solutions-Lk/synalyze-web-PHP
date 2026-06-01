<?php
class DocsModel {
    private $pdo;

    public function __construct() {
        $this->pdo = \Core\Database::getInstance()->getConnection();
    }

    // --- DocsPage General Settings ---
    public function getDocsPage() {
        return $this->pdo->query("SELECT * FROM DocsPage LIMIT 1")->fetch();
    }

    public function updateDocsPage($data) {
        $sql = "UPDATE DocsPage SET 
            eyebrowText = :eyebrowText,
            headline = :headline,
            subheadline = :subheadline,
            gettingStartedIntro = :gettingStartedIntro,
            onboardingTitle = :onboardingTitle,
            integrationIntro = :integrationIntro,
            integrationSetupTitle = :integrationSetupTitle,
            integrationSetupSubtitle = :integrationSetupSubtitle,
            integrationSetupPortNote = :integrationSetupPortNote,
            modulesIntro = :modulesIntro,
            deploymentIntro = :deploymentIntro,
            complianceTitle = :complianceTitle,
            supportIntro = :supportIntro,
            supportFaqTitle = :supportFaqTitle,
            supportContactTitle = :supportContactTitle,
            supportPhone = :supportPhone,
            supportEmail = :supportEmail,
            supportEmailNote = :supportEmailNote,
            supportHoursWeekdays = :supportHoursWeekdays,
            supportHoursSaturdays = :supportHoursSaturdays,
            supportHoursSundays = :supportHoursSundays
            WHERE id = 1";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    // --- DocsOnboardingStep ---
    public function getOnboardingSteps() {
        return $this->pdo->query("SELECT * FROM DocsOnboardingStep ORDER BY id ASC")->fetchAll();
    }

    public function createOnboardingStep($stepNumber, $title, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsOnboardingStep (stepNumber, title, description) VALUES (?, ?, ?)");
        return $stmt->execute([$stepNumber, $title, $description]);
    }

    public function updateOnboardingStep($id, $stepNumber, $title, $description) {
        $stmt = $this->pdo->prepare("UPDATE DocsOnboardingStep SET stepNumber = ?, title = ?, description = ? WHERE id = ?");
        return $stmt->execute([$stepNumber, $title, $description, $id]);
    }

    public function deleteOnboardingStep($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsOnboardingStep WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- DocsIntegrationField ---
    public function getIntegrationFields() {
        return $this->pdo->query("SELECT * FROM DocsIntegrationField ORDER BY id ASC")->fetchAll();
    }

    public function createIntegrationField($fieldName, $fieldValue, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsIntegrationField (fieldName, fieldValue, description) VALUES (?, ?, ?)");
        return $stmt->execute([$fieldName, $fieldValue, $description]);
    }

    public function updateIntegrationField($id, $fieldName, $fieldValue, $description) {
        $stmt = $this->pdo->prepare("UPDATE DocsIntegrationField SET fieldName = ?, fieldValue = ?, description = ? WHERE id = ?");
        return $stmt->execute([$fieldName, $fieldValue, $description, $id]);
    }

    public function deleteIntegrationField($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsIntegrationField WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- DocsModule ---
    public function getModules() {
        return $this->pdo->query("SELECT * FROM DocsModule ORDER BY id ASC")->fetchAll();
    }

    public function createModule($iconName, $title, $description, $bulletPoints) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsModule (iconName, title, description, bulletPoints) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$iconName, $title, $description, $bulletPoints]);
    }

    public function updateModule($id, $iconName, $title, $description, $bulletPoints) {
        $stmt = $this->pdo->prepare("UPDATE DocsModule SET iconName = ?, title = ?, description = ?, bulletPoints = ? WHERE id = ?");
        return $stmt->execute([$iconName, $title, $description, $bulletPoints, $id]);
    }

    public function deleteModule($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsModule WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- DocsDeploymentOption ---
    public function getDeploymentOptions() {
        return $this->pdo->query("SELECT * FROM DocsDeploymentOption ORDER BY id ASC")->fetchAll();
    }

    public function createDeploymentOption($badge, $iconName, $title, $description, $bulletPoints) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsDeploymentOption (badge, iconName, title, description, bulletPoints) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$badge, $iconName, $title, $description, $bulletPoints]);
    }

    public function updateDeploymentOption($id, $badge, $iconName, $title, $description, $bulletPoints) {
        $stmt = $this->pdo->prepare("UPDATE DocsDeploymentOption SET badge = ?, iconName = ?, title = ?, description = ?, bulletPoints = ? WHERE id = ?");
        return $stmt->execute([$badge, $iconName, $title, $description, $bulletPoints, $id]);
    }

    public function deleteDeploymentOption($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsDeploymentOption WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- DocsComplianceItem ---
    public function getComplianceItems() {
        return $this->pdo->query("SELECT * FROM DocsComplianceItem ORDER BY id ASC")->fetchAll();
    }

    public function createComplianceItem($title, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsComplianceItem (title, description) VALUES (?, ?)");
        return $stmt->execute([$title, $description]);
    }

    public function updateComplianceItem($id, $title, $description) {
        $stmt = $this->pdo->prepare("UPDATE DocsComplianceItem SET title = ?, description = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $id]);
    }

    public function deleteComplianceItem($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsComplianceItem WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // --- DocsTroubleshootingFaq ---
    public function getTroubleshootingFaqs() {
        return $this->pdo->query("SELECT * FROM DocsTroubleshootingFaq ORDER BY id ASC")->fetchAll();
    }

    public function createTroubleshootingFaq($question, $answer) {
        $stmt = $this->pdo->prepare("INSERT INTO DocsTroubleshootingFaq (question, answer) VALUES (?, ?)");
        return $stmt->execute([$question, $answer]);
    }

    public function updateTroubleshootingFaq($id, $question, $answer) {
        $stmt = $this->pdo->prepare("UPDATE DocsTroubleshootingFaq SET question = ?, answer = ? WHERE id = ?");
        return $stmt->execute([$question, $answer, $id]);
    }

    public function deleteTroubleshootingFaq($id) {
        $stmt = $this->pdo->prepare("DELETE FROM DocsTroubleshootingFaq WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
