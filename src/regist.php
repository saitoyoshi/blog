<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/libs/utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    // バリデーション処理...
    if (strlen($_POST['name']) < 2 || strlen($_POST['name']) > 50) {
        $errors['name'] = '名前は2文字以上50文字以内で入力してください';
    }
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスの形式が正しくありません';
    } else {
        $isDupulicate = db('select count(email) as email_count from users where email = ?', $email);
        if ($isDupulicate[0]['email_count'] === 1) {
            $errors['email'] = 'すでに登録されたメールアドレスです';
        }
    }
    if (strlen($_POST['password']) < 8) {
        $errors['password'] = 'パスワードは最低8文字でなければなりません';
    }
    // エラーがなければ、入力値を変数に格納し、処理を続行
    if (count($errors) === 0) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $user = new User($password, $email);
        $user->setName($name);
        if ($user->register()) {
            $_SESSION['user'] = $user;
            header('Location: list.php');
            exit;
        } else {
            echo 'DB関係でエラーかな？';
            exit;
        }
    } else {
        var_dump($_POST['name']);
        var_dump($errors);
    }
}
$title = 'regist page';
$content = __DIR__ . '/views/regist.php';
include __DIR__ . '/views/layout.php';
