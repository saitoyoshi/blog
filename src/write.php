<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/libs/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogTitle = $_POST['title'];
    $blogContent = $_POST['content'];
    $errors = [];
    if ($blogTitle === '') {
        $errors['title'] = 'タイトルが空です';
    } elseif (strlen($blogTitle) > 255) {
        $errors['title'] = 'タイトルは255文字以内でなければなりません';
    }
    if ($blogContent === '') {
        $errors['title'] = 'タイトルが空です';
    } elseif (strlen($blogContent) > 20000) {
        $errors['title'] = 'タイトルは20000文字以内でなければなりません';
    }
    if (count($errors) === 0) {
        $user_id = $_SESSION['user']->getId();
        $post = new Post($user_id, $blogTitle, $blogContent);
        $post->createPost();
        header('Location: list.php');
        exit;
    }
}

$title = 'write page';
$content = __DIR__ . '/views/write.php';
include __DIR__ . '/views/layout.php';
