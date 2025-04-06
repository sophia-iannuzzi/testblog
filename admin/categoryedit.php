<?php
session_start();
include '..\connectionvar.php';
require("adminerror.php");
$categoryid = $_SESSION['categoryid'];

if (isset($_POST['savebutton'])) {
    $categoryname = mysqli_real_escape_string($conn, $_POST['categoryname']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $query = "UPDATE category SET categoryname='$categoryname', description='$description' WHERE category_id=$categoryid";
    mysqli_query($conn, $query);
    header("Location:admincategoriesmanage.php");
}

$query = "SELECT * FROM `category` WHERE category_id=$categoryid";
$result = mysqli_query($conn, $query);
while ($rows = mysqli_fetch_array($result)) {
    $categoryname = $rows['categoryname'];
    $description = $rows['description'];
}
?>

<html>
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
                        <h1 class="h3 mb-0 text-gray-800"> <br>Edit Category</h1>
                    </div>
                    <div class = 'container'>

                        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="row">
                            <div class="col-4 mt-5">
                                <span class="font-weight-bold">Category Name:</span>
                                <input class = "dropdown-header" type = 'text' name = 'categoryname' value = '<?php echo "$categoryname" ?>'> <br>
                            </div>
                            <div class="col-8 mt-5"><br>
                                <input type = 'submit' name = 'savebutton' value = 'save'>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <span class="font-weight-bold">Description:</span>
                                <textarea class="form-control" rows="3" name = 'description'><?php echo "$description" ?></textarea>
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