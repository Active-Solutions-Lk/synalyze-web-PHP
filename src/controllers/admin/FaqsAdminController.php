<?php
require_once dirname(__DIR__, 2) . '/models/FaqModel.php';

class FaqsAdminController {
    public function index() {
        $model = new FaqModel();
        $categories = $model->getFaqCategories();
        
        $pageTitle = "FAQs Manager - Admin";
        
        ob_start();
        require dirname(__DIR__, 2) . '/views/admin/faqs.php';
        $content = ob_get_clean();
        
        require dirname(__DIR__, 2) . '/views/layouts/admin.php';
    }

    public function createCategory() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO faqcategory (name) VALUES (?)");
        $stmt->execute([$_POST['name']]);
        $this->redirectSuccess("Category added.");
    }
    
    public function deleteCategory() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM faqcategory WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("Category deleted.");
    }
    
    public function createItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO faqitem (question, answer, faqCategoryId) VALUES (?, ?, ?)");
        $stmt->execute([$_POST['question'], $_POST['answer'], $_POST['categoryId']]);
        $this->redirectSuccess("FAQ added.");
    }
    
    public function deleteItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM faqitem WHERE id = ?");
        $stmt->execute([$_POST['id']]);
        $this->redirectSuccess("FAQ deleted.");
    }

    public function updateCategory() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE faqcategory SET name=? WHERE id=?");
        $stmt->execute([$_POST['name'], $_POST['id']]);
        $this->redirectSuccess("Category updated.");
    }

    public function updateItem() {
        $pdo = \Core\Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE faqitem SET question=?, answer=?, faqCategoryId=? WHERE id=?");
        $stmt->execute([$_POST['question'], $_POST['answer'], $_POST['categoryId'], $_POST['id']]);
        $this->redirectSuccess("FAQ updated.");
    }

    private function redirectSuccess($msg) {
        session_start();
        $_SESSION['success'] = $msg;
        header("Location: " . baseUrl('/admin/faqs'));
        exit;
    }
}
