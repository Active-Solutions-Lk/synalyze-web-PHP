<?php

class SignupController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $pageTitle = 'Create Your Account - Synalyze';
        $noBackground = true;
        $noFooter = true;

        ob_start();
        require dirname(__DIR__) . '/views/pages/signup.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function submit() {
        $errors = [];
        
        // Get and sanitize inputs
        $fullName = trim($_POST['full_name'] ?? '');
        $companyName = trim($_POST['company_name'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $terms = isset($_POST['terms']);

        // 1. Validation
        if (empty($fullName)) {
            $errors[] = "Full Name is required.";
        }
        if (empty($address)) {
            $errors[] = "Address is required.";
        }
        if (empty($phone)) {
            $errors[] = "Phone Number is required.";
        }
        if (empty($email)) {
            $errors[] = "Email Address is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }
        if (!$terms) {
            $errors[] = "You must agree to the Terms & Conditions.";
        }

        // Prepare old input to preserve values (excluding sensitive passwords)
        $oldInput = [
            'full_name' => $fullName,
            'company_name' => $companyName,
            'address' => $address,
            'phone' => $phone,
            'email' => $email
        ];

        // 2. Database validation & insertion
        if (empty($errors)) {
            require_once dirname(__DIR__) . '/models/UserModel.php';
            $userModel = new UserModel();

            try {
                // Check if email already exists
                if ($userModel->emailExists($email)) {
                    $errors[] = "The email address is already registered.";
                } else {
                    // Create new user
                    $userData = [
                        'full_name' => $fullName,
                        'company_name' => $companyName,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'password' => $password
                    ];
                    
                    if ($userModel->createUser($userData)) {
                        // Automatically log in the user upon successful signup
                        $user = $userModel->getUserByEmail($email);
                        if ($user) {
                            $_SESSION['user'] = [
                                'id' => $user['id'],
                                'full_name' => $user['full_name'],
                                'email' => $user['email'],
                                'company_name' => $user['company_name'] ?? ''
                            ];
                        }

                        $_SESSION['success'] = "Your account has been created successfully! Welcome to SYNALYZE.";
                        unset($_SESSION['old_input']);
                        unset($_SESSION['errors']);
                        header("Location: " . baseUrl('/'));
                        exit;
                    } else {
                        $errors[] = "Something went wrong during registration. Please try again.";
                    }
                }
            } catch (Exception $e) {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }

        // If we have errors, redirect back with errors and old inputs
        $_SESSION['errors'] = $errors;
        $_SESSION['old_input'] = $oldInput;
        header("Location: " . baseUrl('/signup'));
        exit;
    }
}
