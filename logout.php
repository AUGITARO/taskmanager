<?php

require_once './init.php';
require_once './authorization/user.php';

$_SESSION = [];
header('Location: /index.php');
