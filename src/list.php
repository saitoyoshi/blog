<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/classes/User.php';
var_dump($_SESSION);
// ユーザー名を取得して、インスタンスにセットする必要がある
$title = 'list page';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';
