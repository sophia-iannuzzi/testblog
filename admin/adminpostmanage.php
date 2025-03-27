<?php
session_start();
include("..\connectionvar.php");
require("adminerror.php");
$query = "SELECT  * FROM `post` JOIN `user` ON post.user_id=user.user_id JOIN `category` ON post.category_id=category.category_id JOIN `status` ON post.status_id=status.status_id ORDER BY post_id ASC;";
$post = mysqli_query($conn, $query) or exit('bad query');
if (isset($_POST['addpost'])) {
    header ("Location:../addpost.php");
}
if (isset($_POST['editpost']) and isset($_POST['editop'])) {
    $_SESSION['postid'] = $_POST['editop'];
    header("Location:../editpost.php");
}
if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $postid = $_POST['editop'];
    $query = "UPDATE post SET status_id='1' WHERE post_id=$postid";
    mysqli_query($conn, $query);
    header("Location:adminpostmanage.php");
}
if (isset($_POST['status2']) and isset($_POST['editop'])) {
    $postid = $_POST['editop'];
    $date = date('Y-m-d');
    $query = "UPDATE post SET status_id='2', date='$date' WHERE post_id=$postid";
    mysqli_query($conn, $query);
    header("Location:adminpostmanage.php");
}
?>

<html>
<body>
    <?php require("adminnav.php"); ?>
    <h1> Admin - Manage Posts </h1>
    <table style = "border:6px solid black;">
        <tr>
            <th> Select </th>
            <th> ID </th>
            <th> Title </th>
            <th> Category </th>
            <th> Publish Status </th>
            <th> Publish Date </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($post)) {
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['post_id']. "'> </td> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['categoryname']. "</td> <td>". $row['status']. "</td> <td>". $row['date']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'addpost' value = 'add post' >
    <input type = 'submit' name = 'editpost' value = 'edit post' >
    <input type = 'submit' name = 'status1' value = 'unpublish post' >
    <input type = 'submit' name = 'status2' value = 'publish post' >
    </form>
</body>
</html>