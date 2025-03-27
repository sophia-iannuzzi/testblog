<?php
include "..\connectionvar.php";
$query = "SELECT * FROM `post` JOIN `category` ON post.category_id=category.category_id";
$postlist = mysqli_query($conn, $query);
?>