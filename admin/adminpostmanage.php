<?php
session_start();
require("adminerror.php");
include("../connectionvar.php");
include("../queries.php");
$_SESSION['loc'] = 'admin';
$postlistq = $allpostlistq;
$postlistq .= " GROUP BY post.post_id ORDER BY post.post_id ASC;";
$postfil = mysqli_query($conn, $postlistq) or exit('bad query');
require("../postop.php");
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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php
        require("adminsidebar.php");
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"> <br>Post Manage</h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Unpublished Posts
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php
                                                    $c = 0;
                                                    while($row = mysqli_fetch_array($unpostlist)) {
                                                        $c++;
                                                    }
                                                    echo $c;
                                                    ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class = "row">
                        <div class="col-xl-5 col-md-4 mb-2 mr-0">
                            <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                            <button class="btn-icon-split" type = 'submit' name = 'addpost'>
                                <span class="text">Add Post</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'editpost'>
                                <span class="text">Edit Post</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status0'>
                                <span class="text">Unpublish Post</span>
                            </button>
                            <button class="btn-icon-split" type = 'submit' name = 'status1'>
                                <span class="text">Publish Post</span>
                            </button>
                        </div>

                        <div class="col-xl-2 col-md-3 mb-2 mr-2">
                            <input class = "dropdown-header" type = 'text' name = 'input' placeholder = 'search titles'>
                        </div>

                        <div class="col-xl-1 col-md-3 mb-2 mr-2">
                            <button class="btn-icon-split" type = 'submit' name = 'search'>
                            <span class="text">Search</span>
                            </button>
                        </div>

                        <div class="col-xl-1 col-md-3 mb-2 mr-2">
                            <select class = "dropdown" name = 'filterop'>
                                <option class = "dropdown-header" value = '0'>all</option>
                                <?php
                                while ($row = mysqli_fetch_array($categories)) {
                                    echo "<option class = 'dropdown-header' value = '". $row['category_id']. "'>". $row['categoryname']. "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-xl-2 col-md-3 mb-2">
                            <button class="btn-icon-split" type = 'submit' name = 'filter'>
                                <span class="text">Filter by Category</span>
                            </button>
                        </div>
                        
                    </div>
                                                    
                    <div class="col-xl-12 col-md-12 mb-4">
                        <table class = 'table'>
                            <tr>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Select </th>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> ID </th>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Title </th>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Category </th>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Publish Status </th>
                                <th class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> Publish Date </th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_array($postfil)) {
                                if ($row['statuspost']=='0') {
                                    $status = "unpublished";
                                } elseif ($row['statuspost']=='1') {
                                    $status = "published";
                                }
                                echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['post_id']. "'> </td> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>". $row['categoryname']. "</td> <td>". $status. "</td> <td>". $row['date']. "</td> </tr>";
                            }
                            ?>
                        </table>
                    </div>

                </form>
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>


