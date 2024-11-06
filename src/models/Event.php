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

    // public function getEventsByCategory($categoryName) {
    //     $stmt = $this->db->prepare("SELECT * FROM event WHERE category_id = (SELECT id FROM category WHERE name = :categoryName)");
    //     $stmt->bindParam(':categoryName', $categoryName);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getEventsByCategoryId($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM event WHERE category_id = :category_id");
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getCategoryNameById($categoryId) {
        $stmt = $this->db->prepare("SELECT name FROM category WHERE id = :category_id");
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        $category = $stmt->fetch();

        return $category ? $category['name'] : null;
    }   
    public function getPreviousCategoryId($currentCategoryId) {
        // Znajdź poprzednie ID kategorii
        // Zwróć `null` jeśli nie ma wcześniejszej kategorii
        return 1;
    }

    public function getNextCategoryId($currentCategoryId) {
        // Znajdź następne ID kategorii
        // Zwróć `null` jeśli nie ma następnej kategorii
        return 2;
    }
}
