<?php
// 1. AUTO-CREATE DATABASE 
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` ");

// 2. Select the database now that we are sure it exists
mysqli_select_db($conn, $db_name);

// Create first table 
$tableSql = "CREATE TABLE IF NOT EXISTS CMSDB (
    Username VARCHAR(20) PRIMARY KEY,
    Password VARCHAR(50)
)";
mysqli_query($conn, $tableSql);

// Create the second table
$tableSql2 = "CREATE TABLE IF NOT EXISTS Articles (
    Content TEXT
)";
mysqli_query($conn, $tableSql2);

// 3. AUTO-INSERT SAMPLE DATA (Only if table is empty)
$checkEmpty = mysqli_query($conn, "SELECT COUNT(*) as total FROM CMSDB");
$data = mysqli_fetch_assoc($checkEmpty);

if ($data['total'] == 0) {
    // Insert seed data into CMSDB
    $conn->query("INSERT INTO CMSDB (Username, Password) VALUES 
            ('a@a.a', 'P@$$w0rd')
            ");
}
?>