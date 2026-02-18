<?php
session_start();

if (isset($_POST['login'])) {

    include("index_db_params.php");

    if ($conn !== FALSE) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $sql = "SELECT Password FROM Users WHERE Username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $username);

            $exec = mysqli_stmt_execute($stmt);

            if ($exec === false) {
                error_log('mysqli execute() failed: ' . htmlspecialchars($stmt->error));
            }

            mysqli_stmt_bind_result($stmt, $stored_hash);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);

    if ($stored_hash && password_verify($password, $stored_hash)) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    } else {
        header('Location: login.php');
        exit;
    }
}
?>