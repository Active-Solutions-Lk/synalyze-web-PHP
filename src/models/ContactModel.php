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

    public function getAllSubmissions(?string $filter = 'all'): array {
        if ($filter === 'unread') {
            $stmt = $this->pdo->prepare("SELECT * FROM contact_submissions WHERE status = 'unread' ORDER BY submitted_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } elseif ($filter === 'read') {
            $stmt = $this->pdo->prepare("SELECT * FROM contact_submissions WHERE status = 'read' ORDER BY submitted_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } elseif ($filter === 'actioned') {
            $stmt = $this->pdo->prepare("SELECT * FROM contact_submissions WHERE status = 'actioned' ORDER BY submitted_at DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        return $this->pdo->query("SELECT * FROM contact_submissions ORDER BY submitted_at DESC")->fetchAll();
    }

    public function markRead(int $id): bool {
        $stmt = $this->pdo->prepare("UPDATE contact_submissions SET status = 'read' WHERE id = ? AND status = 'unread'");
        return $stmt->execute([$id]);
    }

    public function markActioned(int $id, string $note): bool {
        $stmt = $this->pdo->prepare("UPDATE contact_submissions SET status = 'actioned', action_note = ?, actioned_at = ? WHERE id = ?");
        return $stmt->execute([$note, date('Y-m-d H:i:s'), $id]);
    }

    public function deleteSubmission(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM contact_submissions WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getUnreadCount(): int {
        return (int)$this->pdo->query("SELECT COUNT(*) FROM contact_submissions WHERE status = 'unread'")->fetchColumn();
    }
}
