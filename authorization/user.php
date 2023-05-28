<?php

if (!isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit;
}

$user_id = intval($_SESSION['user']['id']);
