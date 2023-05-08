<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/libs/utils.php';
require_once __DIR__ . '/libs/validatePost.php';

function processPostRequest($blogTitle, $blogContent) {
    $tags = explode(',', $_POST['tags']);
        if (count($tags) !== 0) {
            $tags = array_map('trim', $tags);
            $tags = array_filter($tags, function($v) {
                return $v !== "";
            });
        } else {
            $tags = [''];
        }
        $sql = 'select name from tags';
        $result = db($sql);
        $dbTags = array_column($result, 'name');
        foreach ($tags as $tag) {
            if (!in_array($tag, $dbTags)) {
                db('insert into tags (name) values (?)', $tag);
            }
        }
        $user_id = $_SESSION['user']->getId();
        $post = new Post($user_id, $blogTitle, $blogContent);
        $post_id = $post->createPost();
        // 入力されたタグを処理
        foreach ($tags as $tag) {
            // タグ名からタグのIDを取得
            $sql = "SELECT id FROM tags WHERE name = ?";
            $result = db($sql, $tag);
            $tag_id = $result[0]['id'];

            // post_tagsテーブルに関連データを挿入
            $sql = "INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)";
            db($sql, $post_id, $tag_id);
        }
        header('Location: list.php');
        exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogTitle = $_POST['title'];
    $blogContent = $_POST['content'];
    $errors = validatePost($blogTitle, $blogContent);
    if (count($errors) === 0) {
        processPostRequest($blogTitle, $blogContent);
    }
}

$title = 'write page';
$content = __DIR__ . '/views/write.php';
include __DIR__ . '/views/layout.php';
