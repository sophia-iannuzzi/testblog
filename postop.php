<?php
$userid = $_SESSION['userid'];
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
    if ($_SESSION['loc']=='admin') {

        if ($_POST['filterop']!='0') {
            $catid = $_POST['filterop'];
            $allpostq = $allpostlistq;
            $allpostq .= " WHERE category.category_id='$catid'";
            $postfil = mysqli_query($conn, $allpostq);
        }
    } elseif ($_SESSION['loc']=='yourpost') {
        if ($_POST['filterop']!='0') {
            $catid = $_POST['filterop'];
            $allpostq = $allpostlistq;
            $allpostq .= " WHERE post.user_id='$userid' AND category.category_id='$catid'";
            $postfil = mysqli_query($conn, $allpostq);
        }
    }
}

if (isset($_POST['search'])) {
    $userid = $_SESSION['userid'];
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $searchpostlistq = $allpostlistq;
    if(!empty($input)) {
        $searchpostlistq .= " WHERE";
        if($_SESSION['loc'] == 'admin') {
            $searchpostlistq .= " titlepost LIKE '%$input%'";
        } elseif ($_SESSION['loc'] == 'yourpost') {
            $searchpostlistq .= " post.user_id='$userid' AND titlepost LIKE '%$input%'";
        } else {
            $searchpostlistq .= " statuspost='1' AND titlepost LIKE '%$input%'";
        }
        $postfil = mysqli_query($conn, $searchpostlistq);
    }
}
?>