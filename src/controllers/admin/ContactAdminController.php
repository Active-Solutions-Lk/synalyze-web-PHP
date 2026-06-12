<?php
require_once dirname(__DIR__, 2) . '/models/ContactModel.php';

class ContactAdminController {
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
        $model = new ContactModel();
        $pageData = $model->getContactPageData();
        
        $filter = $_GET['filter'] ?? 'all';
        $submissions = $model->getAllSubmissions($filter);
        $unreadCount = $model->getUnreadCount();
        
        $pageTitle = "Contact Page & Inbox - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/contact.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function update() {
        $pdo = \Core\Database::getInstance()->getConnection();
        
        $stmt = $pdo->prepare("UPDATE ContactPage SET 
            heroTitle=?, heroDescription=?, phoneTitle=?, phoneSalesLabel=?, phoneSalesValue=?, 
            phoneSupportLabel=?, phoneSupportValue=?, emailTitle=?, emailSalesLabel=?, emailSalesValue=?, 
            emailSupportLabel=?, emailSupportValue=?, emailGeneralLabel=?, emailGeneralValue=?, 
            addressTitle=?, addressLine1=?, addressLine2=?, addressLine3=?, addressLine4=?, addressLine5=?, 
            formTitle=?, formDescription=?, locationTitle=?, mapEmbedUrl=? WHERE id=1");
            
        $stmt->execute([
            $_POST['heroTitle'], $_POST['heroDescription'], $_POST['phoneTitle'], $_POST['phoneSalesLabel'], 
            $_POST['phoneSalesValue'], $_POST['phoneSupportLabel'], $_POST['phoneSupportValue'], $_POST['emailTitle'], 
            $_POST['emailSalesLabel'], $_POST['emailSalesValue'], $_POST['emailSupportLabel'], $_POST['emailSupportValue'], 
            $_POST['emailGeneralLabel'], $_POST['emailGeneralValue'], $_POST['addressTitle'], $_POST['addressLine1'], 
            $_POST['addressLine2'], $_POST['addressLine3'], $_POST['addressLine4'], $_POST['addressLine5'], 
            $_POST['formTitle'], $_POST['formDescription'], $_POST['locationTitle'], $_POST['mapEmbedUrl']
        ]);
        
        $_SESSION['success'] = "Contact page updated.";
        header("Location: " . baseUrl('/admin/contact'));
        exit;
    }

    public function markRead() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new ContactModel();
                $model->markRead((int)$id);
                $unreadCount = $model->getUnreadCount();
                
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'unreadCount' => $unreadCount
                ]);
                exit;
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid request']);
        exit;
    }

    public function markActioned() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $note = trim($_POST['action_note'] ?? '');
            
            if (!$id) {
                $this->redirectError("Invalid message ID.");
            }
            if (empty($note)) {
                $this->redirectError("Please enter an action note.");
            }
            
            $model = new ContactModel();
            $model->markActioned((int)$id, $note);
            $this->redirectSuccess("Message marked as actioned.");
        }
        $this->redirectError("Invalid request.");
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                $model = new ContactModel();
                $model->deleteSubmission((int)$id);
                $this->redirectSuccess("Message deleted successfully.");
            }
        }
        $this->redirectError("Invalid request.");
    }

    private function redirectSuccess($msg) {
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/contact?tab=inbox'));
        exit;
    }

    private function redirectError($msg) {
        $_SESSION['error'] = $msg;
        header("Location: " . baseUrl('/admin/contact?tab=inbox'));
        exit;
    }
}
