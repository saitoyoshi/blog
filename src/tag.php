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
$tagName = $_GET['tag'];

$sql = "select p.*, u.username from posts p
        join post_tags pt on p.id = pt.post_id
        join tags t on t.id = pt.tag_id
        join users u on p.user_id = u.id
        where t.name = ?";
$result = db($sql, $tagName);
$posts = [];
foreach ($result as $row) {
    $post = new Post(
        $row['user_id'],
        $row['title'],
        $row['content'],
        $row['id'],
        $row['created_at'],
        $row['updated_at']
    );
    $post->setUsername($row['username']);
    $posts[] = $post;
}
// var_dump($posts);

$title = 'tag page';
$content = __DIR__ . '/views/tag.php';
include __DIR__ . '/views/layout.php';
