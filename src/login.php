<?php 
include("index_db_params.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="text-center">Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper" style="max-width:500px">
        <h2>Login</h2>
        <form method="post" action="login_process.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
            <input type="submit" value="Login" name="login" class="btn" style="background-color:rgb(71, 184, 157); color: white;">
            </div>
        </form>
        <p><br> Username = a@a.a <br> Password = P@$$w0rd</p>
    </div>
</body>
</html>


