<?php

require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Post.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/libs/utils.php';
require_once __DIR__ . '/libs/validatePost.php';

function getTagsString($postId) {
    $sql = "select tag_id from post_tags where post_id = ?";
    $tagIdsResult = db($sql, $postId);

    if (count($tagIdsResult) === 0) {
        return '';
    }

    $tagIds = array_column($tagIdsResult, 'tag_id');
    $sql = "select name from tags where id IN (" . implode(',', array_fill(0, count($tagIds), '?')) . ")";
    $tagNamesResult = db($sql, ...$tagIds);
    $tagNames = array_column($tagNamesResult, 'name');

    return implode(',', $tagNames);
}

function updatePost($postId, $title, $content, $tags) {
    $tags = array_map('trim', $tags);
    $tags = array_filter($tags, function ($v) {
        return $v !== '';
    });
    $sql = 'select name from tags';
    $result = db($sql);
    $dbTags = array_column($result, 'name');
    foreach ($tags as $tag) {
        if (!in_array($tag, $dbTags)) {
            db('insert into tags (name) values (?)', $tag);
        }
    }
    if (count($tags) !== 0) {
        $sql = 'select id from tags where name in  (' . implode(',', array_fill(0, count($tags), '?')) . ')';
        $tagIdsResult = db($sql, ...$tags);
        $tagIds = array_column($tagIdsResult, 'id');
    } else {
        $tagIds = [];
    }
    // 入力されたtagidを取得する
    if (!empty($tagIds)) {
        $sql = 'select tag_id from post_tags where post_id = ?';
        $dbTagIdsResult = db($sql, $postId);
        if (count($dbTagIdsResult) !== 0) {
            $dbTagIds = array_column($dbTagIdsResult, 'tag_id');
            foreach ($tagIds as $id) {
                if (!in_array($id, $dbTagIds)) {
                    db('insert into post_tags (post_id, tag_id) values (?, ?)', $postId, $id);
                }
            }
            foreach ($dbTagIds as $id) {
                if (!in_array($id, $tagIds)) {
                    db('delete from post_tags where post_id = ? and tag_id = ?',$postId, $id);
                }
            }
        }
    }
    $sql = 'update posts set title = ?, content = ? where id = ?';
    db($sql, $title, $content, $postId);
}


$post_id = $_GET['id'];
$tagStr = getTagsString($post_id);
$post = Post::getPostById($post_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $errors = validatePost($title, $content);

    if (count($errors) === 0) {
        $postId = $_POST['post_id'];
        $userId = db('select user_id from posts where id = ?', $postId);

        if ($_SESSION['user']->getId() === $userId[0]['user_id']) {
            $tags = explode(',', $_POST['tags']);
            updatePost($postId, $title, $content, $tags);
            header('Location: list.php');
            exit;
        }
    }
}

$title = 'edit page';
$content = __DIR__ . '/views/edit.php';
include __DIR__ . '/views/layout.php';
