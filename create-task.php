<?php

require_once './init.php';
require_once './authorization/user.php';

/** @var mysqli $mysqli */
/** @var int $user_id */

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('create-task');
    $errors['name'] = required($input['name']);

    if (mb_strlen($input['deadline']) === 0) {
        $errors['deadline'] = 'Введите срок выполнения задачи!';
    } elseif (!is_date_valid($input['deadline'])) {
        $errors['deadline'] = 'Некорректный формат даты!';
    }

    if (!is_project_exist_by_id($mysqli, $user_id, intval($input['project_id']))) {
        $errors['project_id'] = 'Проект не существует!';
    }

    if (empty(array_filter($errors))) {
        $task_id = create_task($mysqli, $user_id, $input['project_id'], $input['name'], $input['deadline']);
        
        if (isset($_FILES['task-file']['tmp_name']) && mb_strlen($_FILES['task-file']['tmp_name']) > 0) {
            $task_file_name = uniqid() . "_" . $_FILES['task-file']['name'];

            $file_path = __DIR__ . '/uploads/' . $task_file_name;
            move_uploaded_file($_FILES['task-file']['tmp_name'], $file_path);

            if (!create_file($mysqli, $task_file_name, $task_id)) {
                $errors['task_file'] = 'Ошибка при загрузке файла!';
            }
        }

        if (!isset($errors['task_file'])) {
            header('Location: /index.php');
            exit;
        }
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
