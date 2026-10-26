<?php
require_once __DIR__ . '/../config.php';

$host = env_value('DB_HOST', '127.0.0.1');
$port = env_value('DB_PORT', '3306');
$dbname = env_value('DB_NAME', 'online_quiz_db');
$username = env_value('DB_USER', 'root');
$password = env_value('DB_PASSWORD', '');

try {
    $conn = new PDO(
        "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('Database connection failed. Check the database settings in the README.');
}
