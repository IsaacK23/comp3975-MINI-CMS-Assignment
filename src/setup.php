<?php
include("index_db_params.php");

mysqli_select_db($conn, $db_name);

$tableSql = "CREATE TABLE IF NOT EXISTS Users (
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $tableSql);

mysqli_query($conn, "ALTER TABLE Users MODIFY Password VARCHAR(255) NOT NULL");

mysqli_query($conn, "TRUNCATE TABLE Users"); 

$hashedpw = password_hash('P@$$w0rd', PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO Users (Username, Password) VALUES (?, ?)");

$username = 'a@a.a'; 
$stmt->bind_param("ss", $username, $hashedpw);

if ($stmt->execute()) {
    echo "Table created. ";
    echo "User a@a.a added with hashed password.";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>