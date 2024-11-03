<?php
require_once __DIR__ . '/../../config/db.php';

class Event {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAllEvents() {
        $stmt = $this->db->query("SELECT * FROM event ORDER BY start_date");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createEvent($name, $description, $startDate, $endDate, $categoryId, $image) {
        $stmt = $this->db->prepare("INSERT INTO event (name, description, start_date, end_date, category_id, image)
                                    VALUES (:name, :description, :start_date, :end_date, :category_id, :image)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':image', $image);
        return $stmt->execute();
    }
}
