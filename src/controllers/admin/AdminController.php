<?php
class AdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            header("Location: " . baseUrl('/admin/login'));
            exit;
        }
    }

    public function dashboard() {
        $pageTitle = "Admin Dashboard - Synalyze";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/dashboard.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }
}
