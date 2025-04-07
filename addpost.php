<?php
session_start();
include("connectionvar.php");
include("queries.php");
if (!isset($_SESSION['levelid'])) {
  header("Location:index.php");
}
if (isset($_POST['save'])) {
  $userid = $_SESSION['userid'];
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $date = date('Y-m-d');
  if(!isset($_POST['category'])) {
    $msg = "please select category/categories";
  } elseif(!empty($_POST['title']) and !empty($_POST['content']) and isset($_POST['category'])) {
    $query = "INSERT INTO `post` (`user_id`, `titlepost`, `content`, `statuspost`, `date`) VALUE ('$userid', '$title', '$content', '0', '$date')";
    mysqli_query($conn, $query);
    $postid = $conn->insert_id;

    foreach ($_POST['category'] as $categoryid) {
      $query = "INSERT INTO `postcat`(`post_id`, `category_id`) VALUE ('$postid', '$categoryid')";
      mysqli_query($conn, $query);
    }
    if($_SESSION['loc']=='admin') {
      header("Location:admin/adminpostmanage.php");
    } else {
      header("Location:yourpost.php");
    }
  } else {
    $msg = 'please fill in everything';
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="froala/froala_editor.css">
  <link rel="stylesheet" href="froala/froala_style.css">
  <link rel="stylesheet" href="froala/draggable.css">
  <link rel="stylesheet" href="froala/char_counter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css">

  <style>
    body {
      text-align: center;
    }

    div#editor {
      width: 81%;
      margin: auto;
      text-align: left;
    }

    .ss {
      background-color: red;
    }
  </style>
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet"><!-- Custom styles for this template -->
  <link href="css/blog.css" rel="stylesheet">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">    
</head>

<body>
<?php require('navbar.php'); ?> <br>
<form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="col-sm-4 mx-auto" style="width: 200px">
    <input class="form-control" name = 'title' 
    <?php
      if(isset($title)) {
        echo "value = '$title'";
      } else {
          echo "placeholder ='Write Title'";
      }
    ?>>
  </div>

  <div class='mx-auto' style='width: 600px'> 
    <?php
    while ($rows = mysqli_fetch_array($pcategories)) {
      echo "<div class='form-check form-check-inline'> <input class='form-check-input' type = 'checkbox' name = 'category[]' value ='". $rows['category_id']. "'>". $rows['categoryname']. " </div> </option>";
    } ?>
    </div> 
  </select>

  <div id="editor">
      <textarea name = 'content' id='edit'><?php if(isset($content)) { echo $content;} else { echo"Write Blog!"; }?></textarea>
      <input type = 'submit' name = 'save' value = 'save' >
  </div>
  </form>
  <?php
  if (isset($msg)) {
    echo "$msg";
  }
  ?>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>

  <script type="text/javascript" src="froala/froala_editor.min.js"></script>
  <script type="text/javascript" src="froala/align.min.js"></script>
  <script type="text/javascript" src="froala/char_counter.min.js"></script>
  <script type="text/javascript" src="froala/draggable.min.js"></script>
  <script type="text/javascript" src="froala/font_size.min.js"></script>
  <script type="text/javascript" src="froala/font_family.min.js"></script>
  <script type="text/javascript" src="froala/image.min.js"></script>
  <script type="text/javascript" src="froala/paragraph_format.min.js"></script>
  <script type="text/javascript" src="froala/paragraph_style.min.js"></script>
  <script>
    (function () {
      const editorInstance = new FroalaEditor("#edit", {
        enter: FroalaEditor.ENTER_P,
        placeholderText: null,
        imageUpload: false, 
        imageUploadURL: null,
        inageUploadRemoteUrls: false,

        imageInsertButtons: ['imageBack', '|', 'imageByURL'],

        imagePaste: false
      })

    })()
  </script>
</body>

</html>