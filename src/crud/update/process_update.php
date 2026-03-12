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
    $exec = false;

    if ($conn !== FALSE) {
        $id = isset($_POST['id']) && is_numeric($_POST['id']) ? (int) $_POST['id'] : 0;
        $title = isset($_POST['title']) ? sanitize_text($_POST['title']) : '';
        $text = isset($_POST['Text']) ? sanitize_html($_POST['Text']) : '';

        if ($id > 0 && $title !== '' && $text !== '') {
            $sql = "UPDATE Articles SET title = ?, content = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {

                mysqli_stmt_bind_param($stmt, "ssi", $title, $text, $id);

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

if ($exec === true) {
    header('Location: ../../index.php');
    exit;
}

echo "Error updating article. Title and content are required.";
