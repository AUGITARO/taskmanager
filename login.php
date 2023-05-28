<?php

require_once './init.php';
require_once './authorization/guest.php';

/** @var mysqli $mysqli */

$errors = [];

const PASSWD_VALIDATION_ERROR = 'Введена неправильная почта или пароль';

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
                $errors['password'] = PASSWD_VALIDATION_ERROR;
            }
        } else {
            $errors['password'] = PASSWD_VALIDATION_ERROR;
        }
    }
}

$page_content = includeTemplate('login.php', [
    'errors' => $errors
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Log in',
    'page_content' => $page_content,
    'css_href' => './assets/css/login.css'
]);

print($layout_content);
