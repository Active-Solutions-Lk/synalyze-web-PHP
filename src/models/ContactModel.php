<?php
class ContactModel {
    private $pdo;
    public function __construct() { $this->pdo = \Core\Database::getInstance()->getConnection(); }
    
    public function getContactPageData() {
        return $this->pdo->query("SELECT * FROM ContactPage LIMIT 1")->fetch();
    }

    public function saveSubmission(string $name, string $email, ?string $company, string $subject, string $message): bool {
        $stmt = $this->pdo->prepare("INSERT INTO contact_submissions (name, email, company, subject, message, submitted_at) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $company, $subject, $message, date('Y-m-d H:i:s')]);
    }

    public function getAllSubmissions(): array {
        return $this->pdo->query("SELECT * FROM contact_submissions ORDER BY submitted_at DESC")->fetchAll();
    }
}
