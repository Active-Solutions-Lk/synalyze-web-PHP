<?php

class ForgotPasswordController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function forgot() {
        $pageTitle = 'Forgot Your Password - Synalyze';
        $noBackground = true;
        $noFooter = true;

        ob_start();
        require dirname(__DIR__) . '/views/pages/forgot-password.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function submitForgot() {
        $errors = [];
        $email = trim($_POST['email'] ?? '');

        if (empty($email)) {
            $errors[] = "Email Address is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_input'] = ['email' => $email];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();

        try {
            $user = $userModel->getUserByEmail($email);
            
            // If user exists, generate reset token and send email
            if ($user) {
                // Generate a cryptographically secure random token (64 hex characters)
                $token = bin2hex(random_bytes(32));
                $hashedToken = hash('sha256', $token);
                
                // Set token expiration to exactly 24 hours (86400 seconds) from now
                $expiresAt = date('Y-m-d H:i:s', time() + 86400);

                if ($userModel->updateResetToken($email, $hashedToken, $expiresAt)) {
                    $resetLink = baseUrl('/reset-password?token=' . $token);
                    
                    // Dispatch the email
                    require_once dirname(__DIR__) . '/core/Mailer.php';
                    Mailer::sendPasswordResetEmail($email, $user['full_name'], $resetLink);
                }
            }
        } catch (Exception $e) {
            error_log("Forgot password database/mailer error: " . $e->getMessage());
        }

        // Return generic message regardless of email existence to protect against enumeration
        $_SESSION['success'] = "If the email address matches an active account, we have sent a password reset link to it.";
        unset($_SESSION['old_input']);
        unset($_SESSION['errors']);

        header("Location: " . baseUrl('/forgot-password'));
        exit;
    }

    public function reset() {
        $token = $_GET['token'] ?? '';
        
        if (empty($token)) {
            $_SESSION['errors'] = ["No password reset token provided. Please request a new one."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();

        $hashedToken = hash('sha256', $token);
        $user = $userModel->getUserByResetToken($hashedToken);

        if (!$user) {
            $_SESSION['errors'] = ["Invalid or expired password reset link. Please request a new one."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        // Validate expiration
        if (strtotime($user['reset_token_expires_at']) < time()) {
            $_SESSION['errors'] = ["This password reset link has expired. Please request a new one."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        $pageTitle = 'Reset Your Password - Synalyze';
        $noBackground = true;
        $noFooter = true;

        ob_start();
        require dirname(__DIR__) . '/views/pages/reset-password.php';
        $content = ob_get_clean();

        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function submitReset() {
        $errors = [];
        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (empty($token)) {
            $_SESSION['errors'] = ["Invalid token request."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        if (empty($password)) {
            $errors[] = "New Password is required.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }

        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }

        require_once dirname(__DIR__) . '/models/UserModel.php';
        $userModel = new UserModel();

        $hashedToken = hash('sha256', $token);
        $user = $userModel->getUserByResetToken($hashedToken);

        if (!$user) {
            $_SESSION['errors'] = ["Invalid or expired password reset link. Please request a new one."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        // Validate expiration again
        if (strtotime($user['reset_token_expires_at']) < time()) {
            $_SESSION['errors'] = ["This password reset link has expired. Please request a new one."];
            header("Location: " . baseUrl('/forgot-password'));
            exit;
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: " . baseUrl('/reset-password?token=' . urlencode($token)));
            exit;
        }

        // Update password and clear reset token
        try {
            if ($userModel->updatePassword($user['id'], $password)) {
                $userModel->clearResetToken($user['id']);
                $_SESSION['success'] = "Your password has been successfully reset. You can now log in.";
                unset($_SESSION['errors']);
                header("Location: " . baseUrl('/login'));
                exit;
            } else {
                $errors[] = "Unable to reset password. Please try again.";
            }
        } catch (Exception $e) {
            $errors[] = "Database error: " . $e->getMessage();
        }

        $_SESSION['errors'] = $errors;
        header("Location: " . baseUrl('/reset-password?token=' . urlencode($token)));
        exit;
    }
}
