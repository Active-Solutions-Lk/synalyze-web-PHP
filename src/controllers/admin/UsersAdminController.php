<?php
require_once dirname(__DIR__, 2) . '/models/UserModel.php';

class UsersAdminController {
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
        $model = new UserModel();
        $search = $_GET['search'] ?? '';
        $users = $model->getAllUsers($search);
        
        $pageTitle = "Users Manager - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/users.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new UserModel();
                $model->deleteUser($id);
                $this->redirectSuccess("User deleted successfully.");
            }
        }
        $this->redirectSuccess("Invalid request.");
    }

    private function redirectSuccess($msg) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/users'));
        exit;
    }
}
