<?php
getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host="127.0.0.1";
getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port="3333";
getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user="root";
getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass="secret";
getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name="";

if (strlen( $db_name ) === 0) {
    $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass);
    $db_name = "CMSDB";
} else {
    $conn = new mysqli("$db_host:$db_port", $db_user, $db_pass, $db_name);
}

// list of db params to different tables
$conn = mysqli_connect("$db_host:$db_port", $db_user, $db_pass);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>