<?php
session_start();
include("userlistquery.php");
if (isset($_POST['loginbutton'])) {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    if (!empty($username) and !empty($pwd)) {

        while ($row = mysqli_fetch_array($userlist)) {
            if ($row['username'] == $username) {
                if (password_verify($pwd, $row['hash'])) {
                    $_SESSION['levelid'] = $row['level_id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['userid'] = $row['user_id'];
                    header("Location:index.php");
                } else {
                    $msg = 'incorrect password';
                    break;
                }
            } else {
                $msg = 'incorrect username';
            }
        } 
    } else {
        $msg = 'please fill in all fields';
    }
}
if (isset($_POST['registerpage'])) {
    header("Location:blogregister.php");
    exit();
}
mysqli_close($conn);
?>

<html>
<body>
    <h1> Login into Blog </h1>
    <p> <?php 
    if(!empty($msg)) {
        echo "$msg";
    } ?> </p>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF'];?>">
    Username: <input type = 'text' name = 'username' > <br>
    Password: <input type = 'password' name = 'pwd' > <br>
    <input type = 'submit' name = 'loginbutton' value = 'login' > <br>
    <input type = 'submit' name = 'registerpage' value = 'register instead' >
    </form>
</body>
</html>