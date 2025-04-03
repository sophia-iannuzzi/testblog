<?php
$categoryq = "SELECT * FROM `category`";
$categories = mysqli_query($conn, $categoryq);
$pubcategoryq = "SELECT * FROM `category` WHERE status='1'";
$pcategories = mysqli_query($conn, $pubcategoryq);
?>