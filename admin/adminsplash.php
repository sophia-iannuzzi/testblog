<?php
session_start();
if ($_SESSION['levelid']!='2') {
    header("Location:..\bloglogin.php");
}
?>

<html>
<body>
    <?php require('adminnav.php'); ?>
    <h1> Admin Page </h1>
    <form method = 'POST' action = "<?php echo $_SERVER["PHP_SELF"];?>">
</body>
</html>