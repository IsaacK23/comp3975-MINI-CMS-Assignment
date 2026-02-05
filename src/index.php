<?php 
include("index_db_params.php");

// 1. AUTO-CREATE DATABASE (Procedural Style)
// We use mysqli_query instead of $conn->query to stay procedural
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` ");

// 2. Select the database now that we are sure it exists
mysqli_select_db($conn, $db_name);
?>

<h1>Hello World</h1>

<?php if (!$conn): ?>
    <p>Connection failed: <?php echo mysqli_connect_error(); ?></p>
<?php else: ?>
    <p>Success! You are connected to the <strong><?php echo $db_name; ?></strong> database.</p>
    
    <p>Your PHP server is currently looking at: 
       <code>/Users/cali/Desktop/comp3975-MINI-CMS-Assignment/src/</code>
    </p>
<?php endif; ?>