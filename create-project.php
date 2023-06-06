<?php

require_once './init.php';
require_once './authorization/user.php';

/** @var mysqli $mysqli */
/** @var int $user_id */

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('create-project');

    if (mb_strlen($input['project']) === 0) {
        $errors['project'] = 'Введите название проекта!';
    } elseif (is_project_exist_by_name($mysqli, $user_id, $input['project'])) {
        $errors['project'] = 'Проект с таким названием уже существует!';
    }

    if (empty($errors)) {
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
    'css_href' => './assets/css/create-project.css'
]);

print($layout_content);
