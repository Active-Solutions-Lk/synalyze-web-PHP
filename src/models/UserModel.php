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
            INSERT INTO users (full_name, company_name, address, phone, email, password, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        // Hash the password securely before saving
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            $data['full_name'],
            $data['company_name'] ?? null,
            $data['address'],
            $data['phone'],
            $data['email'],
            $hashedPassword,
            date('Y-m-d H:i:s')
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
                SELECT id, full_name, company_name, address, phone, email, created_at
                FROM users
                WHERE full_name LIKE ? OR email LIKE ? OR company_name LIKE ?
                ORDER BY created_at DESC
            ");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        } else {
            $stmt = $this->pdo->query("
                SELECT id, full_name, company_name, address, phone, email, created_at
                FROM users
                ORDER BY created_at DESC
            ");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    /**
     * Retrieves a user by their ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a user by their Google ID.
     *
     * @param string $googleId
     * @return array|false
     */
    public function getUserByGoogleId($googleId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE google_id = ?");
        $stmt->execute([$googleId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Links a Google ID to an existing user account.
     *
     * @param int $userId
     * @param string $googleId
     * @return bool
     */
    public function linkGoogleAccount($userId, $googleId) {
        $stmt = $this->pdo->prepare("UPDATE users SET google_id = ?, auth_provider = 'google' WHERE id = ?");
        return $stmt->execute([$googleId, $userId]);
    }

    /**
     * Inserts a new Google user into the database.
     *
     * @param array $data
     * @return bool
     */
    public function createGoogleUser($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (full_name, company_name, address, phone, email, password, google_id, auth_provider, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'google', ?)
        ");
        
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            $data['full_name'],
            $data['company_name'] ?? null,
            $data['address'],
            $data['phone'],
            $data['email'],
            $hashedPassword,
            $data['google_id'],
            date('Y-m-d H:i:s')
        ]);
    }
}

