<?php
session_start();
include("..\query/categorylistquery.php");
if (isset($_POST['editcategory']) and isset($_POST['editop'])) {
    $_SESSION['categoryid'] = $_POST['editop'];
    header("Location:categoryedit.php");
}
if (isset($_POST['addcategory'])) {
    unset($_SESSION['categoryid']);
    header("Location:categoryedit.php");
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
        <th> Description </th>
        </tr>
    <form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        while ($row = mysqli_fetch_array($categories)) {
            echo "<tr> <td> <input type = 'radio' name = 'editop' value = '". $row['category_id']. "'> </td> <td>". $row['category_id']. "</td> <td>". $row['categoryname']. "</td> <td>". $row['description']. "</td> </tr>";
        }
        ?>
    </table>
    <input type = 'submit' name = 'addcategory' value = 'add category' >
    <input type = 'submit' name = 'editcategory' value = 'edit category' >
    </form>
</body>
</html>