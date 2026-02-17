<?php

session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location: ../../login.php");
    exit;
}
?>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<form action="process_create.php" method="POST" id="create-form">
    <h1>Create New Texts</h1>

    <label for="editor">Text Editor:</label>
    <br><br>

    <div id="editor" style="min-height: 200px;"></div>
    <input type="hidden" name="Text" id="text-input" />

    <br><br>

    <input type="submit" value="Create" name="create" class="btn btn-success" />
</form>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
(function() {
    var quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Write anything'
    });

    document.getElementById('create-form').onsubmit = function() {
        document.getElementById('text-input').value = quill.root.innerHTML;
        return true;
    };
})();
</script>
