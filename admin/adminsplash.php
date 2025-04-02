<?php
session_start();
require("adminerror.php");
?>

<html>
<body>
    <?php require('adminnav.php'); ?>
    <h1> Welcome Admin! </h1>
    <div>
        <?php
        require("charts.php");
        ?>
    </div>
</body>
</html>