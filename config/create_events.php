<?php
require_once '../config/db.php'; 

$pdo = Database::getInstance();

$sql = "INSERT INTO event (name, short_description, description, start_date, end_date, image_path, timeline_id) 
    VALUES 
        (\"narodziny Martyny\", \"sylwester, jupiiii!!!\", \"\", \"2001-12-31\", \"2024-12-31\", \"assets/images/im1.jpg\", 1),
        (\"narodziny Igi\", \"Narodziny mojej ulubionej siostry\", \"\", \"2003-10-10\", NULL, \"assets/images/im2.jpg\", 1),
        (\"narodziny Nikodema\", \"Narodziny Niko\", \"\", \"2001-11-01\", \"2001-11-02\", \"assets/images/im3.jpg\", 1),
        (\"Halloween 2024\", \"Dzien przed urodzinami Nikodema\", \"\", \"2024-10-31\", NULL, \"assets/images/im4.jpg\", 1);";
try {
    $pdo->exec($sql);
    echo "Event table created successfully";
} catch (\PDOException $e) {
    echo "Error while creating event table: " . $e->getMessage();
}

// CREATE TABLE event (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(255) NOT NULL,
//     short_description VARCHAR(255) NOT NULL,
//     description TEXT,
//     start_date DATE NOT NULL,
//     end_date DATE,
//     timeline_id INT,
//     image_path VARCHAR(255),
//     FOREIGN KEY (timeline_id) REFERENCES timeline(id)
// );

// INSERT INTO event (name, short_description, description, start_date, end_date, image_path, timeline_id) 
//     VALUES 
//         ("narodziny Martyny", "sylwester, jupiiii!!!", "", "2001-12-31", "2024-12-31", "assets/images/im1.jpg", 1),
//         ("narodziny Igi", "Narodziny mojej ulubionej siostry", "", "2003-10-10", NULL, "assets/images/im2.jpg", 1),
//         ("narodziny Nikodema", "Narodziny Niko", "", "2001-11-01", "2001-11-02", "assets/images/im3.jpg", 1),
//         ("Halloween 2024", "Dzien przed urodzinami Nikodema", "", "2024-10-31", NULL, "assets/images/im4.jpg", 1);"