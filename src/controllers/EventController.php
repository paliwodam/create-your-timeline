<?php
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }

    public function index() {
        $events = $this->eventModel->getAllEvents();
        require __DIR__ . '/../views/events/index.php';
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->eventModel->createEvent($_POST['name'], $_POST['description'], $_POST['start_date'], $_POST['end_date'], $_POST['category_id'], $_POST['image']);
            header('Location: /');
        } else {
            require __DIR__ . '/../views/events/add.php';
        }
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
