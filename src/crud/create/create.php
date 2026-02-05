<?php 
?>

<form action="process_create.php" method="POST">
    <h1>Create New Texts</h1>

    <label for="textbox">Text Editor:</label>
    <br><br>

    <textarea id="textbox" name="Text" rows="14" cols="50">
        Write anything
    </textarea>
    <br><br>

    <input type="submit" value="Create" name="create" class="btn btn-success" />
</form>