<?php
session_start();
include("../connectionvar.php");
include("../queries.php");
require("adminerror.php");
if (isset($_POST['editcategory']) and isset($_POST['editop'])) {
    $_SESSION['categoryid'] = $_POST['editop'];
    header("Location:categoryedit.php");
}
if (isset($_POST['addcategory'])) {
    unset($_SESSION['categoryid']);
    header("Location:categoryadd.php");
}
if (isset($_POST['status1']) and isset($_POST['editop'])) {
    $categoryid = $_POST['editop'];
    $query = "UPDATE category SET status='0' WHERE category_id=$categoryid";
    mysqli_query($conn, $query);
    header("Location:admincategoriesmanage.php");
}
if (isset($_POST['status2']) and isset($_POST['editop'])) {
    $categoryid = $_POST['editop'];
    $date = date('Y-m-d');
    $query = "UPDATE category SET status='1' WHERE category_id=$categoryid";
    mysqli_query($conn, $query);
    header("Location:admincategoriesmanage.php");
}
?>

<html>
<body>
    <?php require("adminnav.php"); ?>
    <h1> Admin - Manage Categories </h1>
    <table style = "border:6px solid black;">
        <tr> 
        <th> Select </th>    
        <th> ID </th>
        <th> Category </th>
        <th> Publish Status </th>
        <th> Description </th>
        </tr>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($categories)) {
            if ($row['status']=='0') {
                $status = "unpublished";
            } else {
                $status = "published";
            }
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['category_id']. "'> </td> <td>". $row['category_id']. "</td> <td>". $row['categoryname']. "</td> <td>". $status. "</td> <td>". $row['description']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'addcategory' value = 'add category' >
    <input type = 'submit' name = 'editcategory' value = 'edit category' >
    <input type = 'submit' name = 'status1' value = 'unpublish category' >
    <input type = 'submit' name = 'status2' value = 'publish category' >
    </form>
</body>
</html>