<?php
session_start();
require("adminerror.php");
?>

<html>
<body>
    <?php require('adminnav.php'); ?>
    <h1> Welcome Admin! </h1>
    <form method = 'POST' action = "<?php echo $_SERVER["PHP_SELF"];?>">
</body>
</html>