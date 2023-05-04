<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';

// 投稿の取得
$post = Post::getPostById($_GET['id']);

$title = 'content page';
$content = __DIR__ . '/views/content.php';
include __DIR__ . '/views/layout.php';
