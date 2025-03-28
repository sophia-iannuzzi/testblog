<?php
include "connectionvar.php";
$query = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id JOIN `postcat` ON post.post_id=postcat.post_id JOIN `category` ON postcat.category_id=category.category_id";
$postlist = mysqli_query($conn, $query);
?>