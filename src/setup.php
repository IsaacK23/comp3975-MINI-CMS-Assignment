<?php
include("index_db_params.php");

// 1. Select the DB
mysqli_select_db($conn, $db_name);

// 2. Fix the table structure (Using VARCHAR(255) for the hash)
$tableSql = "CREATE TABLE IF NOT EXISTS Users (
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255) NOT NULL
)";
mysqli_query($conn, $tableSql);

// 3. ALTER the table just in case it already exists with the old, small size
mysqli_query($conn, "ALTER TABLE Users MODIFY Password VARCHAR(255) NOT NULL");

// 4. Wipe and Re-seed
mysqli_query($conn, "TRUNCATE TABLE Users"); 

$hashedpw = password_hash('P@$$w0rd', PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO Users (Username, Password) VALUES (?, ?)");

$username = 'a@a.a'; 
$stmt->bind_param("ss", $username, $hashedpw);

if ($stmt->execute()) {
    echo "<h1>Table Fixed!</h1>";
    echo "<p>User <strong>a@a.a</strong> created with a secure 60-character hash.</p>";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
?>