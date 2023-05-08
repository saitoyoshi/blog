<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';

function getTagsByPostId($post_id) {
    $sql = "SELECT t.name FROM tags t
            JOIN post_tags pt ON t.id = pt.tag_id
            WHERE pt.post_id = ?";
    $tagNamesResult = db($sql, $post_id);
    $tagNames = array_column($tagNamesResult, 'name');
    return $tagNames;
}
if (!isset($_SESSION['visited'])) {
    $_SESSION['visited'] = true;
    $_SESSION['user'] = unserialize($_SESSION['user']);
}
var_dump($_SESSION);
$posts = Post::getAllPosts();
// タグを取得する
// idを入力として与える、そのidでpost_idを検索、そこで取得した、tag_idでtagsテーブルからname取得、配列
// タグが選択されたかのフラグがあれば、タグで検索したポスト
// なければ、すべてのPoST
$title = 'list page';
$content = __DIR__ . '/views/list.php';
include __DIR__ . '/views/layout.php';
