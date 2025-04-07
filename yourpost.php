<?php
session_start();
$_SESSION['loc'] ='yourpost';
if (!isset($_SESSION['levelid'])) {
    header("Location:bloglogout.php");
}
include("connectionvar.php");
include("queries.php");
$userid = $_SESSION['userid'];
$searchpostlistq = $allpostlistq;
$searchpostlistq .= " WHERE post.user_id='$userid' GROUP BY post.post_id ASC;";
$postfil = mysqli_query($conn, $searchpostlistq) or exit('bad query');
require("postop.php");
?>

<html>
    <?php require("navbar.php"); ?>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
        <link href="css/blog.css" rel="stylesheet">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>
    <div class="p-4 p-md-3 mb-2 rounded text-body-emphasis bg-primary">
        <blockquote class="blockquote text-center">
            <h1 class = "p-3"> Your Posts! </h1>
        </blockquote>
    </div>
    <?php
    if (isset($msg)) {
        echo "$msg";
    }
    ?>
<table class = "table">
        <tr>
            <th> Select </th>
            <th> ID </th>
            <th> Title </th>
            <th> Category </th>
            <th> Publish Status </th>
            <th> Publish Date </th>
        </tr>
        <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">

        <div class="col-xl-5 col-md-4 mb-2 px-3">
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
        <?php
        require("postsearchfil.php");
        while ($row = mysqli_fetch_array($postfil)) {
            $postid = $row['post_id'];
            $query = "SELECT * FROM `postcat` JOIN `category` ON postcat.category_id=category.category_id WHERE postcat.post_id=$postid";
            $categories = mysqli_query($conn, $query);
            $cat = [];
            if ($row['statuspost']=='0') {
                $status = "unpublished";
            } elseif ($row['statuspost']=='1') {
                $status = "published";
            }
            while($rows=mysqli_fetch_array($categories)) {
                $cat[]=$rows['categoryname'];
            }
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['post_id']. "'> </td> <td>". $row['post_id']. "</td> <td>". $row['titlepost']. "</td> <td>";
            foreach ($cat as $category) {
                echo $category. "/";
            }
            echo "</td> <td>". $status. "</td> <td>". $row['date']. "</td> </tr>";
        }
        ?>
    </table>
    </form>
</body>
</html>