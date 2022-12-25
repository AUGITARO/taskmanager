<?php

require_once('init.php');

if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('create-project');

    if (mb_strlen($input['project']) === 0) {
        $errors['project'] = 'Введите название проекта!';
    } elseif (is_project_exist($mysqli, $user_id, $input['project'])) {
        $errors['project'] = 'Проект с таким названием уже существует!';
    } elseif (empty($errors)) {
        if (create_project($mysqli, $user_id, $input['project'])) {
            header('Location: /index.php');
        }
    }

}

$page_content = includeTemplate('create-project.php', [
    'errors' => $errors
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Create Project',
    'page_content' => $page_content,
    'css_href' => './css/create-project.css'
]);

print($layout_content);