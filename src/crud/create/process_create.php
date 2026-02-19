<?php
session_start();
// Security Check
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_POST['create'])) {
    include("../../index_db_params.php");
    include("../../utils.php");

    // Initialize $exec to prevent "undefined variable" errors
    $exec = false;

    if ($conn !== FALSE) {
        // Use the DB name defined in your index_db_params.php
        mysqli_select_db($conn, $db_name);

        // Map form data
        extract($_POST);

        // Use your specific HTML sanitizer from utils.php
        $Text = sanitize_html($Text);

        // Lowercase 'content' matches your MariaDB DESCRIBE output
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

    // Only redirect if the insert actually worked
    if ($exec === true) {
        header('Location: ../../index.php');
        exit;
    } else {
        echo "Error saving article. Check the error log.";
    }
}