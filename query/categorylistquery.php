<?php
include "..\connectionvar.php";
$query = "SELECT * FROM `category`";
$categories = mysqli_query($conn, $query);
?>