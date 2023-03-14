<?php

session_start();

include "connectDB.php";


if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {

        $data = trim($data);

        $data = stripslashes($data);

        $data = htmlspecialchars($data);

        return $data;

    }

    $username = validate($_POST['username']);

    $pass = validate($_POST['password']);

    if (empty($username)) {

        header("Location: index.php?error=User Name is required");

        exit();

    } else if (empty($pass)) {

        header("Location: index.php?error=Password is required");

        exit();

    } else {

        $sql = "SELECT * FROM login WHERE username='$username' OR email='$username' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if (($row['email'] === $username || $row['username'] === $username) && $row['password'] === $pass) {

                $_SESSION['username'] = $row['username'];
                $_SESSION['course'] = $row['course'];
                $_SESSION['password'] = $row['password'];
                $cookie_expiration = time() + (86400 * 2);
                setcookie('username', $_SESSION['username'], $cookie_expiration, '/');
                setcookie('course', $_SESSION['course'], $cookie_expiration, '/' );
                header("Location: home.php");

                exit();

            } else {

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        } else {

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

} else {

    header("Location: index.php");

    exit();

}