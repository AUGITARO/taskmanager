<?php

require_once './init.php';
require_once './authorization/user.php';

/** @var mysqli $mysqli */
/** @var int $user_id */
/** @var string $username */

$project_id = $_GET['project'] ?? null;
$tab = $_GET['tab'] ?? null;
$show_completed = $_GET['show-completed'] ?? null;

$projects = get_user_projects($mysqli, $user_id);
$tasks = get_user_tasks($mysqli, $user_id, $project_id, $tab, boolval($show_completed));

$page_content = includeTemplate('main.php', [
    'projects' => $projects,
    'tasks' => $tasks,
    'show_completed' => $show_completed,
    'username' => $username
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Main',
    'page_content' => $page_content,
    'css_href' => './assets/css/main.css',
]);

print($layout_content);
