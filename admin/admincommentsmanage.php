<?php
session_start();
include("..\connectionvar.php");
$query = "SELECT  * FROM `comment`";
$comment = mysqli_query($conn, $query) or exit('bad query');
if (isset($_POST['editcomment']) and isset($_POST['editop'])) {
    $_SESSION['commentid'] = $_POST['editop'];
    header("Location:commentedit.php");
}
?>

<html>
<body>
    <?php require("adminnav.php"); ?>
    <h1> Admin - Manage Comments </h1>
    <table style = "border:6px solid black;">
        <tr>
        <th> Select </th>    
        <th> ID </th>
        <th> Title </th>
        <th> Comment </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($comment)) {
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['comment_id']. "'> </td> <td>". $row['comment_id']. "</td> <td>". $row['title']. "</td> <td>". $row['content']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'editcomment' value = 'edit comment' >
    </form>
</body>
</html>