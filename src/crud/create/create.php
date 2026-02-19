<?php
session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New Article</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/style.css?v=1.2">
</head>
<body class="container">

    <div class="wrapper" >
        <h2>Create New Text</h2>
        
        <form action="process_create.php" method="POST" id="create-form">
            <div class="form-group">
                <div id="editor"></div>
                <input type="hidden" name="Text" id="text-input" />
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="../../index.php" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create Article" name="create" class="btn" style="background-color:rgb(71, 184, 157); color: white;" />
            </div>
        </form>
    </div>

    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
    (function() {
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write anything...'
        });

        document.getElementById('create-form').onsubmit = function() {
            document.getElementById('text-input').value = quill.root.innerHTML;
            return true;
        };
    })();
    </script>
</body>
</html>