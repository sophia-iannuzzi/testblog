<?php
$allcommentq = "SELECT * FROM `comment`";
$allcomment = mysqli_query($conn, $allcommentq);
if (isset($_SESSION['postid'])) {
    $postid = $_SESSION['postid'];
    $postcommentq = "SELECT * FROM `comment` WHERE post_id=$postid AND comment.status='1'";
    $postcomment = mysqli_query($conn, $postcommentq);
}
?>