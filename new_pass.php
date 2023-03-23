<?php
require 'connectDB.php';
if (isset($_COOKIE['name'])) {
    if ($_POST['password'] == $_POST['confpassword']) {
        $code = $_COOKIE['verify'];
        $user = $_COOKIE['name'];
        $password = $_POST['password'];
        $stmt = mysqli_prepare($conn, "UPDATE `login` SET `password` = ? WHERE `username` = ? AND `pass_reset` = ?");
        mysqli_stmt_bind_param($stmt, 'ssi', $password, $user, $code);
        if (mysqli_stmt_execute($stmt)) {
            setcookie('name', "", time(), '/');
            setcookie('verify', "", time(), '/');
            header("Location: index.php");
            exit();
        } else {
            //echo 'Error updating pass reset value: ' . mysqli_error($conn);
            header("Location: change_pass.php?Try-Again=yes");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: change_pass.php?paswords-do-not-match=yes");
    }
} else {
    header("Location: reset_pass.php?failed=yes");
}
?>