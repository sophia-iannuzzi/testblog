<?php
session_start();
include("../connectionvar.php");
include("../userlistquery.php");
require("adminerror.php");
if (isset($_SESSION['usereid'])) {
    $usereid = $_SESSION['usereid'];
}
$query = "SELECT * FROM `user` JOIN `level` ON user.level_id=level.level_id WHERE user_id=$usereid";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $levelid = $row['level_id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $username = $row['username'];
}
if (isset($_POST['savebutton'])) {
    $fnamenew = mysqli_real_escape_string($conn, $_POST['fname']);
    $lnamenew = mysqli_real_escape_string($conn, $_POST['lname']);
    $usernamenew = mysqli_real_escape_string($conn, $_POST['username']);
    $levelid = $_POST['levelop'];
    if (!empty($fnamenew) and !empty($lnamenew) and !empty($usernamenew)) {
        if ($usernamenew != $username) {
            while ($row = mysqli_fetch_array($userlist)) {
                if ($usernamenew==$row['username']) {
                    $msg = "username taken";
                    break;
                }
            }
        } 
        if (!isset($msg)) {
            $query = "UPDATE user SET fname = '$fnamenew', lname = '$lnamenew', username = '$usernamenew', level_id='$levelid' WHERE user_id='$usereid'";
            mysqli_query($conn, $query);
            header("Location:adminusermanage.php");
        }
    } else {
        $msg = "please fill in fields";
    }
}
?>

<html>
<body>
<?php require("adminnav.php"); ?> <br>
<?php
if (isset($msg)) {
    echo "$msg";
} ?>
    <form method = 'POST' action = '<?php echo $_SERVER['PHP_SELF'];?>'>
    First Name: <input type = 'text' name = 'fname' value = '<?php echo "$fname" ?>'> <br>
    Last Name: <input type = 'text' name = 'lname' value = '<?php echo "$lname" ?>'> <br>
    Username: <input type = 'text' name = 'username' value = '<?php echo "$username" ?>'> <br>
    <select name = 'levelop'>
        <?php 
        if ($levelid=='1') {
            echo "<option value ='1'>author</option> <option value ='2'>admin</option>";
        } else {
            echo "<option value ='2'>admin</option> <option value ='1'>author</option>";
        }
        ?>
    </select>
    <input type = 'submit' name = 'savebutton' value = 'save'>
    </form>
</body>
</html>