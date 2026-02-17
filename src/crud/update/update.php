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
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<form action="process_update.php" method="POST" id="update-form">
    <h1>Edit Text</h1>

    <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['id']); ?>" />

    <label for="editor">Text Editor:</label>
    <br><br>

    <div id="editor" style="min-height: 200px;"></div>
    <input type="hidden" name="Text" id="text-input" />

    <br><br>

    <input type="submit" value="Update" name="update" class="btn btn-warning" />
</form>

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
