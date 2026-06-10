<?php

require_once dirname(__DIR__, 2) . '/models/SubscriberModel.php';

class SubscribersAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin'])) {
            header("Location: " . baseUrl('/admin/login'));
            exit;
        }
    }

    /**
     * Display a list of all subscribers.
     */
    public function index() {
        $model = new SubscriberModel();
        $search = $_GET['search'] ?? '';
        $subscribers = $model->getAllSubscribers($search);

        $pageTitle = "Subscriber Manager - Admin";

        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/subscribers.php';
        $content = ob_get_clean();

        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    /**
     * Delete a subscriber by ID.
     */
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new SubscriberModel();
                $model->deleteSubscriber($id);
                $this->redirectMessage("Subscriber removed successfully.");
            }
        }
        $this->redirectMessage("Invalid request.", true);
    }

    /**
     * Send update email to one or all subscribers.
     */
    public function sendEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $to = trim($_POST['to'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if (empty($subject) || empty($message) || empty($to)) {
                $this->redirectMessage("All fields (recipient, subject, message) are required to send an email.", true);
            }

            if ($to === 'all') {
                $model = new SubscriberModel();
                $subscribers = $model->getAllSubscribers();
                
                if (empty($subscribers)) {
                    $this->redirectMessage("There are no active subscribers to send emails to.", true);
                }

                $successCount = 0;
                $failCount = 0;

                foreach ($subscribers as $sub) {
                    if (Mailer::sendUpdateEmail($sub['email'], $subject, $message)) {
                        $successCount++;
                    } else {
                        $failCount++;
                    }
                }

                if ($failCount > 0) {
                    $this->redirectMessage("Bulk email campaign finished. Sent to {$successCount} subscribers. Failed to send to {$failCount} subscribers.");
                } else {
                    $this->redirectMessage("Bulk email sent successfully to all {$successCount} active subscribers.");
                }
            } else {
                // Send to single email
                if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                    $this->redirectMessage("Invalid recipient email address.", true);
                }

                $sent = Mailer::sendUpdateEmail($to, $subject, $message);
                if ($sent) {
                    $this->redirectMessage("Update email sent successfully to {$to}.");
                } else {
                    $this->redirectMessage("Failed to send update email to {$to}. Please check SMTP configurations.", true);
                }
            }
        }
        $this->redirectMessage("Invalid request method.", true);
    }

    /**
     * Helper to set flash messages and redirect to subscriber list.
     */
    private function redirectMessage($msg, $isError = false) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($isError) {
            $_SESSION['error'] = $msg;
        } else {
            $_SESSION['success'] = $msg;
        }
        header("Location: " . baseUrl('/admin/subscribers'));
        exit;
    }
}
