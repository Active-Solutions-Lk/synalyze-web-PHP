<?php

class DemoRequestModel {
    private $pdo;

    public function __construct() {
        $this->pdo = \Core\Database::getInstance()->getConnection();
    }

    /**
     * Creates a new demo request.
     *
     * @param int $userId
     * @param array $data Contains full_name, company_name, email, phone
     * @return bool
     */
    public function createRequest($userId, $data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO demo_requests (user_id, full_name, company_name, email, phone, status, requested_at)
            VALUES (?, ?, ?, ?, ?, 'pending', ?)
        ");
        
        return $stmt->execute([
            $userId,
            $data['full_name'],
            $data['company_name'] ?? null,
            $data['email'],
            $data['phone'],
            date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Checks if a user has already requested a demo.
     *
     * @param int $userId
     * @return bool
     */
    public function hasRequested($userId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM demo_requests WHERE user_id = ?");
        $stmt->execute([$userId]);
        return (int)$stmt->fetchColumn() > 0;
    }

    /**
     * Retrieves all demo requests, optionally filtered by a search string.
     *
     * @param string $search
     * @return array
     */
    public function getAllRequests($search = '') {
        if (!empty($search)) {
            $stmt = $this->pdo->prepare("
                SELECT id, user_id, full_name, company_name, email, phone, status, requested_at, credential_sent_at, activation_key
                FROM demo_requests
                WHERE full_name LIKE ? OR email LIKE ? OR company_name LIKE ? OR phone LIKE ?
                ORDER BY requested_at DESC
            ");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
        } else {
            $stmt = $this->pdo->query("
                SELECT id, user_id, full_name, company_name, email, phone, status, requested_at, credential_sent_at, activation_key
                FROM demo_requests
                ORDER BY requested_at DESC
            ");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a single demo request by user ID.
     *
     * @param int $userId
     * @return array|false
     */
    public function getRequestByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM demo_requests WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a single demo request by request ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getRequestById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM demo_requests WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Marks a demo request as completed/credentials sent.
     *
     * @param int $requestId
     * @param string $activationKey
     * @return bool
     */
    public function markCredentialSent($requestId, $activationKey) {
        $stmt = $this->pdo->prepare("
            UPDATE demo_requests
            SET status = 'credentials_sent', credential_sent_at = ?, activation_key = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            date('Y-m-d H:i:s'),
            $activationKey,
            $requestId
        ]);
    }

    /**
     * Deletes a demo request.
     *
     * @param int $id
     * @return bool
     */
    public function deleteRequest($id) {
        $stmt = $this->pdo->prepare("DELETE FROM demo_requests WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
