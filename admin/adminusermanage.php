<?php
session_start();
include("..\query/userlistquery.php");
if ($_SESSION['levelid']!='2') {
    header("Location:..\index.php");
}
if (isset($_POST['edituser']) and isset($_POST['editop'])) {
    // header("Location:")
// unfinished
}
?>

<html>
<body>
    <?php require("adminnav.php"); ?>
    <h1> Admin - Manage Users </h1>
    <table style = "border:6px solid black;">
        <tr>
            <th> Select </th>
            <th> ID </th>
            <th> First Name </th>
            <th> Last Name </th>
            <th> Username </th>
            <th> Level </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($userlist)) {
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['user_id']. "'> </td> <td>". $row['user_id']. "</td> <td>". $row['fname']. "</td> <td>". $row['lname']. "</td> <td>". $row['username']. "</td> <td>". $row['levelname']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'edituser' value = 'edit user' >
    </form>
</body>
</html>