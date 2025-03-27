<?php
define('dbhost', 'localhost');
define('dbuser', 'root');
define('dbpwd', '');
define('dbname', 'blog');

$conn = mysqli_connect(dbhost, dbuser, dbpwd, dbname) or exit('bad connection');
?>