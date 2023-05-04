<?php

session_start();

// すでにログインしている場合は、一覧ページにリダイレクト
if (isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) !== 'list.php' && basename($_SERVER['PHP_SELF']) !== 'regist.php' && basename($_SERVER['PHP_SELF']) !== 'write.php' && basename($_SERVER['PHP_SELF']) !== 'content.php') {
    header('Location: list.php');
    exit;
}

// ログインしていない場合で、ログインページと登録ページ以外にアクセスした場合は、ログインページにリダイレクト
if (!isset($_SESSION['user']) && basename($_SERVER['PHP_SELF']) !== 'login.php' && basename($_SERVER['PHP_SELF']) !== 'regist.php') {
    header('Location: login.php');
    exit;
}
