<?php 
include("index_db_params.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini CMS</title>
</head>
<body>
    <form method="post" action="login_process.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <p>
        <a href="register.php">Register</a>
    </p>
    <p>This is for demo purposes. Only user=a@a.a and password=P@$$w0rd work.</p>
</body>
</html>

<?php if (!$conn): ?>
    <p>Connection failed: <?php echo mysqli_connect_error(); ?></p>
<?php else: ?>
    <p>Success! You are connected to the <strong><?php echo $db_name; ?></strong> database.</p>
<?php endif; ?>