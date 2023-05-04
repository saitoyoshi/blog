<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';

if (!isset($_SESSION['visited'])) {
    $_SESSION['user'] = unserialize($_SESSION['user']);
    $_SESSION['visited'] = true;
}
$posts = Post::getAllPosts();

$title = 'list page';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';
