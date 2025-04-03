<?php
session_start();
include("connectionvar.php");
include("queries.php");
$pubnewpostlistq = $pubpostlistq;
$postfil = $pubpostlist;
if(isset($_POST['filter'])) {
    if ($_POST['filterop']!='0') {
        $catid = $_POST['filterop'];
        $pubnewpostlistq = "SELECT * FROM `postcat` JOIN `post` ON postcat.post_id=post.post_id JOIN `user` ON post.user_id=user.user_id WHERE statuspost='1' AND category_id='$catid'";
        $postfil = mysqli_query($conn, $pubnewpostlistq);
    }
}

if (isset($_POST['viewop'])) {
    $_SESSION['postid'] = implode(",", $_POST['viewop']);
    header("Location:viewblog.php");
} else {
    $pubnewpostlistq .= " ORDER BY post.date DESC;";
    $result = mysqli_query($conn, $pubnewpostlistq);
}

if (isset($_POST['search'])) {
    $searchpostlistq = $pubpostlistq;
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    $searchpostlistq .= " AND title LIKE '%$input%'";
    $postfil = mysqli_query($conn, $searchpostlistq);
    $check = mysqli_fetch_array($postfil);
    if (!isset($check)) {
        $msg = "no content found";
    }
}
?>

<html>
<body>
    <?php include('navbar.php'); ?>
    <h1> Look at some of the most recent blogs! </h1> 
    <?php
    if (isset($msg)) {
        echo "$msg";
    }
    require("postsearch.php");
    require("filtercat.php");
    ?>
    <div> 
        <table style = "border:6px solid black;">
        <form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'> 
        <tr>
            <th> Select </th>
            <th> Title </th>
            <th> Username </th>
        </tr>
        <?php
        $c = 0;
        if (isset($searchpostlistq)) {
            $postfil = mysqli_query($conn, $searchpostlistq);
        }
        while ($row = mysqli_fetch_array($postfil) and $c < '10') {
            echo "<tr> <td> <button type ='submit' name ='viewop[]' value = '". $row['post_id']. "'>view</button> </td> <td>". $row['title']. "</td> <td>". $row['username']. "</td> </tr>";
            $c++;
        }
        ?>
        </table>
    </form> 
    </div>

    <div> 
    <?php 
    $x = 0;
    if (isset($searchpostlistq)) {
        $postfil = mysqli_query($conn, $searchpostlistq);
        $result = $postfil;
    }
    while ($rows = mysqli_fetch_array($result) and $x < '4') {
    $postid = $rows['post_id'];
    $_SESSION['postid'] = $rows['post_id'];
    require("viewblog.php"); 
    echo "<hr>";
    $x++;
    }?> </div>
</body>
</html>

