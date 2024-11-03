<?php
require_once '../config/db.php'; 

$pdo = Database::getInstance();

$sql = "CREATE TABLE event (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE,
    category_id INT,
    image_path VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES category(id)
);";

try {
    $pdo->exec($sql);
    echo "Event table created successfully";
} catch (\PDOException $e) {
    echo "Error while creating event table: " . $e->getMessage();
}
