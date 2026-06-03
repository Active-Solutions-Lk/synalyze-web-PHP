<?php

class DashboardController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // Strict authentication check
        if (!isset($_SESSION['user'])) {
            $_SESSION['errors'] = ["Please sign in to access your dashboard."];
            header("Location: " . baseUrl('/login'));
            exit;
        }

        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();
        $user = $userModel->getUserByEmail($_SESSION['user']['email']);
        
        if (!$user) {
            unset($_SESSION['user']);
            $_SESSION['errors'] = ["User account not found."];
            header("Location: " . baseUrl('/login'));
            exit;
        }

        $pageTitle = 'Your Dashboard - Synalyze';
        
        require_once dirname(__DIR__) . '/models/DemoRequestModel.php';
        $demoModel = new DemoRequestModel();
        $demoRequest = $demoModel->getRequestByUserId($user['id']);

        ob_start();
        require dirname(__DIR__) . '/views/pages/dashboard.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }
}
