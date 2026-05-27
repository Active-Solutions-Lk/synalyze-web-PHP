<?php
class AboutModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getAboutPageData() {
        return $this->pdo->query("SELECT * FROM AboutPage LIMIT 1")->fetch();
    }
    public function getWhatWeDoCards() {
        return $this->pdo->query("SELECT * FROM AboutWhatWeDoCard")->fetchAll();
    }
    public function getWhyChooseUsItems() {
        return $this->pdo->query("SELECT * FROM AboutWhyChooseUsItem")->fetchAll();
    }
}
