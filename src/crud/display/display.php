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
    <title>View Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="wrapper" style="max-width: 500px;">
        <h2>Article Details</h2>
        
        <p><strong>Created:</strong> <?php echo htmlspecialchars($article['created_at']); ?></p>
        
        <div class="article-content mb-4">
            <?php echo $article['content']; ?>
        </div>

        <div class="d-flex justify-content-between">
            <a href="../../index.php" class="btn btn-secondary">Back</a>
            <div>
                <a href="../update/update.php?id=<?php echo $article['id']; ?>" class="btn" style="background-color: #28464B; color: white;">Edit</a>
                <a href="../delete/delete.php?id=<?php echo $article['id']; ?>" class="btn" style="background-color: #931621; color: white;">Delete</a>
            </div>
        </div>
    </div>
</body>
</html>