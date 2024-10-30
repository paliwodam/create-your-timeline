<?php
require_once '../config/db.php'; 

$pdo = Database::getInstance();

$sql ="CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    theme VARCHAR(20),
    icon VARCHAR(255)
);";

try {
    $pdo->exec($sql);
    echo "Category table created successfully";
} catch (\PDOException $e) {
    echo "Error while creating category table: " . $e->getMessage();
}
