<?php
session_start();
require("adminerror.php");
include("../connectionvar.php");
include("../postquery.php");
include("../categorylistquery.php");
$_SESSION['loc'] = 'admin';
$postlistq = $allpostlistq;
$postlistq .= " ORDER BY post_id ASC;";
$postfil = mysqli_query($conn, $postlistq) or exit('bad query');
require("../postop.php");
?>

<html>
<body>
    <?php require("adminnav.php"); ?>
    <h1> Admin - Manage Posts </h1>
    <?php
    require("../postsearch.php");
    require("../filtercat.php");
    ?>
    <table style = "border:6px solid black;">
        <tr>
            <th> Select </th>
            <th> ID </th>
            <th> Title </th>
            <th> Publish Status </th>
            <th> Publish Date </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($postfil)) {
            if ($row['statuspost']=='0') {
                $status = "unpublished";
            } elseif ($row['statuspost']=='1') {
                $status = "published";
            }
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['post_id']. "'> </td> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $status. "</td> <td>". $row['date']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'addpost' value = 'add post' >
    <input type = 'submit' name = 'editpost' value = 'edit post' >
    <input type = 'submit' name = 'status0' value = 'unpublish post' >
    <input type = 'submit' name = 'status1' value = 'publish post' > <br>
    </form>
</body>
</html>