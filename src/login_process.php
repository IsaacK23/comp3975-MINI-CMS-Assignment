<?php
session_start();

if (isset($_POST['login'])) {
    include("index_db_params.php");

    $login_err = "";

    if ($conn !== FALSE) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $sql = "SELECT Password FROM Users WHERE Username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_bind_result($stmt, $stored_hash);
                if (mysqli_stmt_execute($stmt)) {
                    $stored_hash = '';
                    mysqli_stmt_bind_result($stmt, $stored_hash);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $stored_hash)) {
                            $_SESSION['authenticated'] = true;
                            header("Location: index.php");
                            exit();
                        }
                    } else {
                        // Invalid password
                        $login_err = "Invalid username or password.";
                    }
                } else {
                    // Username not found
                    $login_err = "Invalid username or password.";
                }
            } else {
                // Failed
                error_log('mysqli execute() failed: ' . htmlspecialchars($stmt->error));
                $login_err = "An error occurred. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        } else {
            // Failed
            error_log('mysqli_prepare() failed: ' . htmlspecialchars($conn->error));
            $login_err = "An error occurred. Please try again later.";
        }
    } else {
        // Database connection failed
        error_log('Database connection failed.');
        $login_err = "An error occurred. Please try again later.";
    }

    mysqli_close($conn);

    // Redirect back to login.php 
    if (!empty($login_err)) {
        header("Location: login.php?login_err=" . urlencode($login_err));
        exit();
    }
}
?>