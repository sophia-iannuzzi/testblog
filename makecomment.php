<?php
if (isset($_POST['submitbutton'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $date = date('Y-m-d');
    if (!empty($title) and !empty($fname) and !empty($lname) and !empty($content)) {
        $query = "INSERT INTO `comment` (`post_id`, `fname`, `lname`, `comtitle`, `comcontent`, `status`, `date`) VALUE ('$postid', '$fname', '$lname', '$title', '$content', '1', '$date')";
        mysqli_query($conn, $query);
        header("blogview.php");
    } else {
        $msg = "please fill in all fields";
    }
}
?>

<html>
<body>

<div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Cast a Comment!</h4>
    <form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">

        <div class="row g-3">

            <div class="col-sm-12">
            <label class="form-label">Title</label>
            <input type="text" class="form-control"  name = 'title'>
            </div>

            <div class="col-sm-6">
            <label class="form-label">First name</label>
            <input type="text" class="form-control"  name = 'fname'>
            </div>

            <div class="col-sm-6">
            <label class="form-label">Last name</label>
            <input type="text" class="form-control"  name = 'lname'>
            </div>

            <div class="col-sm-12">
            <label class="form-label">Comment</label>
                <textarea class="form-control" rows="3" name = 'content'></textarea>
            </div>

            
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-lg btn-block" name ='submitbutton'>comment</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>