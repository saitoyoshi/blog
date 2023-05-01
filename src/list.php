<?php

require_once __DIR__ . '/classes/User.php';
session_start();


$title = 'list page';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';
