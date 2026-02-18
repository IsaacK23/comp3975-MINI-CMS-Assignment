<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_POST['delete'])) {

    include("../../index_db_params.php");

    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        $id = isset($_POST['id']) && is_numeric($_POST['id']) ? (int) $_POST['id'] : 0;

        if ($id > 0) {
            $sql = "DELETE FROM Articles WHERE id = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "i", $id);

                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }
        }
    }

    mysqli_close($conn);
}

header('Location: ../../index.php');
exit;
