<?php
require 'connectDB.php';

if (isset($_COOKIE['name'])) {
    $verify = $_POST['verify'];
    $cookie_expiration = time() + (21600);
    setcookie('verify', $verify, $cookie_expiration, '/');
    $sql = "SELECT * FROM `login` WHERE pass_reset = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $verify);

    if (!mysqli_stmt_execute($stmt)) {
        echo '<p class="error">SQL Error</p>';
    } else {
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            header("Location: change_pass.php");
            exit();
        }
    }
}else {
    header("Location: reset_pass.php?failed=yes");
}
?>
