<?php
require_once dirname(__DIR__, 2) . '/models/SettingsModel.php';

class SettingsAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $model = new SettingsModel();
        $settings = $model->getGlobalSettings();
        
        $pageTitle = "Global Settings - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/settings.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function update() {
        session_start();
        $pdo = \Core\Database::getInstance()->getConnection();
        
        $stmt = $pdo->prepare("UPDATE globalsettings SET siteName = ?, ownerEmail = ?, smtpUsername = ?, smtpPassword = ?, themeAccentColor = ?, primaryBackgroundColor = ? WHERE id = 1");
        $stmt->execute([
            $_POST['siteName'],
            $_POST['ownerEmail'],
            $_POST['smtpUsername'],
            $_POST['smtpPassword'],
            $_POST['themeAccentColor'],
            $_POST['primaryBackgroundColor']
        ]);
        
        $_SESSION['success'] = "Settings updated successfully.";
        header("Location: " . baseUrl('/admin/settings'));
        exit;
    }
}
