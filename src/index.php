<?php 
session_start();
include("index_db_params.php"); 

if (!isset($_SESSION['authenticated'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container mt-4">

<h1 class="text-center">List of Texts</h1>

<p>
<a href="crud/create/create.php" class="btn btn-sm" style="background-color:rgb(71, 184, 157); color: white;">Create New +</a></p>

<?php
if ($conn !== FALSE) {
    mysqli_select_db($conn, $db_name);
    
    $SQLstring = "SELECT id, content FROM Articles"; 
    
    if ($QueryResult = @mysqli_query($conn, $SQLstring)) {
        echo "<table width='100%' class='table table-striped'>\n";
        echo "<thead>";
        echo "<tr><th>Text</th>";
        echo "<th class='text-right'>Actions</th></tr>\n";
        echo "</thead><tbody>";

        while ($Row = mysqli_fetch_assoc($QueryResult)) {
             echo "<tr>";
             echo "<td>" . $Row['content'] . "</td>";
             echo "<td class='text-right'>";
             echo "<a class='btn btn-sm' style='background-color: #2C8C99; color: white;' href='crud/display/display.php?id={$Row['id']}'>display</a>";             echo "&nbsp;";
             echo "<a class='btn btn-sm' style='background-color: #28464B; color: white;' href='crud/update/update.php?id={$Row['id']}'>edit</a>";
             echo "&nbsp;";
             echo "<a class='btn btn-sm' style='background-color: #931621; color: white;' href='crud/delete/delete.php?id={$Row['id']}'>delete</a>";
             echo "</td></tr>\n";
        }
        echo "</tbody></table>\n";

        echo "<p class='text-muted'>Your query returned "
             . mysqli_num_rows($QueryResult)
             . " rows and ". mysqli_num_fields($QueryResult)
             . " columns.</p>";

        mysqli_free_result($QueryResult);
   }
   mysqli_close($conn);
}
?>

<div class="mt-3">
    <a href="logout.php" class="btn btn-sm btn-secondary">LOGOUT</a>
</div>

</body>
</html>