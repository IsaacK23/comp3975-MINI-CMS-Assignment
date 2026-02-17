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
    $sql = "SELECT id, content, created_at FROM Articles WHERE id = ?";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Article</title>
</head>
<body>
<h1>Article</h1>
<p><a href="../../index.php" class="btn btn-small btn-primary">Back to list</a></p>
<p><strong>Created:</strong> <?php echo htmlspecialchars($article['created_at']); ?></p>
<div>
    <?php echo htmlspecialchars($article['content']); ?>
</div>
<p>
    <a href="../update/update.php?id=<?php echo htmlspecialchars($article['id']); ?>" class="btn btn-small btn-warning">Update</a>
    &nbsp;
    <a href="../delete/delete.php?id=<?php echo htmlspecialchars($article['id']); ?>" class="btn btn-small btn-danger">Delete</a>
</p>
</body>
</html>
