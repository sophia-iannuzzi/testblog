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

<?php
require("navbar.php");
if (isset($msg)) {
    echo "$msg";
}
?>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
        <link href="css/blog.css" rel="stylesheet">
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<body>

            <h1> Your Posts! </h1>

                <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class = 'row'>
                        <div class="col-xl-5 col-md-4 mb-2 mr-0">
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
                            ?>
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
                                            $postid = $row['post_id'];
                                            $query = "SELECT * FROM `postcat` JOIN `category` ON postcat.category_id=category.category_id WHERE postcat.post_id=$postid";
                                            $categories = mysqli_query($conn, $query);
                                            $cat = [];
                                            while($rows=mysqli_fetch_array($categories)) {
                                                $cat[]=$rows['categoryname'];
                                            }
                                            if ($row['statuspost']=='0') {
                                                $status = "unpublished";
                                            } elseif ($row['statuspost']=='1') {
                                                $status = "published";
                                            }
                                            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['post_id']. "'> </td> <td>". $row['post_id']. "</td> <td>". $row['title']. "</td> <td>";
                                            foreach ($cat as $category) {
                                                echo $category. "/";
                                            }
                                            echo "</td> <td>". $status. "</td> <td>". $row['date']. "</td> </tr>";
                                        }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>


</body>
</html>