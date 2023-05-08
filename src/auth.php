<?php

session_start();

$current_page = basename($_SERVER['PHP_SELF']);
$is_logged_in = isset($_SESSION['user']);

$public_pages = ['login.php', 'regist.php'];
$private_pages = ['list.php', 'write.php', 'content.php', 'edit.php', 'tag.php'];

// ログインしていない場合で、ログインページと登録ページ以外にアクセスした場合は、ログインページにリダイレクト
if (!$is_logged_in && !in_array($current_page, $public_pages)) {
    header('Location: login.php');
    exit;
}

// ログインしている場合で、プライベートページ以外にアクセスした場合は、一覧ページにリダイレクト
if ($is_logged_in && !in_array($current_page, $private_pages)) {
    header('Location: list.php');
    exit;
}
