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
<form action="process_delete.php" method="POST">
    <h1>Delete Article</h1>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />

    <p>Are you sure you want to delete this article?</p>

    <input type="submit" value="Cancel" name="cancel" class="btn btn-small btn-primary" formaction="../../index.php" formmethod="get" />
    &nbsp;
    <input type="submit" value="Delete" name="delete" class="btn btn-small btn-danger" />
</form>
