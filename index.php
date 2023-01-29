<?php

require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);
$project_id = $_GET['project'] ?? null;
$tab = $_GET['tab'] ?? null;

$projects = get_user_projects($mysqli, $user_id); //db-functions.php
$tasks = get_user_tasks($mysqli, $user_id, $project_id, $tab);

$page_content = includeTemplate('main.php', [
    'projects' => $projects,
    'tasks' => $tasks
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Main',
    'page_content' => $page_content,
    'css_href' => './css/main.css'
]);

print($layout_content);
