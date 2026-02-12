<?php
getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host="127.0.0.1";
getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port="3333";
getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user="root";
getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass="secret";
getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name="";

// list of db params to different tables
$conn = mysqli_connect("$db_host:$db_port", $db_user, $db_pass);

if (!$conn) {
    die("". mysqli_connect_error());
}

if (empty($db_name)) {
    $db_name = "CMSDB";
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` ");
mysqli_select_db($conn, $db_name);

// Create first table 
$tableSql = "CREATE TABLE IF NOT EXISTS Users (
    Username VARCHAR(20) PRIMARY KEY,
    Password VARCHAR(50) NOT NULL
)";
mysqli_query($conn, $tableSql);


// auto create tables if they don't exist 
$articleTable = "CREATE TABLE IF NOT EXISTS Articles ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
mysqli_query(mysql: $conn, query: $articleTable);




// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>