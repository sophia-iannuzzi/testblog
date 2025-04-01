<?php
session_start();
include("connectionvar.php");
include("postquery.php");

if (!isset($_SESSION['levelid'])) {
    header("Location:bloglogin.php");
}
if (isset($_POST['viewop'])) {
    $_SESSION['postid'] = implode(",", $_POST['viewop']);
    header("Location:viewblog.php");
} else {
    $pubnewpostlistq = $pubpostlistq;
    $pubnewpostlistq .= " ORDER BY post.date DESC;";
    $result = mysqli_query($conn, $pubnewpostlistq);
    $rows = mysqli_fetch_array($result);
    $postid = $rows['post_id'];
    $_SESSION['postid'] = $rows['post_id'];
}
?>

<html>
<style>
</style>
<body>
    <?php include('navbar.php'); ?>
    <h1> Landing page </h1> 
    <div> <table style = "border:6px solid black;">
    <form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'>
        <tr>
            <th> Select </th>
            <th> Title </th>
            <th> Username </th>
        </tr>
        <?php
        $c = 0;
        while ($row = mysqli_fetch_array($pubpostlist) and $c < '10') {
            echo "<tr> <td> <button type ='submit' name ='viewop[]' value = '". $row['post_id']. "'>view</button> </td> <td>". $row['title']. "</td> <td>". $row['username']. "</td> </tr>";
            $c++;
        }
        ?>
    </table>
    </form> </div>
    <div> <?php require("viewblog.php"); ?> </div>
</body>
</html>

