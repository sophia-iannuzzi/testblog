<?php
session_start();
include("../connectionvar.php");
include("../queries.php");
require("adminerror.php");
if (isset($_POST['editcategory']) and isset($_POST['editop'])) {
    $_SESSION['categoryid'] = $_POST['editop'];
    header("Location:categoryedit.php");
}
if (isset($_POST['addcategory'])) {
    unset($_SESSION['categoryid']);
    header("Location:categoryadd.php");
}
if (isset($_POST['status0']) and isset($_POST['editop'])) {
    $categoryid = $_POST['editop'];
    $query = "UPDATE category SET status='0' WHERE category_id=$categoryid";
    mysqli_query($conn, $query);
    header("Location:admincategoriesmanage.php");
}
if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $categoryid = $_POST['editop'];
    $date = date('Y-m-d');
    $query = "UPDATE category SET status='1' WHERE category_id=$categoryid";
    mysqli_query($conn, $query);
    header("Location:admincategoriesmanage.php");
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
                        <h1 class="h3 mb-0 text-gray-800"> <br>Post Manage</h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Unpublished Categories
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $c = 0;
                                            while($row = mysqli_fetch_array($unpubcategory)) {
                                                $c++;
                                            }
                                            echo $c;
                                            ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class = "row">
                        <div class="col-xl-6 col-md-4 mb-4">
                            <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button class="btn-icon-split" type = 'submit' name = 'addcategory'>
                                <span class="text">Add Category</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'editcategory'>
                                <span class="text">Edit Category</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status0'>
                                <span class="text">Unpublish Category</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status1'>
                                <span class="text">Publish Category</span>
                            </button>
                        </div>
                        
                    </div>

                    <div class="col-xl-12 col-md-12 mb-4">
                        <table class="table">
                            <tr> 
                            <th> Select </th>    
                            <th> ID </th>
                            <th> Category </th>
                            <th> Publish Status </th>
                            <th> Description </th>
                            </tr>
                        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                            <?php
                            while ($row = mysqli_fetch_array($categories)) {
                                if ($row['status']=='0') {
                                    $status = "unpublished";
                                } else {
                                    $status = "published";
                                }
                                echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['category_id']. "'> </td> <td>". $row['category_id']. "</td> <td>". $row['categoryname']. "</td> <td>". $status. "</td> <td>". $row['description']. "</td> </tr>";
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


