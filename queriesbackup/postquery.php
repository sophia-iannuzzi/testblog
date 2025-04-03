<?php
$unpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='0'";
$unpostlist = mysqli_query($conn, $unpostlistq);
$pubpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1'";
$pubpostlist = mysqli_query($conn, $pubpostlistq);
$allpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id";
$allpostlist = mysqli_query($conn, $allpostlistq);
?>