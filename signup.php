<?php

require_once './init.php';
require_once './authorization/guest.php';

/** @var mysqli $mysqli */

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = get_post_input('signup');

    if (mb_strlen($input['username']) === 0) {
        $errors['username'] = 'Введите псевдоним';
    }

    if (mb_strlen($input['email']) === 0) {
        $errors['email'] = 'Введите email';
    } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некорректно введена почта';
    } elseif (is_email_exist($mysqli, $input['email'])) {
        $errors['email'] = 'Почта занята. Введите новую почту!';
    }

    if (mb_strlen($input['password']) === 0) {
        $errors['password'] = 'Введите пароль';
    }

    if (empty($errors)) {
        if (create_user($mysqli, [$input['username'], $input['email'], $input['password']])) {
            header('Location: /login.php');
        }
    }
}

$page_content = includeTemplate('signup.php', [
    'errors' => $errors
]);

$layout_content = includeTemplate('layouts/main.php', [
    'title' => 'Sign up',
    'page_content' => $page_content,
    'css_href' => './assets/css/signup.css',
]);

print($layout_content);
