<?php

require_once __DIR__ . '/classes/User.php';
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];
        $sql = "SELECT * FROM posts WHERE id = ?";
        $result = db($sql, $postId);
        if ($result[0] && $result[0]['user_id'] == $_SESSION['user']->getId()) {
            // 子行がのこっていると削除できないので。
            $sql = "DELETE FROM post_tags WHERE post_id = ?";
            db($sql, $postId);

            $sql = "DELETE FROM posts WHERE id = ?";
            db($sql, $postId);
        }
    }

    header('Location: list.php');
    exit();
}
