<?php

namespace CreateYourTimeline\Services;

use CreateYourTimeline\Database;
use CreateYourTimeline\Models\Event;
use CreateYourTimeline\Models\Timeline;

class TimelineService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAnyTimeline() {
        $stmt = $this->db->query("SELECT * FROM timeline");
        $timelines = $stmt->fetchAll(\PDO::FETCH_CLASS, Timeline::class);
        return $timelines[array_rand($timelines)];
    }

    public function getTimeline( $id ) {
        $stmt = $this->db->prepare("SELECT * FROM timeline WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $timeline = $stmt->fetchObject(Timeline::class);
        if (!$timeline) {
            throw new \Exception("No timeline found for id: $id");
        }
        return $timeline;
    }

    public function getEventsByTimelineId( $timelineId ) {
        $stmt = $this->db->prepare("SELECT * FROM event WHERE timeline_id = :timeline_id");
        $stmt->bindParam(':timeline_id', $timelineId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Event::class);
    }

    public function addEvent($name, $shortDescription, $description, $startDate, $endDate, $timelineId, $imagePath) {
        $stmt = $this->db->prepare("INSERT INTO event (name, short_description, description, start_date, end_date, timeline_id, image_path)
                                    VALUES (:name, :short_description, :description, :start_date, :end_date, :timeline_id, :image_path)");
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

    public function getPreviousTimelineId( $timelineId ) {
        $stmt = $this->db->query("SELECT id FROM timeline");
        $timelines = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $currIdx = array_search( $timelineId, $timelines );
        if ( $currIdx === false ) {
            return $timelineId;
        }
        if($currIdx !== 0) {
            return $timelines[$currIdx-1];
        } else {
            return end($timelines);
        }
    }

    public function getNextTimelineId( $timelineId ) {
        $stmt = $this->db->query("SELECT id FROM timeline");
        $timelines = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $currIdx = array_search( $timelineId, $timelines );
        if ( $currIdx === false ) {
            return $timelineId;
        }
        if( $timelines[$currIdx] === end($timelines)) {
            return $timelines[0];
        } else {
            return $timelines[$currIdx+1];
        }
    }

}