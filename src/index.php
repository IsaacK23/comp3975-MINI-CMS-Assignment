<?php session_start(); 
if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<h1>Text Editor</h1>

<textarea id="textbox" name="textbox" rows="10" cols="50">
</textarea>
<input type="submit" value="Submit">

</html>