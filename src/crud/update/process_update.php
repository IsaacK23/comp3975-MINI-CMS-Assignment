<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_POST['update'])) {

    include("../../index_db_params.php");
    include("../../utils.php");

    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        extract($_POST);

        $id = isset($id) && is_numeric($id) ? (int) $id : 0;
        $Text = sanitize_input($Text);

        if ($id > 0) {
            $sql = "UPDATE Articles SET content = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "si", $Text, $id);

                $exec = mysqli_stmt_execute($stmt);

                if ($exec === false) {
                    error_log('mysqli execute() failed: ' . htmlspecialchars($stmt->error));
                }

                mysqli_stmt_close($stmt);
            }
        }
    }

    mysqli_close($conn);
}

header('Location: ../../index.php');
exit;
