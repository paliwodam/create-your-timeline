<?php
require_once '../config/db.php'; 

$pdo = Database::getInstance();

$sql = "INSERT INTO event (name, description, start_date, end_date, image_path, category_id) 
    VALUES 
        (\"narodziny Martyny\", \"sylwester, jupiiii!!!\", 2001-12-31, NULL, \"assets/images/im1.jpg\", 1),
        (\"narodziny Igi\", \"Narodziny mojej ulubionej siostry\", 2003-10-10, NULL, \"assets/images/im2.jpg\", 1),
        (\"narodziny Nikodema\", \"Narodziny Niko\", 2001-11-01, NULL, \"assets/images/im3.jpg\", 1),
        (\"Halloween 2024\", \"Dzien przed urodzinami Nikodema\", 2024-10-31, NULL, \"assets/images/im4.jpg\", 1);";
try {
    $pdo->exec($sql);
    echo "Event table created successfully";
} catch (\PDOException $e) {
    echo "Error while creating event table: " . $e->getMessage();
}
