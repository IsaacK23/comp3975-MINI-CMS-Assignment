<?php

if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
}

if (isset($_POST['create'])) {

    include("../../index_db_params.php");
    include("../../utils.php");

    mysqli_select_db($conn, $db_name);
    

    if ($conn !== FALSE) {
        extract($_POST);

        $Text = sanitize_input($Text);

        $sql = "INSERT INTO Articles (Content) VALUES ";
        // FIX 1: Added a fifth question mark for the Email column
        $sql .= "(?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            // FIX 2: Correctly matches 5 strings ("sssss") to 5 variables
            mysqli_stmt_bind_param($stmt, "s", $Text);

            $exec = mysqli_stmt_execute($stmt);

            if ($exec === false) {
                error_log('mysqli execute() failed: ' . htmlspecialchars($stmt->error));
            }
            
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);

    if ($exec === true) {
        header('Location: ../../index.php');
        exit;
    }
}