<?php

require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('create-task');

    if (mb_strlen($input['name']) === 0) {
        $errors['name'] = 'Введите название задачи!';
    }

    if (mb_strlen($input['deadline']) === 0) {
        $errors['deadline'] = 'Введите срок выполнения задачи!';
    }

    if (!is_project_exist_by_id($mysqli, $user_id, intval($input['project_id']))) {
        $errors['project_id'] = 'Проект не существует!';
    }

    if (empty($errors)) {
        create_task($mysqli, $user_id, $input['project_id'], $input['name'], $input['deadline']);
        header('Location: /index.php');
        exit;
    }
}

$projects = get_user_projects($mysqli, $user_id);

$page_content = includeTemplate('create-task.php', [
    'errors' => $errors,
    'projects' => $projects,
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Create Task',
    'page_content' => $page_content,
    'css_href' => './css/create-project.css'
]);

print($layout_content);
