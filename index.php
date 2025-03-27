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
$query .= ";";
$post = mysqli_query($conn, $query) or exit('bad query');
}
?>

<html>
<body>
    <?php require('navbar.php'); ?>
    <h1> Landing page <h1>
        <form method = 'GET' action = '<?php $_SERVER['PHP_SELF'];?>'>
            <input type = 'text' name = 'usersearch' >
            <input type = 'submit' name = 'searchbutton' value = 'search' >
        </form>
    <table style = "border:6px solid black;">
        <tr>
            <th> ID </th>
            <th> Title YAYAY </th>
            <th> Category </th>
            <th> Username </th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($post)) {
            echo "<tr> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['categoryname']. "</td> <td>". $row['username']. "</td> </tr>";
        }
        ?>
    </table>
</body>
</html>

