<?php
$searchpostlistq = $allpostlistq;
$searchpostlistq .= " WHERE";
if (isset($_POST['search'])) {
    $input = mysqli_real_escape_string($conn, $_POST['input']);
    while($row = mysqli_fetch_array($pubpostlist)) {
        $title = $row['title'];
        $postid = $row['title'];
        if (str_contains($title, $input, ignore.case = TRUE))
            $searchpostlistq .= " WHERE";
    }
}
?>

<html>
<body>
    <form action = 'POST' method = "<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type = 'text' name = 'input' value = 'type'>
    <input type = 'submit' name = 'search' value = 'search'>
    </form>
</body>
</html>