<?php

class AdminLoginController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        // If already logged in, redirect to admin dashboard
        if (isset($_SESSION['admin'])) {
            header("Location: " . baseUrl('/admin'));
            exit;
        }

        $pageTitle = 'Admin Login - Synalyze';

        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/login.php';
        $content = ob_get_clean();

        require dirname(__DIR__, 2) . '/views/layouts/admin_auth.php';
    }

    public function submit() {
        $errors = [];

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($username)) {
            $errors[] = "Username is required.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        $oldInput = [
            'username' => $username
        ];

        if (empty($errors)) {
            $config = require dirname(__DIR__, 3) . '/config/app.php';
            $adminUser = $config['admin_username'] ?? 'admin';
            $adminHash = $config['admin_password'] ?? '';

            if ($username === $adminUser && password_verify($password, $adminHash)) {
                $_SESSION['admin'] = [
                    'username' => $username,
                    'logged_in_at' => date('Y-m-d H:i:s')
                ];
                
                unset($_SESSION['old_input']);
                unset($_SESSION['errors']);

                header("Location: " . baseUrl('/admin'));
                exit;
            } else {
                $errors[] = "Invalid username or password.";
            }
        }

        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $oldInput;
        header("Location: " . baseUrl('/admin/login'));
        exit;
    }

    public function logout() {
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        $_SESSION['success'] = "You have been logged out successfully.";
        header("Location: " . baseUrl('/admin/login'));
        exit;
    }
}
