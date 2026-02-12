<?php session_start(); 

include("index_db_params.php");

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS CMSDB");
mysqli_select_db($conn, "CMSDB");

if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<h1>List of Texts</h1>
<body>
<p>
<a href="crud/create/create.php" class="btn btn-small btn-success">Create New</a>
</p>
</body>

</html>

<?php 
if ($conn !== FALSE) {
    $SQLstring = "select * from Articles";
    if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<tr><th>Text</th>".
             "<th>&nbsp;</th></tr>\n";
     while ($Row = mysqli_fetch_assoc($QueryResult)) {
          echo "<tr>";
          echo "<td>" . htmlspecialchars($Row['content']) . "</td>";
          echo "<td>";
          echo "<a class='btn btn-small btn-primary' href='crud/display/display.php?id={$Row['id']}'>disp</a>";
          echo "&nbsp;";
          echo "<a class='btn btn-small btn-warning' href='crud/update/update.php?id={$Row['id']}'>upd</a>";
          echo "&nbsp;";
          echo "<a class='btn btn-small btn-danger' href='crud/delete/delete.php?id={$Row['id']}'>del</a>";
          echo "</td></tr>\n";
     };
        echo "</table>\n";

        echo "<p>Your query returned the above "
             . mysqli_num_rows($QueryResult)
             . " rows and ". mysqli_num_fields($QueryResult)
             . " columns.</p>";

        mysqli_free_result($QueryResult);
   }

   mysqli_close($conn);
}
?>