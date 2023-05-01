<?php

require_once __DIR__ . '/classes/User.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = new User($password, $email);
    if ($user->login()) {
        session_regenerate_id();
        $_SESSION['user'] = $user;
        header('Location: list.php');
        exit;
    }
}



$title = 'login page';
$content = __DIR__ . '/views/login.php';
include __DIR__ . '/views/layout.php';
