<?php

class SubscriberModel {
    private $pdo;

    public function __construct() {
        $this->pdo = \Core\Database::getInstance()->getConnection();
        $this->createTable();
    }

    /**
     * Auto-creates the subscribers table if it does not exist.
     */
    private function createTable() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS subscribers (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                email TEXT UNIQUE NOT NULL,
                subscribed_at TEXT NOT NULL,
                status TEXT DEFAULT 'active'
            )
        ");
    }

    /**
     * Subscribes a new email address.
     *
     * @param string $email
     * @return string 'ok' or 'duplicate'
     */
    public function subscribe($email) {
        // Check if already subscribed
        $stmt = $this->pdo->prepare("SELECT id FROM subscribers WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return 'duplicate';
        }

        // Insert new subscriber
        $stmt = $this->pdo->prepare("
            INSERT INTO subscribers (email, subscribed_at, status)
            VALUES (?, ?, 'active')
        ");
        $stmt->execute([$email, date('Y-m-d H:i:s')]);
        return 'ok';
    }

    /**
     * Retrieves all subscribers, optionally filtered by a search string.
     *
     * @param string $search
     * @return array
     */
    public function getAllSubscribers($search = '') {
        if (!empty($search)) {
            $stmt = $this->pdo->prepare("
                SELECT id, email, subscribed_at, status
                FROM subscribers
                WHERE email LIKE ?
                ORDER BY subscribed_at DESC
            ");
            $searchTerm = "%$search%";
            $stmt->execute([$searchTerm]);
        } else {
            $stmt = $this->pdo->query("
                SELECT id, email, subscribed_at, status
                FROM subscribers
                ORDER BY subscribed_at DESC
            ");
        }
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a subscriber by ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM subscribers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Deletes a subscriber.
     *
     * @param int $id
     * @return bool
     */
    public function deleteSubscriber($id) {
        $stmt = $this->pdo->prepare("DELETE FROM subscribers WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Unsubscribes a user by email.
     *
     * @param string $email
     * @return bool
     */
    public function unsubscribeByEmail($email) {
        $stmt = $this->pdo->prepare("DELETE FROM subscribers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->rowCount() > 0;
    }

    /**
     * Checks if an email is subscribed.
     *
     * @param string $email
     * @return bool
     */
    public function isSubscribed($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM subscribers WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        return (bool)$stmt->fetch();
    }
}
