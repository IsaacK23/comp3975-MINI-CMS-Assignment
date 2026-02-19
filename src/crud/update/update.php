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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">

    <div class="wrapper">
        <h2>Edit Text</h2>
        
        <form action="process_update.php" method="POST" id="update-form">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>" />
            
            <div class="form-group">
                <div id="editor"></div>
                <input type="hidden" name="Text" id="text-input" />
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Update Article" name="update" class="btn" style="background-color: rgb(71, 184, 157); color: white;" />
            </div>
        </form>
    </div>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
(function() {
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write anything'
    });

    var initialContent = <?php echo json_encode($article['content']); ?>;
    if (initialContent) {
        quill.root.innerHTML = initialContent;
    }

    document.getElementById('update-form').onsubmit = function() {
        document.getElementById('text-input').value = quill.root.innerHTML;
        return true;
    };
})();
</script>
