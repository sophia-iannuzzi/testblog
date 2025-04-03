<?php
if (isset($_POST['addpost'])) {
    if ($_SESSION['loc']=='admin') {
        header("Location:../addpost.php");
    } else {
        header("Location:addpost.php");
    }
}

if (isset($_POST['editpost']) and isset($_POST['editop'])) {
    $_SESSION['postid'] = $_POST['editop'];
    if ($_SESSION['loc']=='admin') {
        header("Location:../editpost.php");
    } else {
        header("Location:editpost.php");
    }
}

if (isset($_POST['status0']) and isset($_POST['editop'])) {
    $postid = $_POST['editop'];
    $query = "UPDATE post SET statuspost='0' WHERE post_id=$postid";
    mysqli_query($conn, $query);
    $query = "SELECT * FROM `post` JOIN `postcat` ON post.post_id=postcat.post_id WHERE post.post_id=$postid";
    $re = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_array($re)) {
    $catid = $result['category_id'];
    $query = "UPDATE categorychart SET blogcount = blogcount - 1 WHERE category_id='$catid'";
    mysqli_query($conn, $query);
    }
    if ($_SESSION['loc']=='admin') {
        header("Location:adminpostmanage.php");
    } else {
        header("Location:yourpost.php");
    }
}

if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $postid = $_POST['editop'];
    $date = date('Y-m-d');
    $query = "UPDATE post SET statuspost='1', date='$date' WHERE post_id=$postid";
    mysqli_query($conn, $query);
    $query = "SELECT * FROM `post` JOIN `postcat` ON post.post_id=postcat.post_id WHERE post.post_id=$postid";
    $re = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_array($re)) {
    $catid = $result['category_id'];
    $query = "UPDATE categorychart SET blogcount = blogcount + 1 WHERE category_id='$catid'";
    mysqli_query($conn, $query);
    }
    if ($_SESSION['loc']=='admin') {
        header("Location:adminpostmanage.php");
    } else {
        header("Location:yourpost.php");
    }
}

if(isset($_POST['filter'])) {
    if ($_POST['filterop']!='0') {
        $catid = $_POST['filterop'];
        $pubnewpostlistq = "SELECT * FROM `postcat` JOIN `post` ON postcat.post_id=post.post_id JOIN `user` ON post.user_id=user.user_id WHERE category_id='$catid'";
        $postfil = mysqli_query($conn, $pubnewpostlistq);
    }
}

if (isset($_POST['search'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $searchpostlistq = $allpostlistq;
    $searchpostlistq .= " WHERE";
    if($_SESSION['loc'] == 'admin') {
        $searchpostlistq .= " title LIKE '%$input%'";
    } else {
        $searchpostlistq .= " post.user_id='$userid' AND title LIKE '%$input%'";
    }
    $postfil = mysqli_query($conn, $searchpostlistq);
    $check = mysqli_fetch_array($postfil);
    if (!isset($check)) {
        $msg = "no content found";
    }
}
?>