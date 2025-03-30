<?php
$query = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE `post_id`=$newpostid";
$post = mysqli_query($conn, $query);
$row = mysqli_fetch_array($post);
?>

<html>
<body>
    <h1>
    <?php
    echo $row['title'];
    ?> </h1>
    <p1>     
    <?php
    echo $row['fname']. " ". $row['lname']. "<br>". $row['date'];
    ?> </p1>
    <p3> 
    <?php
    echo $row['content'];
    ?> </p3>
</body>
</html>