<?php

//posts
$unpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='0'";
$unpostlist = mysqli_query($conn, $unpostlistq);
$pubpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1'";
$pubpostlist = mysqli_query($conn, $pubpostlistq);
$allpostlistq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id";
$allpostlist = mysqli_query($conn, $allpostlistq);

//users
$userlistq = "SELECT * FROM `user` JOIN `level` ON user.level_id=level.level_id";
$userlist = mysqli_query($conn, $userlistq);

//comments
$allcommentq = "SELECT * FROM `comment`";
$allcomment = mysqli_query($conn, $allcommentq);
if (isset($_SESSION['postid'])) {
    $postid = $_SESSION['postid'];
    $postcommentq = "SELECT * FROM `comment` WHERE post_id=$postid AND comment.status='1'";
    $postcomment = mysqli_query($conn, $postcommentq);
}

//categories
$categoryq = "SELECT * FROM `category`";
$categories = mysqli_query($conn, $categoryq);
$pubcategoryq = "SELECT * FROM `category` WHERE status='1'";
$pcategories = mysqli_query($conn, $pubcategoryq);

?>