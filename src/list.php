<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/classes/User.php';
var_dump($_SESSION);
$title = 'list page';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';
