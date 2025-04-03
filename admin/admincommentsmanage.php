<?php
session_start();
include("..\connectionvar.php");
include("..\queries.php");
require("adminerror.php");
$editallcommentq = $allcommentq;
$editallcommentq .= " ORDER BY comment.post_id ASC";
$comments = mysqli_query($conn, $editallcommentq);
if (isset($_POST['editcomment']) and isset($_POST['editop'])) {
    $_SESSION['commentid'] = $_POST['editop'];
    header("Location:commentedit.php");
}
if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $commentid = $_POST['editop'];
    $query = "UPDATE comment SET status='0' WHERE comment_id=$commentid";
    mysqli_query($conn, $query);
    header("Location:admincommentsmanage.php");
}
if (isset($_POST['status2']) and isset($_POST['editop'])) {
    $commentid = $_POST['editop'];
    $date = date('Y-m-d');
    $query = "UPDATE comment SET status='1' WHERE comment_id=$commentid";
    mysqli_query($conn, $query);
    header("Location:admincommentsmanage.php");
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
        <th> Post ID </th>
        <th> Title </th>
        <th> Publish Status </th>
        <th> Comment </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($comments)) {
            if ($row['status']=='0') {
                $status = "unpublished";
            } else {
                $status = "published";
            }
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['comment_id']. "'> </td> <td>". $row['comment_id']. "</td> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $status. "</td> <td>". $row['comcontent']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'editcomment' value = 'edit comment' >
    <input type = 'submit' name = 'status1' value = 'unpublish comment' >
    <input type = 'submit' name = 'status2' value = 'publish comment' >
    </form>
</body>
</html>