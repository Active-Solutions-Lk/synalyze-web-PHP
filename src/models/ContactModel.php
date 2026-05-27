<?php
class ContactModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getContactPageData() {
        return $this->pdo->query("SELECT * FROM ContactPage LIMIT 1")->fetch();
    }
}
