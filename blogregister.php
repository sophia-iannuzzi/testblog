<?php
include("connectionvar.php");
include("queries.php");
if (isset($_POST['registerbutton'])) {
    $fname = mysqli_real_escape_string($conn,$_POST['fname']);
    $lname = mysqli_real_escape_string($conn,$_POST['lname']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
    if (!empty($email) and !empty($hashpwd) and !empty($fname) and !empty($email)) {
        if($username==$pwd) {
            $msg = "Username and password cannot be the same";
        } else {
            while ($row = mysqli_fetch_array($userlist)) {
                if ($username == $row['username']) {
                   $msg ='username taken';
                    break;
                }
            }
            if (!isset($msg)) {
                $query = "INSERT INTO `user` (`fname`, `lname`, `username`, `hash`,`level_id`) value ('$fname', '$lname', '$username', '$hashpwd', '1')";
                mysqli_query($conn, $query);
                $monthid = date('n');
                $year = date('Y');
                $query = "SELECT * FROM `registerchart`";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_array($result)) {
                    if($monthid==$row['month_id'] and $monthid==$row['year']) {
                        $query = "UPDATE registerchart SET registercount = registercount + 1 WHERE month_id='$monthid' AND year='$year'";
                        mysqli_query($conn, $query);
                        $msg = 'registered';
                    }
                }
                if (!isset($msg)) {
                    $query = "INSERT INTO `registerchart` (`month_id`, `year`, `registercount`) VALUE ('$monthid', '$year', '1')";
                    mysqli_query($conn, $query);
                }
                $msg = 'registered';
            }
        }
    } else {
        $msg = 'please fill in all fields';
    }
}
if (isset($_POST['loginpage'])) {
    header("Location:bloglogin.php");
    exit();
}
?> 

<html>
<body>
    <h1> Register to Blog </h1>
    <p> <?php 
    if (!empty($msg)) {
        echo "$msg";
    } ?> </p>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    Enter First Name: <input type = 'text' name = 'fname' > <br>
    Enter Last Name: <input type = 'text' name = 'lname' > <br>
    Enter Username: <input type = 'text' name = 'username' > <br>
    Enter Password: <input type = 'password' name = 'pwd' > <br>
    <input type = 'submit' name = 'registerbutton' value = 'register' > <br>
    <input type = 'submit' name = 'loginpage' value = 'login instead' > 
    </form>
</body>
</html>