<?php
$postid = $_SESSION['postid'];
$pquery = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE post.post_id=$postid";
$catquery = "SELECT * FROM `postcat` JOIN `category` ON postcat.category_id=category.category_id WHERE postcat.post_id=$postid AND category.status='1'";
$category = mysqli_query($conn, $catquery);
$post = mysqli_query($conn, $pquery);
$prow = mysqli_fetch_array($post);
?>

<html>
    <h1>
    <?php
    echo $prow['title'];
    ?> </h1>
    <p style = "font-size:80%;"> <?php
    while ($crow = mysqli_fetch_array($category)) {
        echo $crow['categoryname']. " ";
    } ?> </p>
<body>
    <p1 style ="font-size:100%;">     
    <?php
    echo "By: ". $prow['fname']. " ". $prow['lname']. "<br> Published: ". $prow['date'];
    ?> </p1>
    <p3 style ="font-size:150%;"> 
    <?php
    echo $prow['content'];
    ?> </p3>
    <?php
    require("makecomment.php");
    ?>
    <p> <br> <?php
    while ($crow = mysqli_fetch_array($postcomment)) {
        echo " Comment by: <p>". $crow['fname']. " ". $crow['lname']. "<br>". $crow['title']. "<br>". $crow['content']. "</p>";
    } ?> </p>
</body>
</html>