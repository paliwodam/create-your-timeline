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
        $timeline = $this->timelineService->getAnyTimeline();
        if(!$timeline) {
             $this->render('index', []);
        } else {
            header('Location: /timeline?id=' . $timeline->id);
        }
    }

    public function timeline(int $id)
    {
        $timeline = $this->timelineService->getTimeline($id);
        $events = $this->eventService->getEventsByTimelineId($id);
        $previousTimelineId = $this->timelineService->getPreviousTimelineId($id);
        $nextTimelineId = $this->timelineService->getNextTimelineId($id);

        $this->render('timeline', ['timeline'=> $timeline->name, 'timelineId' => $timeline->id, 'events'=> $events, 
            'previousTimelineId'=> $previousTimelineId, 'nextTimelineId'=> $nextTimelineId]);
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

    public function addEvent(int $timelineId) 
    {
        $name = $_POST['name'];
        $shortDescription = $_POST['short_description'];
        $description = $_POST['description'];
        $startDate = $_POST['start_date'];
        $endDate = $_POST['end_date'];
        // $imagePath = $_POST['name'];
        $imagePath = "assets/images/im1.jpg";
        $result = $this->eventService->addEvent(
            name: $name, 
            shortDescription: $shortDescription, 
            description: $description, 
            startDate: $startDate, 
            endDate: $endDate, 
            timelineId: $timelineId, 
            imagePath: $imagePath
        );
        header('Location: /timeline?id=' . $timelineId);
    }

    public function deleteEvent(int $id, int $timelineId) {
        $this->eventService->deleteEvent($id);
        header('Location: /timeline?id=' . $timelineId);
    }
}