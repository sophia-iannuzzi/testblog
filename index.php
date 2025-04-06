<?php
session_start();
include("connectionvar.php");
include("queries.php");
$postfil = $pubpostlist;
if(isset($_POST['filter'])) {
    if ($_POST['filterop']!='0') {
        $catid = $_POST['filterop'];
        $pubpostcatq = "SELECT * FROM `postcat` JOIN `post` ON postcat.post_id=post.post_id JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1' AND category_id='$catid'";
        $postfil = mysqli_query($conn, $pubpostcatq);
    }
}

if (isset($_POST['viewop'])) {
    $_SESSION['postid'] = implode(",", $_POST['viewop']);
    header("Location:viewblog.php");
}

if (isset($_POST['search'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $filterq = "SELECT * FROM `post` JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1' AND title LIKE '%$input%' ORDER BY date DESC";
    $postfil = mysqli_query($conn, $filterq);
}
?>

<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
        <link href="css/blog.css" rel="stylesheet">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">    </head>
    </head>
<body>

    <?php include('navbar.php'); ?>

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-primary">
        <blockquote class="blockquote text-center">
            <div class = 'row'>
                <div class="col-lg-6 mx-4 pl-5 px-0">
                    <h1 class="display-4">Welcome to <em> Farming Love! </em></h1>
                    <p class="lead my-3">Explore content about the many aspects of farming! Such as: animal and argriculture farming, tools and equipment, and the joys of it all!</p>
                </div>
                <div class="col-lg-4 px-0">
                <i class="fas fa-tractor fa-10x"></i>
                </div>
            </div>
        </blockquote>
    </div>

    <h1 class = 'p-3'> Enjoy some blogs! </h1> 
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        if (isset($msg)) {
            echo "$msg";
        }
        require("postsearchfil.php");
        ?>
        <div class="row mb-2 p-3">
        <?php
        while ($rows = mysqli_fetch_array($postfil)) {
            $postid = $rows['post_id'];
            require("postroll.php");
        }    
        ?>
        </div>
    </form>
</body>
</html>