<?php
class AdminController {
    public function dashboard() {
        $pageTitle = "Admin Dashboard - Synalyze";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/dashboard.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }
}
