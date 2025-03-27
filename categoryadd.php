<?php
session_start();
include "connectionvar.php";
if (!isset($_SESSION['levelid'])) {
  header("Location:logout.php");
}
if (isset($_POST['addcategory'])) {
    $categoryname = $_POST['categoryname'];
    $description = $_POST['description'];
    $result = $conn->prepare("INSERT INTO `category` (`categoryname`, `description`) VALUE (?, ?)");
    $result->bind_param("ss", $categoryname, $description);
    $result->execute();
    header("Location:index.php");
}
?>

<html>
<body>
    <?php
    require ('navbar.php');
    ?>
    <h1> Add Category </h1>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    Category Name:<input type = 'text' name = 'categoryname'> <br>
    Description:<textarea id = 'text' name = 'description'></textarea> <br>
    <input type = 'submit' name = 'addcategory' value = 'add category' >
    </form>
</body>
</html>