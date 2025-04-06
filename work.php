<?php
session_start();
include("connectionvar.php");
include("queries.php");
$postfil = $pubpostlist;
if(isset($_POST['filter'])) {
    if ($_POST['filterop']!='0') {
        $catid = $_POST['filterop'];
        $pubpostcatq = "SELECT * FROM `postcat` JOIN `post` ON postcat.post_id=post.post_id JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1' AND category_id='$catid'";
        $postfil = mysqli_query($conn, $pubpostcatq);
    }
}

if (isset($_POST['viewop'])) {
    $_SESSION['postid'] = implode(",", $_POST['viewop']);
    header("Location:viewblog.php");
}

if (isset($_POST['search'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $filterq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1' AND title LIKE '%$input%' ORDER BY date DESC";
    $postfil = mysqli_query($conn, $filterq);
}
?>

<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
        <link href="css/blog.css" rel="stylesheet">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <?php include('navbar.php'); ?>
    <h1> Look at some of the most recent blogs! </h1> 
    <?php
    if (isset($msg)) {
        echo "$msg";
    }
    require("postsearchfil.php");
    require("filtercat.php");
    ?>
<div class="row mb-2">
<?php
while ($rows = mysqli_fetch_array($postfil)) {
    $postid = $rows['post_id'];
    require("postroll.php");
}    
?>
</div>
</body>
</html>

