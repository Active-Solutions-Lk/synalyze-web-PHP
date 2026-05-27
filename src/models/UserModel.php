<?php

class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = \Core\Database::getInstance()->getConnection();
    }

    /**
     * Checks if a user already exists with the given email.
     *
     * @param string $email
     * @return bool
     */
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return (int)$stmt->fetchColumn() > 0;
    }

    /**
     * Inserts a new user into the database.
     *
     * @param array $data
     * @return bool
     */
    public function createUser($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (full_name, company_name, address, phone, email, password)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        // Hash the password securely before saving
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            $data['full_name'],
            $data['company_name'] ?? null,
            $data['address'],
            $data['phone'],
            $data['email'],
            $hashedPassword
        ]);
    }

    /**
     * Retrieves all users, optionally filtered by a search string.
     *
     * @param string $search
     * @return array
     */
    public function getAllUsers($search = '') {
        if (!empty($search)) {
            $stmt = $this->pdo->prepare("
                SELECT id, full_name, company_name, address, phone, email, status, created_at
                FROM users
                WHERE full_name LIKE ? OR email LIKE ? OR company_name LIKE ?
                ORDER BY created_at DESC
            ");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        } else {
            $stmt = $this->pdo->query("
                SELECT id, full_name, company_name, address, phone, email, status, created_at
                FROM users
                ORDER BY created_at DESC
            ");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates the online/offline status of a user.
     *
     * @param int    $id     The user's ID.
     * @param string $status Either 'active' or 'inactive'.
     * @return bool
     */
    public function updateStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    /**
     * Deletes a user from the database.
     *
     * @param int $id
     * @return bool
     */
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Retrieves a user by their email.
     *
     * @param string $email
     * @return array|false
     */
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}

