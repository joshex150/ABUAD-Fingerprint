<?php 

session_start();

setcookie('username', $_SESSION['username'], time(), '/');

setcookie('course', $_SESSION['course'], time(), '/' );

session_unset();

session_destroy();

header("Location: index.php");