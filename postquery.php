<?php
include "connectionvar.php";
$query = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id";
$postlist = mysqli_query($conn, $query);
?>