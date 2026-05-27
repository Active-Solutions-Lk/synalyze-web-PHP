<?php

use Core\Database;

/**
 * Escapes HTML characters
 */
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Generate a Lucide icon element
 * Requires lucide.js to be included in the page
 */
function lucide_icon($name, $class = '', $strokeWidth = 2) {
    // Convert CamelCase to kebab-case (e.g. FolderLock -> folder-lock)
    $kebabName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));
    return sprintf(
        '<i data-lucide="%s" class="%s" stroke-width="%s"></i>',
        e($kebabName),
        e($class),
        e($strokeWidth)
    );
}

/**
 * Fetch global settings from DB
 */
function get_settings() {
    static $settings = null;
    if ($settings === null) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM globalsettings LIMIT 1");
        $settings = $stmt->fetch();
    }
    return $settings;
}

/**
 * Get base URL for assets and links
 */
function baseUrl($path = '') {
    $config = require dirname(__DIR__, 2) . '/config/app.php';
    return rtrim($config['base_url'], '/') . '/' . ltrim($path, '/');
}
