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

<!DOCTYPE html>
<html lang="en">
<?php
if (isset($msg)) {
    echo "$msg";
}?>
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
                        <h1 class="h3 mb-0 text-gray-800"> <br>Users Manage</h1>
                    </div>

                    <div class = "row">
                        <div class="col-xl-6 col-md-4 mb-4">
                            <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button class="btn-icon-split" type = 'submit' name = 'edituser'>
                                <span class="text">Edit User</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status0'>
                                <span class="text">Deactivate User</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status1'>
                                <span class="text">Activate User</span>
                            </button>
                        </div>
                        
                    </div>

                    <div class="col-xl-12 col-md-12 mb-4">
                        <table class="table">
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
                    </div>

                </form>
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


