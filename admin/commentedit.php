<?php
session_start();
include '..\connectionvar.php';
if ($_SESSION['levelid']!='2') {
    header("Location:..\index.php");
}
$commentid = $_SESSION['commentid'];
if (isset($_POST['savebutton'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $result = $conn->prepare("UPDATE comment SET title=?, content=? WHERE comment_id=?");
    $result->bind_param("ssi", $title, $content, $commentid);
    $result->execute();
}
$query = "SELECT * FROM `comment` WHERE comment_id=$commentid";
$result = mysqli_query($conn, $query);
while ($rows = mysqli_fetch_array($result)) {
    $title = $rows['title'];
    $content = $rows['content'];
}
?>
<html>
<body>
    <?php
    require("adminnav.php");
    ?>
    <h1> Edit Comment </h1>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type = 'text' name = 'title' value = '<?php echo $title; ?>' > <br>
    <textarea id = 'text' name = 'content'><?php echo $content;?></textarea> <br>
    <input type = 'submit' name = 'savebutton' value = 'save' >
    </form>
</body>
</html>