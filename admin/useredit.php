<?php
session_start();
include("../connectionvar.php");
include("../queries.php");
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
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

    <?php
        require("adminsidebar.php");
    ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> <br>Editing user:
                    <?php
                    echo "<span class='font-weight-bold'>". $usereid. " - ". $username. "</span>";
                    ?>
                    </h1>
                    </div>
                    <div class = 'container'>

                        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="row">
                            <div class="col-4 mt-5">
                                <span class="font-weight-bold">First Name:</span>
                                <input class = "dropdown-header" type = 'text' name = 'fname' value = '<?php echo "$fname" ?>'> <br>
                            </div>
                            <div class="col-8 mt-5"><br>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <span class="font-weight-bold">Last Name:</span>
                                <input class = "dropdown-header" type = 'text' name = 'lname' value = '<?php echo "$lname" ?>'> <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <span class="font-weight-bold">Username:</span>
                                <input class = "dropdown-header" type = 'text' name = 'username' value = '<?php echo "$username" ?>'> <br>
                                </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>




    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

    <script src="vendor/chart.js/Chart.min.js"></script>


    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>


