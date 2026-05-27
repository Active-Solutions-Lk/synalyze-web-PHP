<?php

require_once dirname(__DIR__) . '/src/core/Database.php';
require_once dirname(__DIR__) . '/src/models/UserModel.php';

echo "Seeding user records...\n";

$usersData = [
    [
        'full_name' => 'Sarah Jenkins',
        'company_name' => 'Quantum Analytics',
        'address' => '456 Matrix Ave, Tech City, TC 90210',
        'phone' => '+1 (789) 012-3456',
        'email' => 'sarah@quantum.io',
        'password' => 'quantum123'
    ],
    [
        'full_name' => 'Michael Chen',
        'company_name' => 'Apex Devs',
        'address' => '789 Apex Tower, Boston, MA 02108',
        'phone' => '+1 (321) 654-0987',
        'email' => 'mchen@apex.dev',
        'password' => 'apexpass123'
    ],
    [
        'full_name' => 'David Miller',
        'company_name' => '',
        'address' => '12 Pine St, Austin, TX 78701',
        'phone' => '+1 (456) 789-0123',
        'email' => 'david.m@outlook.com',
        'password' => 'davidpass99'
    ]
];

$model = new UserModel();

foreach ($usersData as $data) {
    if (!$model->emailExists($data['email'])) {
        if ($model->createUser($data)) {
            echo "Seeded user: {$data['full_name']} ({$data['email']})\n";
        } else {
            echo "Failed to seed user: {$data['full_name']}\n";
        }
    } else {
        echo "User already exists: {$data['full_name']} ({$data['email']})\n";
    }
}

echo "Seeding complete!\n";
