<?php

require_once('init.php');

if (isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('login');

    if (mb_strlen($input['email']) === 0) {
        $errors['email'] = 'Введите email';
    } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректно введена почта';
    }

    if (mb_strlen($input['password']) === 0) {
        $errors['password'] = 'Введите пароль';
    }

    if (empty($errors)) {
        if ($user = get_user_by_email($mysqli, $input['email'])) {

            if (password_verify($input['password'], $user['password_hash'])) {
                $_SESSION['user'] = $user;
                header('Location: /index.php');
            } else {
                $errors['password'] = 'Введена неправильная почта или пароль';
            }
        } else {
            $errors['password'] = 'Введена неправильная почта или пароль';
        }
    }
}

$page_content = includeTemplate('log-in.php', [
    'errors' => $errors
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Log in',
    'page_content' => $page_content,
    'css_href' => './css/Login.css'
]);

print($layout_content);