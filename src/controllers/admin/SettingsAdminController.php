<?php
require_once dirname(__DIR__, 2) . '/models/SettingsModel.php';

class SettingsAdminController {
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
        $model = new SettingsModel();
        $settings = $model->getGlobalSettings();
        
        $config = require dirname(__DIR__, 3) . '/config/app.php';
        $adminUsername = $config['admin_username'] ?? 'admin';
        
        $pageTitle = "Global Settings - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/settings.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function update() {
        $pdo = \Core\Database::getInstance()->getConnection();
        
        $stmt = $pdo->prepare("UPDATE globalsettings SET 
            siteName = ?, 
            ownerEmail = ?, 
            ownerPhone = ?, 
            smtpUsername = ?, 
            smtpPassword = ?, 
            smtpHost = ?, 
            smtpPort = ?, 
            smtpFromName = ?, 
            themeAccentColor = ?, 
            primaryBackgroundColor = ? 
            WHERE id = 1");
        $stmt->execute([
            $_POST['siteName'],
            $_POST['ownerEmail'],
            $_POST['ownerPhone'],
            $_POST['smtpUsername'],
            $_POST['smtpPassword'],
            $_POST['smtpHost'],
            (int)$_POST['smtpPort'],
            $_POST['smtpFromName'],
            $_POST['themeAccentColor'],
            $_POST['primaryBackgroundColor']
        ]);
        
        $_SESSION['success'] = "Settings updated successfully.";
        header("Location: " . baseUrl('/admin/settings'));
        exit;
    }

    public function testEmail() {
        header('Content-Type: application/json');
        
        try {
            $pdo = \Core\Database::getInstance()->getConnection();
            $stmt = $pdo->query("SELECT ownerEmail FROM globalsettings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            $ownerEmail = $settings['ownerEmail'] ?? 'support@synalyze.net';

            require_once dirname(__DIR__, 2) . '/core/Mailer.php';
            $success = Mailer::sendContactNotification(
                $ownerEmail,
                "SMTP Tester",
                $ownerEmail,
                "Synalyze System",
                "SMTP Test Connection",
                "Hello!\n\nThis is a test email sent from the Synalyze Admin Settings page to verify that your SMTP server configuration is working correctly.\n\nIf you received this email, your mail server configurations are correct!"
            );

            if ($success) {
                echo json_encode([
                    'success' => true,
                    'message' => "Test email successfully sent to {$ownerEmail}. Please check your inbox (and spam folder if not found)."
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => "Failed to send test email. Please check your SMTP username, password, host, and port settings."
                ]);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => "An error occurred: " . $e->getMessage()
            ]);
        }
        exit;
    }


    public function updateCredentials() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . baseUrl('/admin/settings'));
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($username)) {
            $_SESSION['error'] = "Username cannot be empty.";
            header("Location: " . baseUrl('/admin/settings'));
            exit;
        }

        if (empty($currentPassword)) {
            $_SESSION['error'] = "Current password is required to save changes.";
            header("Location: " . baseUrl('/admin/settings'));
            exit;
        }

        $config = require dirname(__DIR__, 3) . '/config/app.php';
        $adminUser = $config['admin_username'] ?? 'admin';
        $adminHash = $config['admin_password'] ?? '';

        if (!password_verify($currentPassword, $adminHash)) {
            $_SESSION['error'] = "Incorrect current password.";
            header("Location: " . baseUrl('/admin/settings'));
            exit;
        }

        $updates = [
            'ADMIN_USERNAME' => $username
        ];

        if (!empty($newPassword)) {
            if (strlen($newPassword) < 8) {
                $_SESSION['error'] = "New password must be at least 8 characters long.";
                header("Location: " . baseUrl('/admin/settings'));
                exit;
            }

            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "New passwords do not match.";
                header("Location: " . baseUrl('/admin/settings'));
                exit;
            }

            $updates['ADMIN_PASSWORD'] = password_hash($newPassword, PASSWORD_BCRYPT);
        }

        $envPath = dirname(__DIR__, 3) . '/.env';
        $isWritable = file_exists($envPath) ? is_writable($envPath) : is_writable(dirname($envPath));

        if (!$isWritable) {
            $_SESSION['error'] = "The configuration file (.env) is not writable. Please check permissions.";
            header("Location: " . baseUrl('/admin/settings'));
            exit;
        }

        // Update .env file
        $lines = file_exists($envPath) ? file($envPath, FILE_IGNORE_NEW_LINES) : [];
        $updatedKeys = [];

        foreach ($lines as $index => $line) {
            $trimmed = trim($line);
            if (empty($trimmed) || strpos($trimmed, '#') === 0) {
                continue;
            }

            $parts = explode('=', $line, 2);
            if (count($parts) > 0) {
                $key = trim($parts[0]);
                if (array_key_exists($key, $updates)) {
                    $lines[$index] = "{$key}={$updates[$key]}";
                    $updatedKeys[$key] = true;
                }
            }
        }

        foreach ($updates as $key => $value) {
            if (!isset($updatedKeys[$key])) {
                $lines[] = "{$key}={$value}";
            }
        }

        file_put_contents($envPath, implode("\n", $lines) . "\n");

        // Update session
        if (isset($_SESSION['admin'])) {
            $_SESSION['admin']['username'] = $username;
        }

        $_SESSION['success'] = "Admin credentials updated successfully.";
        header("Location: " . baseUrl('/admin/settings'));
        exit;
    }
}
