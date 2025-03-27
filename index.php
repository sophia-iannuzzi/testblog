<?php
session_start();
include 'connectionvar.php';
if (!isset($_SESSION['levelid'])) {
    header("Location:bloglogin.php");
} else {
$query = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id JOIN `category` ON post.category_id=category.category_id WHERE status_id='2'";
if (isset($_GET['usersearch'])) {
    $query .= " AND categoryname='" .$_GET['usersearch']. "'";
}
if (isset($_GET['reset'])) {
    $query = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id JOIN `category` ON post.category_id=category.category_id WHERE status_id='2'";
}
$query .= ";";
$post = mysqli_query($conn, $query) or exit('bad query');
}
?>

<html>
<body>
    <?php require('navbar.php'); ?>
    <h1> Landing page <h1> 
    <?php
    $row = mysqli_fetch_array($post);
    echo "<p>". $row['fname']. " ". $row['lname']. "</p>";
    ?>
        <form method = 'GET' action = '<?php $_SERVER['PHP_SELF'];?>'>
            <input type = 'text' name = 'usersearch' value = 'search by category' >
            <input type = 'submit' name = 'searchbutton' value = 'search' >
            <input type = 'submit' name = 'reset' value = 'all' >
        </form>
    <table style = "border:6px solid black;">
        <tr>
            <th> ID </th>
            <th> Title </th>
            <th> Category </th>
            <th> Username </th>
        </tr>
        <?php
        $c = 0;
        while ($row = mysqli_fetch_array($post) and $c < '10') {
            echo "<tr> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['categoryname']. "</td> <td>". $row['username']. "</td> </tr>";
            $c++;
        }
        ?>
    </table>
</body>
</html>

