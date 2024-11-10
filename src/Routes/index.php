<?php

use CreateYourTimeline\Controllers\TimelineController;
use CreateYourTimeline\Controllers\UserController;
use CreateYourTimeline\Router;

$router = new Router();

$router->get('/', TimelineController::class, 'index');
$router->get('/timeline', TimelineController::class, 'timeline', ['id']);
$router->post('/timeline', TimelineController::class, 'timeline', ['id']);
$router->post('/timeline/event/add', TimelineController::class,'addEvent', ['timelineId']);
$router->post('/timeline/event/delete', TimelineController::class,'deleteEvent', ['id', 'timelineId']);
$router->post('/login', UserController::class, 'login');
$router->post('/logout', UserController::class, 'logout');

$router->dispatch();