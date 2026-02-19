<?php
$db_host = getenv('MYSQL_DBHOST') ?: "127.0.0.1";
$db_port = getenv('MYSQL_DBPORT') ?: "3333";
$db_user = getenv('MYSQL_DBUSER') ?: "root";
$db_pass = getenv('MYSQL_DBPASS') ?: "secret";
$db_name = getenv('MYSQL_DBNAME') ?: "CMSDB";

$conn = mysqli_connect($db_host, $db_user, $db_pass, '', $db_port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` ");
mysqli_select_db($conn, $db_name);

// Users table
$userTable = "CREATE TABLE IF NOT EXISTS Users (
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $userTable);

// Articles table 
$articleTable = "CREATE TABLE IF NOT EXISTS Articles ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $articleTable);

$checkUsers = mysqli_query($conn, "SELECT COUNT(*) as total FROM Users");
$userData = mysqli_fetch_assoc($checkUsers);

if ($userData['total'] == 0) {
    $hashedpw = password_hash('P@$$w0rd', PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO Users (Username, Password) VALUES (?, ?)");
    $u = 'a@a.a';
    mysqli_stmt_bind_param($stmt, "ss", $u, $hashedpw);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>