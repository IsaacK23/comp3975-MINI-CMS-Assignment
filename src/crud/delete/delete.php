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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="wrapper" style="max-width: 500px;">
        <h2>Confirm Delete</h2>
        
        <p class="text-center my-4">Are you sure you want to delete this article? This action cannot be undone.</p>

        <form action="process_delete.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />

            <div class="d-flex justify-content-between">
                <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                
                <input type="submit" value="Delete Permanently" name="delete" class="btn" style="background-color: #931621; color: white;" />
            </div>
        </form>
    </div>
</body>
</html>