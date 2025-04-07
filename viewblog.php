<?php
if (!isset($conn)) {
    include("connectionvar.php");
    session_start();
    $location = '1';
}
include("queries.php");
include("queries.php");
include("queries.php");
$postid = $_SESSION['postid'];
$pquery = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE post.post_id=$postid";
$catquery = "SELECT * FROM `postcat` JOIN `category` ON postcat.category_id=category.category_id WHERE postcat.post_id=$postid AND category.status='1'";
$category = mysqli_query($conn, $catquery);
$post = mysqli_query($conn, $pquery);
$prow = mysqli_fetch_array($post);
?>

<html>
<?php 
if (isset($_SESSION['levelid'])) {
    include('navbar.php'); 
} ?>
<head>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">    </head>
</head>
<main class="container">
<article class="blog-post">
    <div class="mx-auto" style="width: 700px;">
        <h2 class="display-5 link-body-emphasis mb-1">
        <?php
        echo $prow['titlepost'];
        ?> </h2>
        <p style = "font-size:80%;"> <?php
        while ($crow = mysqli_fetch_array($category)) {
            echo " | ". $crow['categoryname']. " | ";
        } ?>
    </div>
    <div class ='row py-3'>
        <div class = "col-xl-2 col-md-6">
            <p class="blog-post-meta">
            <?php
            echo "By: ". $prow['fname']. " ". $prow['lname'];
            ?> 
            </p>
        </div>
        <div class = "col">
            <p class="blog-post-meta">
            <?php
            echo "Published: ". $prow['date'];
            ?> 
            </p>
        </div>
        <div class="w-100"></div>
    </div>
    <p style ="font-size:150%">
    <?php
    echo $prow['content'];
    ?> 
    </p>
</article>
<hr></hr>
<div class="mx-5" style="width: 500px;">
    <?php
    require("makecomment.php");
    ?>
</div>
<hr></hr>
<div class="mx-5" style="width: 500px;">
    <?php
    while ($crow = mysqli_fetch_array($postcomment)) {
        echo "<p class='blog-post-meta'> Comment by: ". $crow['fname']. " ". $crow['lname']. "</p>";
        echo $crow['comtitle']. "<p>". $crow['comcontent']. "</p>";
    }
    ?>
</div>
</main>
</html>