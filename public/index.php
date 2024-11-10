<?php

require '../vendor/autoload.php';
use vielhuber\simpleauth\simpleauth;

session_start();
if (!isset($_SESSION['userToken'])) {
    $_SESSION['userToken'] = ""; 
}
$auth = new simpleauth(__DIR__ . '/.env');
$router = require '../src/Routes/index.php';