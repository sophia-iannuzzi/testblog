<?php
include "connectionvar.php";
$query = "SELECT * FROM `user`";
$userlist = mysqli_query($conn, $query);
?>