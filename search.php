<?php 

require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$query = $_GET['q'] ?? null;

if (!isset($query)) {
    header('Location: /index.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);
$projects = get_user_projects($mysqli, $user_id);
$tasks = search_user_tasks($mysqli, $query, $user_id);

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