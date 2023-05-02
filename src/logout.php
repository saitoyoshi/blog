<?php

session_start();
if (isset($_SESSION['user'])) {
    $_SESSION = [];
    session_destroy();
}

header('Location: login.php');
exit;
