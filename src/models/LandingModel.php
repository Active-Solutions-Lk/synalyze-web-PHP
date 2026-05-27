<?php
class LandingModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getHeroSection() {
        return $this->pdo->query("SELECT * FROM herosection LIMIT 1")->fetch();
    }
    public function getFeatures() {
        return $this->pdo->query("SELECT * FROM feature")->fetchAll();
    }
    public function getHowItWorksSteps() {
        return $this->pdo->query("SELECT * FROM howitworksstep ORDER BY stepNumber")->fetchAll();
    }
    public function getDeploymentOptions() {
        return $this->pdo->query("SELECT * FROM deploymentoption")->fetchAll();
    }
}
