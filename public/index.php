<?php
require_once __DIR__ . '/../src/controllers/EventController.php';

$controller = new EventController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'print':
        $controller->print();
        break;
    default:
        $controller->index();
        break;
}
