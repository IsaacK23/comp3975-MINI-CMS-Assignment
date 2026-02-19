<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_POST['create'])) {
    include("../../index_db_params.php");
    include("../../utils.php");

    $exec = false;

    if ($conn !== FALSE) {
        mysqli_select_db($conn, $db_name);

        extract($_POST);

        $Text = sanitize_html($Text);

        $sql = "INSERT INTO Articles (content) VALUES (?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $Text);
            $exec = mysqli_stmt_execute($stmt);

            if ($exec === false) {
                error_log('mysqli execute() failed: ' . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);

    if ($exec === true) {
        header('Location: ../../index.php');
        exit;
    } else {
        echo "Error saving article. Check the error log.";
    }
}