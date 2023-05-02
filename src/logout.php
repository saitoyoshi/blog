<?php

session_start();
if (isset($_SESSION['user'])) {
    $_SESSION = [];
    session_destroy();
    // クライアント側のセッションIDクッキーを削除
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

header('Location: login.php');
exit;
