<?php

require_once dirname(__DIR__, 2) . '/models/DemoRequestModel.php';
require_once dirname(__DIR__, 2) . '/core/Mailer.php';

class DemoAdminController {
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
        $model = new DemoRequestModel();
        $search = $_GET['search'] ?? '';
        $requests = $model->getAllRequests($search);
        
        $pageTitle = "Demo Requests Manager - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/demo_requests.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function sendCredentials() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $synalyzeUrl = trim($_POST['synalyze_url'] ?? '');
            $activationKey = trim($_POST['activation_key'] ?? '');

            if (!$id || empty($synalyzeUrl) || empty($activationKey)) {
                $this->redirectError("Please fill in all credential fields.", $id);
            }

            // Enforce format XXXX-XXXX-XXXX (12 uppercase English alphabetic letters only)
            if (!preg_match('/^[A-Z]{4}-[A-Z]{4}-[A-Z]{4}$/', $activationKey)) {
                $this->redirectError("Invalid activation key format. Must be 12 uppercase English letters formatted as XXXX-XXXX-XXXX (e.g. PAKQ-VMEA-HUMK).", $id);
            }

            $model = new DemoRequestModel();
            $request = $model->getRequestById($id);

            if (!$request) {
                $this->redirectError("Demo request not found.", $id);
            }

            // Send credentials email
            $emailSent = Mailer::sendDemoCredentials(
                $request['email'],
                $request['full_name'],
                $synalyzeUrl,
                $activationKey
            );

            if ($emailSent) {
                $model->markCredentialSent($id, $activationKey, $synalyzeUrl);
                $this->redirectSuccess("Credentials successfully sent to " . e($request['email']) . ".");
            } else {
                $this->redirectError("Failed to send the email. Please check SMTP settings.", $id);
            }
        }
        $this->redirectSuccess("Invalid request.");
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new DemoRequestModel();
                $model->deleteRequest($id);
                $this->redirectSuccess("Demo request deleted successfully.");
            }
        }
        $this->redirectSuccess("Invalid request.");
    }

    private function redirectSuccess($msg) {
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/demo'));
        exit;
    }

    private function redirectError($msg, $requestId = null) {
        $_SESSION['error'] = $msg;
        if ($requestId) {
            $_SESSION['active_row_id'] = $requestId; // to auto-expand the form again
        }
        header("Location: " . baseUrl('/admin/demo'));
        exit;
    }
}
