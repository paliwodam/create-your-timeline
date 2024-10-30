<?php
require_once '../config/db.php'; 

$pdo = Database::getInstance();

$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE
);";

try {
    $pdo->exec($sql);
    echo "User table created successfully";
} catch (\PDOException $e) {
    echo "Error while creating user table: " . $e->getMessage();
}
