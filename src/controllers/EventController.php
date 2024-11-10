<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }

    // public function index() {
    //     $events = $this->eventModel->getAllEvents();
    //     require __DIR__ . '/../views/events/index.php';
    // }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->eventModel->createEvent($_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['end_date'], $_POST['category_id'], $_POST['name']);
            header('Location: /');
        }
        require __DIR__ . '/../views/events/index.php';
        // $this->category($_POST['category_id']);
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->eventModel->updateEvent($id, $_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['end_date'], $_POST['category_id'], $_POST['image']);
            header('Location: /');
        } else {
            $event = $this->eventModel->getEventById($id);
            require __DIR__ . '/../views/events/edit.php';
        }
    }

    public function delete($id) {
        $this->eventModel->deleteEvent($id);
        header('Location: /');
    }

    public function print() {
        $events = $this->eventModel->getAllEvents();
        require __DIR__ . '/../views/print.php';
    }

    public function category($categoryId) {
        $categoryId = intval($categoryId);
        $events = $this->eventModel->getEventsByCategoryId($categoryId);
        $categoryName = $this->eventModel->getCategoryNameById($categoryId);
        $previousCategoryId = $this->eventModel->getPreviousCategoryId($categoryId);
        $nextCategoryId = $this->eventModel->getNextCategoryId($categoryId);
        require __DIR__ . '/../views/events/index.php';
    }
}
