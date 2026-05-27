<?php

/**
 * Migration: Add 'status' column to users table.
 * 
 * Safe to run multiple times — if the column already exists, it will be skipped gracefully.
 * 
 * Run via CLI: php database/add_status_column.php
 */

require_once dirname(__DIR__) . '/src/core/Database.php';

use Core\Database;

echo "Running migration: add 'status' column to users table...\n";

try {
    $pdo = Database::getInstance()->getConnection();

    // Check if the column already exists (SQLite-compatible check)
    $stmt = $pdo->query("PRAGMA table_info(users)");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $columnNames = array_column($columns, 'name');

    if (in_array('status', $columnNames)) {
        echo "Column 'status' already exists. Skipping migration.\n";
        exit(0);
    }

    // Add the status column with a default of 'inactive'
    $pdo->exec("ALTER TABLE users ADD COLUMN status TEXT NOT NULL DEFAULT 'inactive'");

    echo "Success: 'status' column added to the 'users' table with default value 'inactive'.\n";
} catch (Exception $e) {
    echo "Error running migration: " . $e->getMessage() . "\n";
    exit(1);
}
