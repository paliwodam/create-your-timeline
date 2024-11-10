<?php

namespace CreateYourTimeline\Controllers;

use CreateYourTimeline\Controller;
use CreateYourTimeline\Services\TimelineService;

class TimelineController extends Controller
{
    private $timelineService;

    public function __construct() {
        $this->timelineService = new TimelineService();
    }

    public function index()
    {
        $timeline = $this->timelineService->getAnyTimeline();
        header('Location: /timeline?id=' . $timeline->id);
        // $this->render('index', ['journals'=>[]]);
    }

    public function timeline(int $id)
    {
        $timeline = $this->timelineService->getTimeline($id);
        $events = $this->timelineService->getEventsByTimelineId($id);
        $previousTimelineId = $this->timelineService->getPreviousTimelineId($id);
        $nextTimelineId = $this->timelineService->getNextTimelineId($id);

        $this->render('timeline', ['timeline'=> $timeline->name, 'timelineId' => $timeline->id, 'events'=> $events, 
            'previousTimelineId'=> $previousTimelineId, 'nextTimelineId'=> $nextTimelineId]);
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
        $result = $this->timelineService->addEvent(
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
        $this->timelineService->deleteEvent($id);
        header('Location: /timeline?id=' . $timelineId);
    }
}