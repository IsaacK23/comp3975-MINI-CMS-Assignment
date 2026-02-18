<?php

include("index_db_params.php");

// 1. AUTO-CREATE DATABASE 
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` ");

// 2. Select the database now that we are sure it exists
mysqli_select_db($conn, $db_name);

// Create first table 
$tableSql = "CREATE TABLE IF NOT EXISTS Users (
    Username VARCHAR(20) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $tableSql);

// create an articles table if it not exists 
$articleTable = "CREATE TABLE IF NOT EXISTS Articles ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
mysqli_query(mysql: $conn, query: $articleTable);


// 3. AUTO-INSERT SAMPLE DATA (Only if table is empty)
$checkEmpty = mysqli_query($conn, "SELECT COUNT(*) as total FROM Users");
$data = mysqli_fetch_assoc($checkEmpty);

if ($data['total'] == 0) {
    $hashedpw = password_hash('P@$$w0rd', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO Users (Username, Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedpw);
    $username = 'a@a.a';
    $stmt->execute();
    $stmt->close();
}
?>