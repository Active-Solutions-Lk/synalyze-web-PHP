<?php
class FaqModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getFaqCategories() {
        $categories = $this->pdo->query("SELECT * FROM faqcategory")->fetchAll();
        foreach ($categories as &$cat) {
            $stmt = $this->pdo->prepare("SELECT * FROM faqitem WHERE faqCategoryId = ?");
            $stmt->execute([$cat['id']]);
            $cat['items'] = $stmt->fetchAll();
        }
        return $categories;
    }
}
