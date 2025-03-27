<?php
session_start();
include "connectionvar.php";
if (isset($_POST['submitbutton'])) {
    $title = $_POST['title'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $content = $_POST['content'];
    $date = date('Y-m-d');
    if (empty($title) and empty($fname) and empty($lname) and empty($content)) {
        $query = "INSERT INTO `comment` (`post_id`, `fname`, `lname`, `title`, `content`, `date`) VALUE ('$postid', '$fname', '$lname', '$title', '$content', '$date')";
        mysqli_query($conn, $query);
    } else {
        $msg = "please fill in all fields";
    }
}
?>

<html>
<body>
    <?php
    if ($_SESSION['userid']=='2') {
        require ('adminnav.php');
    } else {
        require ('navbar.php');
    }
    ?>
    <h1> Make a comment! </h1>
    <p> <?php 
    if (isset($msg)) {
        echo "$msg";
    } ?>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    Title:<input type = 'text' name = 'title'> <br>
    First Name:<input type = 'text' name = 'fname'> <br>
    Last Name:<input type = 'text' name = 'lname'> <br>
    Comment:<textarea id = 'content' name = 'content'> </textarea> <br>
    <input type = 'submit' name = 'submitbutton' value = 'submit' >
    </form>
</body>
</html>