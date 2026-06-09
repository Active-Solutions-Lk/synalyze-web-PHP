<?php
require_once dirname(__DIR__) . '/models/ContactModel.php';

class ContactController {
    public function index() {
        $model = new ContactModel();
        $pageData = $model->getContactPageData();
        
        $pageTitle = "Contact - Synalyze";
        
        ob_start();
        require dirname(__DIR__) . '/views/pages/contact.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__) . '/views/layouts/main.php';
    }

    public function submit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $captcha = $_POST['captcha'] ?? '';
        
        if (empty($_SESSION['captcha']) || strtolower(trim($captcha)) !== strtolower($_SESSION['captcha'])) {
            $_SESSION['error'] = "Invalid CAPTCHA. Please try again.";
            header("Location: " . baseUrl('/contact'));
            exit;
        }

        // Retrieve and sanitize fields
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Basic validation
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            $_SESSION['error'] = "Please fill in all required fields.";
            header("Location: " . baseUrl('/contact'));
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter a valid email address.";
            header("Location: " . baseUrl('/contact'));
            exit;
        }

        // Save to DB via Model
        $model = new ContactModel();
        $saved = $model->saveSubmission($name, $email, $company, $subject, $message);

        // Fetch owner notification email from settings
        $settings = get_settings();
        $ownerEmail = $settings['ownerEmail'] ?? 'system@synalyze.net';

        // Send email notification (fails gracefully if credentials aren't set)
        $emailSent = Mailer::sendContactNotification($ownerEmail, $name, $email, $company, $subject, $message);

        if ($saved) {
            $_SESSION['success'] = "Thank you for reaching out! Your message has been received successfully.";
        } else {
            $_SESSION['error'] = "An error occurred while sending your message. Please try again later.";
        }

        header("Location: " . baseUrl('/contact'));
        exit;
    }
}
