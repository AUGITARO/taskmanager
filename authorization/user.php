<?php

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);
