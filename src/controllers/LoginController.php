<?php

class LoginController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $pageTitle = 'Sign Into Your Account - Synalyze';
        $noBackground = true;
        $noFooter = true;

        ob_start();
        require dirname(__DIR__) . '/views/pages/login.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function submit() {
        $errors = [];

        // Get and sanitize inputs
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validation
        if (empty($email)) {
            $errors[] = "Email Address is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        // Prepare old input to preserve values
        $oldInput = [
            'email' => $email
        ];

        if (empty($errors)) {
            require_once dirname(__DIR__) . '/models/UserModel.php';
            $userModel = new UserModel();

            try {
                $user = $userModel->getUserByEmail($email);
                
                if ($user && password_verify($password, $user['password'])) {
                    // Password is correct, establish session
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'full_name' => $user['full_name'],
                        'email' => $user['email'],
                        'company_name' => $user['company_name'] ?? ''
                    ];

                    $_SESSION['success'] = "Welcome back, " . e($user['full_name']) . "!";
                    unset($_SESSION['old_input']);
                    unset($_SESSION['errors']);

                    // Redirect to Home page
                    header("Location: " . baseUrl('/'));
                    exit;
                } else {
                    $errors[] = "Invalid email address or password.";
                }
            } catch (Exception $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }

        // If we have errors, redirect back with errors and old inputs
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $oldInput;
        header("Location: " . baseUrl('/login'));
        exit;
    }

    public function logout() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $_SESSION['success'] = "You have been logged out successfully.";
        header("Location: " . baseUrl('/login'));
        exit;
    }
}
