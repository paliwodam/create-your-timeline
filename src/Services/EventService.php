<?php

namespace CreateYourTimeline\Services;

use CreateYourTimeline\Database;
use CreateYourTimeline\Models\Event;

class EventService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getEventsByTimelineId( $timelineId ) {
        $stmt = $this->db->prepare("SELECT * FROM event WHERE timeline_id = :timeline_id;");
        $stmt->bindParam(':timeline_id', $timelineId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Event::class);
    }

    public function addEvent($name, $shortDescription, $description, $startDate, $endDate, $timelineId, $imagePath) {
        $stmt = $this->db->prepare("INSERT INTO event (name, short_description, description, start_date, end_date, timeline_id, image_path)
                                    VALUES (:name, :short_description, :description, :start_date, :end_date, :timeline_id, :image_path);");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':short_description', $shortDescription);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->bindParam(':timeline_id', $timelineId);
        $stmt->bindParam(':image_path', $imagePath);
        return $stmt->execute();
    }
    
    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM event WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}