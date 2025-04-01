<?php
if (isset($_POST['submitbutton'])) {
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $content = $_POST['content'];
    $date = date('Y-m-d');
    if (!empty($title) and !empty($fname) and !empty($lname) and !empty($content)) {
        $query = "INSERT INTO `comment` (`post_id`, `fname`, `lname`, `title`, `content`, `status`, `date`) VALUE ('$postid', '$fname', '$lname', '$title', '$content', '1', '$date')";
        mysqli_query($conn, $query);
    } else {
        $msg = "please fill in all fields";
    }
}
?>

<html>
<body>
    <h1> Cast a comment! </h1>
    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">
    <p> <?php
    if (!empty($msg)) {
        echo "$msg";
    } ?> </p>
    Title: <input type = 'text' name = 'title'> <br>
    First Name: <input type = 'text' name = 'fname'> <br>
    Last Name: <input type = 'text' name = 'lname'> <br>
    Comment: <textarea name = 'content'></textarea> <br>
    <input type = 'submit' name = 'submitbutton' value = 'comment'>
</body>
</html>