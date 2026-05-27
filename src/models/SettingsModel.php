<?php
class SettingsModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getGlobalSettings() {
        return $this->pdo->query("SELECT * FROM globalsettings LIMIT 1")->fetch();
    }
}
