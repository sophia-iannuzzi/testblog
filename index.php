<?php
session_start();
if (!isset($_SESSION['levelid'])) {
    header("Location:bloglogin.php");
} else {
    include("postquery.php");
    $query .= " AND post.status='1'";
    $post = mysqli_query($conn, $query) or exit('bad query');
}
?>

<html>
<body>
    <?php require('navbar.php'); ?>
    <h1> Landing page <h1> 
    <table style = "border:6px solid black;">
    <form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'>
        <tr>
            <th> Select </th>
            <th> Title </th>
            <th> Username </th>
        </tr>
        <?php
        $c = 0;
        while ($row = mysqli_fetch_array($post) and $c < '10') {
            echo "<tr> <td> <input type ='radio' name ='viewop' value =". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['username']. "</td> </tr>";
            $c++;
        }
        ?>
    </table>
    </form>
</body>
</html>

