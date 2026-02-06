<?php
session_start();
extract($_POST);

// make a connection to the database
// and find the user with the given username and password

if ($username == "a@a.a" && $password == 'P@$$w0rd') {
    $_SESSION['authenticated'] = true;
    header("Location: index.php");
} else {
    header("Location: login.php");
}

?>