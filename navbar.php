<html>
    <nav>
        <a href="index.php">home</a>
        <a href="admin/adminsplash.php"><?php 
        if ($_SESSION['levelid']=='2') {
            echo "admin";
        } ?></a>
        <a href ="bloglogout.php">logout</a>
    </nav>
</html>