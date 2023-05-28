<?php

session_start();

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

require_once './functions/main-functions.php';
require_once './functions/db-functions.php';
require_once './validation/main-validation.php';

// Установка соединения с MySQL
$config = require_once './config/db.php';
$mysqli = mysqli_connect(...$config); 

if (!$mysqli) {
    http_response_code(500);
    exit;
}
