<?php

require_once __DIR__ . '/classes/User.php';
session_start();
require_once __DIR__ . '/libs/utils.php';
// todoすでにログインしていたら一覧ページにとばす
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ヴァリデーション ここはしっかりしません
    if (isset($_SESSION['errors'])) {
        unset($_SESSION['errors']);
    }
    if (isset($_SESSION['msg'])) {
        unset($_SESSION['msg']);
    }
    $errors = [];
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスの形式が正しくありません';
    }
    if (strlen($_POST['password']) < 8) {
        $errors['password'] = 'パスワードは最低8文字でなければなりません';
    }
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User($password, $email);
        if ($user->login()) {
            session_regenerate_id();
            $_SESSION['user'] = $user;
            if ($_SESSION['errors']) {
                unset($_SESSION['errors']);
            }
            if ($_SESSION['msg']) {
                unset($_SESSION['msg']);
            }
            header('Location: list.php');
            exit;
        } else {
            $_SESSION['msg'] = 'メールアドレスまたはパスワードが異なります';
        }
    }
}


$title = 'login page';
$content = __DIR__ . '/views/login.php';
include __DIR__ . '/views/layout.php';
