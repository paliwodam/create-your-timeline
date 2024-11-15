<?php

namespace CreateYourTimeline\Controllers;

use CreateYourTimeline\Controller;
use CreateYourTimeline\Services\TimelineService;
use CreateYourTimeline\Services\EventService;

class TimelineController extends Controller
{
    private $timelineService;
    private $eventService;

    public function __construct() {
        $this->timelineService = new TimelineService();
        $this->eventService = new EventService();
    }

    public function index()
    {
        $events = $this->eventService->getAllEvents();
        $anyTimeline = $this->timelineService->getAnyTimeline();

        $this->render('timeline', ['timeline'=> "All events in the whole world", 'timelineId' => null, 'events'=> $events, 
            'previousTimelineId'=> null, 'nextTimelineId'=> null, 'anyTimeline' => $anyTimeline -> id]);
    }

    public function timeline(int $id)
    {
        $timeline = $this->timelineService->getTimeline($id);
        $events = $this->eventService->getEventsByTimelineId($id);
        $previousTimelineId = $this->timelineService->getPreviousTimelineId($id);
        $nextTimelineId = $this->timelineService->getNextTimelineId($id);

        $this->render('timeline', ['timeline'=> $timeline->name, 'timelineId' => $timeline->id, 'events'=> $events, 
            'previousTimelineId'=> $previousTimelineId, 'nextTimelineId'=> $nextTimelineId, 'anyTimeline' => null]);
    }

    public function addTimeline() {
        $name = $_POST['name'];
        $themeColor = $_POST['theme_color'];
        $icon = $_POST['icon'];

        $timelineId = $this->timelineService->addTimeline( $name, $themeColor, $icon);
        header('Location: /timeline?id=' . $timelineId);
    }
    
    public function deleteTimeline(int $timelineId) {
        $this->timelineService->deleteTimeline($timelineId);
        header('Location: /');
    }

    private function uploadFile() {
        $target_dir = "assets/images";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return $target_file;
    }

    public function addEvent(int $timelineId) 
    {
        $name = $_POST['name'];
        $shortDescription = $_POST['short_description'];
        $description = $_POST['description'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];    
        $result = $this->eventService->addEvent(
            name: $name, 
            shortDescription: $shortDescription, 
            description: $description, 
            startDate: $startDate, 
            endDate: $endDate, 
            timelineId: $timelineId, 
            imagePath: $this->uploadFile()
        );
        header('Location: /timeline?id=' . $timelineId);
    }

    public function deleteEvent(int $id, int $timelineId) {
        $this->eventService->deleteEvent($id);
        header('Location: /timeline?id=' . $timelineId);
    }
}