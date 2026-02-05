<?php

// Change this line in your params file:
getenv('MYSQL_DBHOST') ? $db_host=getenv('MYSQL_DBHOST') : $db_host="host.docker.internal";
getenv('MYSQL_DBPORT') ? $db_port=getenv('MYSQL_DBPORT') : $db_port="3333";
getenv('MYSQL_DBUSER') ? $db_user=getenv('MYSQL_DBUSER') : $db_user="root";
getenv('MYSQL_DBPASS') ? $db_pass=getenv('MYSQL_DBPASS') : $db_pass="secret";
getenv('MYSQL_DBNAME') ? $db_name=getenv('MYSQL_DBNAME') : $db_name="New Database";

// list of db params to different tables
$conn = mysqli_connect("$db_host:$db_port", $db_user, $db_pass);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>