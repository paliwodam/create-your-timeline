<?php

namespace CreateYourTimeline\Services;

use CreateYourTimeline\Database;
use CreateYourTimeline\Models\Timeline;

class TimelineService {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAnyTimeline() {
        $stmt = $this->db->query("SELECT * FROM timeline;");
        $timelines = $stmt->fetchAll(\PDO::FETCH_CLASS, Timeline::class);
        if(empty($timelines)){
            return null;
        }
        return $timelines[array_rand($timelines)];
    }

    public function getTimeline( $id ) {
        $stmt = $this->db->prepare("SELECT * FROM timeline WHERE id = :id;");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $timeline = $stmt->fetchObject(Timeline::class);
        if (!$timeline) {
            throw new \Exception("No timeline found for id: $id");
        }
        return $timeline;
    }
    
    public function addTimeline( $name, $themeColor, $icon) {
        $stmt = $this->db->prepare("INSERT INTO timeline (name, theme_color, icon) VALUES (:name, :theme_color, :icon);");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':theme_color', $themeColor);
        $stmt->bindParam(':icon', $icon);
        $stmt->execute();
        return $this->db->lastInsertId();
    }
    
    public function deleteTimeline($id) {
        $stmt = $this->db->prepare("DELETE FROM timeline WHERE id = :id");
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