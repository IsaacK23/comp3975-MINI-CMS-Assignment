<?php

session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id === null || !is_numeric($id)) {
    header("Location: ../../index.php");
    exit;
}

include("../../index_db_params.php");
mysqli_select_db($conn, $db_name);

$article = null;
if ($conn !== FALSE) {
    $sql = "SELECT id, content FROM Articles WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $article = $row;
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}

if ($article === null) {
    header("Location: ../../index.php");
    exit;
}
?>
<form action="process_update.php" method="POST">
    <h1>Edit Text</h1>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>" />

    <label for="textbox">Text Editor:</label>
    <br><br>

    <textarea id="textbox" name="Text" rows="14" cols="50"><?php echo htmlspecialchars($article['content']); ?></textarea>
    <br><br>

    <input type="submit" value="Update" name="update" class="btn btn-warning" />
</form>
