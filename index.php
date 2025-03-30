<?php
session_start();
include("connectionvar.php");
if (!isset($_SESSION['levelid'])) {
    header("Location:bloglogin.php");
}
$pubnewpostlistq = $pubpostlistq;
$pubnewpostlistq .= " ORDER BY post.date DESC;";
$result = mysqli_query($conn, $pubnewpostlistq);
$rows = mysqli_fetch_array($result);
$newpostid = $rows['post_id'];
?>

<html>
<body>
    <?php require('navbar.php'); ?>
    <h1> Landing page <h1> 
    <?php require("viewblog.php"); ?>
    <table style = "border:6px solid black;">
    <form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'>
        <tr>
            <th> Select </th>
            <th> Title </th>
            <th> Username </th>
        </tr>
        <?php
        $c = 0;
        while ($row = mysqli_fetch_array($pubpostlist) and $c < '10') {
            echo "<tr> <td> <input type ='radio' name ='viewop' value =". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['username']. "</td> </tr>";
            $c++;
        }
        ?>
    </table>
    </form>
</body>
</html>

