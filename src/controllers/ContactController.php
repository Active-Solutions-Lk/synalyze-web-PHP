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
        session_start();
        $captcha = $_POST['captcha'] ?? '';
        
        if (empty($_SESSION['captcha']) || strtolower(trim($captcha)) !== strtolower($_SESSION['captcha'])) {
            $_SESSION['error'] = "Invalid CAPTCHA. Please try again.";
            header("Location: " . baseUrl('/contact'));
            exit;
        }

        // Handle email sending here. For now, just set success.
        // mail( ... ) or use PHPMailer

        $_SESSION['success'] = "Thank you for reaching out! We will get back to you shortly.";
        header("Location: " . baseUrl('/contact'));
        exit;
    }
}
