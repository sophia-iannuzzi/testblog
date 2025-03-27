<?php
include 'userlistquery.php';
if (isset($_POST['registerbutton'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $hashpwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
    if (!empty($email) and !empty($hashpwd) and !empty($fname) and !empty($email)) {
        if($username==$_POST['pwd']) {
            $msg = "Username and password cannot be the same";
        } else {
            while ($row = mysqli_fetch_array($userlist)) {
                if ($username == $row['username']) {
                   $msg ='username taken';
                    break;
                }
            }
            if (!isset($msg)) {
                $result=$conn->prepare("INSERT INTO `user` (`fname`, `lname`, `email`, `username`, `hash`,`level_id`) value (?, ?, ?, ?, ?, '1')");
                $result->bind_param("sssss", $fname, $lname, $email, $username, $hashpwd);
                $result->execute();
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
    Enter Email: <input type = 'text' name = 'email' > <br>
    Enter Username: <input type = 'text' name = 'username' > <br>
    Enter Password: <input type = 'password' name = 'pwd' > <br>
    <input type = 'submit' name = 'registerbutton' value = 'register' > <br>
    <input type = 'submit' name = 'loginpage' value = 'login instead' > 
    </form>
</body>
</html>