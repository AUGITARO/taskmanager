<?php 

require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);
$task_id = intval($_GET['id'] ?? 0);

change_status($mysqli, $user_id, $task_id);


$ref = $_SERVER['HTTP_REFERER'] ?? '/index.php';
header("Location: $ref");
exit;
