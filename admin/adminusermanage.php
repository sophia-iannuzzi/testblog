<?php
session_start();
include("../connectionvar.php");
include("../queries.php");
require("adminerror.php");
if (isset($_POST['edituser']) and isset($_POST['editop'])) {
    $_SESSION['usereid'] = $_POST['editop'];
    header("Location:useredit.php");
}
if (isset($_POST['status0']) and isset($_POST['editop'])) {
    $usereid = $_POST['editop'];
    $query = "UPDATE user SET statususer='0' WHERE user_id='$usereid'";
    mysqli_query($conn, $query);
    header("Location:adminusermanage.php");
}
if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $usereid = $_POST['editop'];
    $query = "UPDATE user SET statususer='1' WHERE user_id='$usereid'";
    echo $query;
    mysqli_query($conn, $query);
    header("Location:adminusermanage.php");
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
            <th> Status </th>
            <th> Level </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($userlist)) {
            if ($row['statususer']=='0') {
                $status = "deactive";
            } else {
                $status = "active";
            }
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['user_id']. "'> </td> <td>". $row['user_id']. "</td> <td>". $row['fname']. "</td> <td>". $row['lname']. "</td> <td>". $row['username']. "</td> <td>". $status. "</td> <td>". $row['levelname']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'edituser' value = 'edit user' >
    <input type = 'submit' name = 'status0' value = 'Deactivate user' >
    <input type = 'submit' name = 'status1' value = 'Activate user' >
    </form>
</body>
</html>