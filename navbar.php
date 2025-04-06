<html>
<div class="nav-scroller py-1 px-4 mb-3 border-bottom">
    <nav class="nav nav-underline">
        <a class="nav-item nav-link link-body-emphasis active" href="index.php">Home</a>
        <a class="nav-item nav-link link-body-emphasis active" href="admin/adminsplash.php">
        <?php 
        if (isset($_SESSION['levelid']) and $_SESSION['levelid']=='2') {
            echo "Admin";
        } ?></a>
        <a class="nav-item nav-link link-body-emphasis active" href ="yourpost.php">
        <?php
        if (isset($_SESSION['levelid']))
        echo "Your Posts";
        ?> </a>
        <a class="nav-item nav-link link-body-emphasis active" href ="bloglogout.php">
        <?php
        if (isset($_SESSION['levelid']))
        echo "Logout";
        ?> </a>
        <a class="nav-item nav-link link-body-emphasis active" href ="bloglogin.php">
        <?php
        if (!isset($_SESSION['levelid']))
        echo "Login";
        ?> </a>
    </nav>
</div>
</html>