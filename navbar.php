<html>
    <nav>
        <a href="index.php">home</a>
        <a href="admin/adminsplash.php">
        <?php 
        if (isset($_SESSION['levelid']) and $_SESSION['levelid']=='2') {
            echo "admin";
        } ?></a>
        <a href ="yourpost.php">
        <?php
        if (isset($_SESSION['levelid']))
        echo "Your Posts";
        ?> </a>
        <a href ="bloglogout.php">
        <?php
        if (isset($_SESSION['levelid']))
        echo "logout";
        ?> </a>
        <a href ="bloglogin.php">
        <?php
        if (!isset($_SESSION['levelid']))
        echo "login";
        ?> </a>
    </nav>
</html>