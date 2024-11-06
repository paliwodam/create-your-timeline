<?php
require_once __DIR__ . '/../src/controllers/EventController.php';

$controller = new EventController();

$action = $_GET['action'] ?? 'index';
$category = $_GET['id'] ?? null;

switch ($action) {
    case 'add':
        $controller->add();
        break;
    case 'print':
        $controller->print();
        break;
    case 'category':
        $controller->category($category);
        break;
    default:
        $controller->index();
        break;
}
