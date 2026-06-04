<?php

require_once dirname(__DIR__) . '/models/SubscriberModel.php';

class SubscribeController {
    public function submit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Support both regular form POST and JSON POST
        $email = '';
        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
        if (stripos($contentType, "application/json") !== false) {
            $rawBody = file_get_contents("php://input");
            $data = json_decode($rawBody, true);
            $email = $data['email'] ?? '';
        } else {
            $email = $_POST['email'] ?? '';
        }

        $email = trim($email);

        header('Content-Type: application/json');

        if (empty($email)) {
            echo json_encode([
                'success' => false,
                'message' => 'Email address is required.'
            ]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Please enter a valid email address.'
            ]);
            exit;
        }

        try {
            $model = new SubscriberModel();
            $result = $model->subscribe($email);

            if ($result === 'ok') {
                Mailer::sendSubscriberWelcomeEmail($email);
                echo json_encode([
                    'success' => true,
                    'message' => "You're subscribed! Thank you."
                ]);
            } else {
                echo json_encode([
                    'success' => true, // Treat already subscribed as success, but message notes it
                    'message' => "Already subscribed.",
                    'already_subscribed' => true
                ]);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred. Please try again later.'
            ]);
        }
        exit;
    }

    public function unsubscribe() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = '';
        $contentType = $_SERVER["CONTENT_TYPE"] ?? '';
        if (stripos($contentType, "application/json") !== false) {
            $rawBody = file_get_contents("php://input");
            $data = json_decode($rawBody, true);
            $email = $data['email'] ?? '';
        } else {
            $email = $_POST['email'] ?? '';
        }

        $email = trim($email);
        header('Content-Type: application/json');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid email address.'
            ]);
            exit;
        }

        try {
            $model = new SubscriberModel();
            $model->unsubscribeByEmail($email);

            echo json_encode([
                'success' => true,
                'message' => "You've been unsubscribed."
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'An error occurred. Please try again later.'
            ]);
        }
        exit;
    }
}
