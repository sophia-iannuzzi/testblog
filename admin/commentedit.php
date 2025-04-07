<?php
session_start();
include '..\connectionvar.php';
require("adminerror.php");
$commentid = $_SESSION['commentid'];
if (isset($_POST['savebutton'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content =  mysqli_real_escape_string($conn, $_POST['content']);
    $query = "UPDATE comment SET comtitle='$title', comcontent='$content' WHERE comment_id='$commentid'";
    mysqli_query($conn, $query);
    header("Location:admincommentsmanage.php");
}
$query = "SELECT * FROM `comment` WHERE comment_id=$commentid";
$result = mysqli_query($conn, $query);
while ($rows = mysqli_fetch_array($result)) {
    $title = $rows['comtitle'];
    $content = $rows['comcontent'];
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
                        <h1 class="h3 mb-0 text-gray-800"> <br>Edit Comment:</h1>
                    </div>
                    <div class = 'container'>

                        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="row">
                            <div class="col-4 mt-5">
                                <span class="font-weight-bold">Title:</span>
                                <input class = "dropdown-header" type = 'text' name = 'title' value = '<?php echo "$title" ?>'> <br>
                            </div>
                            <div class="col-8 mt-5"><br>
                                <input type = 'submit' name = 'savebutton' value = 'save'>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4 mt-3">
                                <span class="font-weight-bold">Content:</span>
                                <textarea class="form-control" rows="3" name = 'content'><?php echo "$content" ?></textarea>
                            </div>
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