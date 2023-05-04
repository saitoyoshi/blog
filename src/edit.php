<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/libs/utils.php';
require_once __DIR__ . '/libs/validatePost.php';

// 投稿の取得
$post = Post::getPostById($_GET['id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $errors = validatePost($title, $content);

    if (count($errors) === 0) {
        $postId = $_POST['post_id'];
        $userId = db('select user_id from posts where id = ?', $postId);
        if ($_SESSION['user']->getId() === $userId[0]['user_id']) {
            $sql = 'update posts set title = ?, content = ? where id = ?';
            db($sql, $title, $content, $postId);
            header('Location: list.php');
            exit;
        }
    }
}
$title = 'edit page';
$content = __DIR__ . '/views/edit.php';
include __DIR__ . '/views/layout.php';
