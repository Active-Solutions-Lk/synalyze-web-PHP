<?php
require_once dirname(__DIR__, 2) . '/models/ContactModel.php';

class ContactAdminController {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        $model = new ContactModel();
        $pageData = $model->getContactPageData();
        $submissions = $model->getAllSubmissions();
        
        $pageTitle = "Contact Page & Inbox - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/contact.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function update() {
        session_start();
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
}
