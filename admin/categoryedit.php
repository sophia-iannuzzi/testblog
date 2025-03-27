<?php
session_start();
include '..\connectionvar.php';
if ($_SESSION['levelid']!='2') {
    header("Location:..\index.php");
}
$categoryid = $_SESSION['categoryid'];

if (isset($_POST['savebutton'])) {
    $categoryname = $_POST['categoryname'];
    $description = $_POST['description'];
    $result = $conn->prepare("UPDATE category SET categoryname=?, description=? WHERE category_id=$categoryid");
    $result->bind_param("ss", $categoryname, $description);
    $result->execute();
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
<body>
    <?php
    require("adminnav.php");
    ?>
    <h1> Edit Category </h1>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    Category Name:<input type = 'text' name = 'categoryname' value = '<?php if (isset($categoryname)) { echo $categoryname; }?>' > <br>
    Description:<textarea id = 'text' name = 'description'><?php if (isset($description)) { echo $description; }?></textarea> <br>
    <input type = 'submit' name = 'savebutton' value = '<?php if(!isset($_SESSION['categoryid'])) { echo "add"; } else { echo "save"; } ?>' >
    </form>
</body>
</html>