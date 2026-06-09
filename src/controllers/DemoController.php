<?php

require_once dirname(__DIR__) . '/models/UserModel.php';
require_once dirname(__DIR__) . '/models/DemoRequestModel.php';
require_once dirname(__DIR__) . '/core/Mailer.php';

class DemoController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Handle submission of the demo request.
     */
    public function submit() {
        // 1. Ensure user is logged in
        if (!isset($_SESSION['user'])) {
            $_SESSION['demo_info'] = "Please log in or sign up first to request a free demo.";
            header("Location: " . baseUrl('/signup'));
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $demoModel = new DemoRequestModel();

        // 2. Enforce one request per user
        if ($demoModel->hasRequested($userId)) {
            $_SESSION['demo_info'] = "We have already received your demo request. We will contact you soon.";
            header("Location: " . baseUrl('/'));
            exit;
        }

        // 3. Get user details from database (for phone and email)
        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);

        if (!$user) {
            $_SESSION['demo_error'] = "User account not found. Please log in again.";
            header("Location: " . baseUrl('/login'));
            exit;
        }

        // 4. Save demo request to database
        $data = [
            'full_name' => $user['full_name'],
            'company_name' => $user['company_name'],
            'email' => $user['email'],
            'phone' => $user['phone']
        ];

        $saved = $demoModel->createRequest($userId, $data);

        if ($saved) {
            // 5. Send notification email to the owner
            $settings = get_settings();
            $ownerEmail = $settings['ownerEmail'] ?? 'system@synalyze.net';
            
            Mailer::sendDemoRequestNotification(
                $ownerEmail,
                $user['full_name'],
                $user['email'],
                $user['phone'],
                $user['company_name'] ?? ''
            );

            $_SESSION['demo_success'] = "Thank you, " . e($user['full_name']) . "! We will send you an email about your credentials and the Synalyze URL.";
        } else {
            $_SESSION['demo_error'] = "An error occurred while processing your request. Please try again later.";
        }

        header("Location: " . baseUrl('/'));
        exit;
    }
}
