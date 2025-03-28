<?php
session_start();
?>

<html>
<body>
    <?php require("navbar.php"); ?>
    <h1>     
    <?php
    include("postquery.php");
    $row = mysqli_fetch_array($post);
    echo "<p>". $row['fname']. " ". $row['lname']. "</p>";
    ?> </h1>
</body>
</html>