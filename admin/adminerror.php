<?php
if (!isset($_SESSION['levelid'])) {
    exit("Error. Not signed in");
} elseif ($_SESSION['levelid']!='2') {
    exit("Error. Not registered as admin, please contact adminstrator");
}
?>