<?php 

session_start();

setcookie('username', $_SESSION['username'], time(), '/');

setcookie('course', $_SESSION['course'], time(), '/' );

unset($_SESSION['username']);

unset($_SESSION['course']);

header("Location: index.php");