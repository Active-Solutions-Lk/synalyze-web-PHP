<?php

require_once dirname(__DIR__) . '/src/core/Database.php';
require_once dirname(__DIR__) . '/src/models/UserModel.php';

use Core\Database;

echo "Running UserModel test...\n";

$email = "test-" . time() . "@synalyze.com";
$testData = [
    'full_name' => 'John Doe',
    'company_name' => 'Synalyze Inc',
    'address' => '123 Tech Lane',
    'phone' => '+1555123456',
    'email' => $email,
    'password' => 'secret123'
];

try {
    $model = new UserModel();
    
    // Check email exists (should be false)
    if ($model->emailExists($email)) {
        die("Error: Email already exists, but this is a unique test email.\n");
    }
    echo "Success: Email does not exist prior to creation.\n";

    // Insert user
    if (!$model->createUser($testData)) {
        die("Error: Failed to create user record.\n");
    }
    echo "Success: User record created successfully.\n";

    // Check email exists (should be true)
    if (!$model->emailExists($email)) {
        die("Error: Email should exist after creation.\n");
    }
    echo "Success: Email exists now.\n";

    // Query database to verify hashed password
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        die("Error: User record not found in database.\n");
    }

    echo "Verifying password hash...\n";
    if (password_verify('secret123', $user['password'])) {
        echo "Success: Password verified successfully!\n";
    } else {
        die("Error: Password verification failed.\n");
    }

    // Clean up test user
    $pdo->prepare("DELETE FROM users WHERE email = ?")->execute([$email]);
    echo "Success: Cleaned up test user.\n";
    
    echo "All tests passed!\n";
} catch (Exception $e) {
    echo "Exception occurred: " . $e->getMessage() . "\n";
    exit(1);
}
