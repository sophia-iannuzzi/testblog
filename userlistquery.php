<?php
$query = "SELECT * FROM `user` JOIN `level` ON user.level_id=level.level_id";
$userlist = mysqli_query($conn, $query);
?>