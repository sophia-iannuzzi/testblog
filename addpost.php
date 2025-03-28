<?php
session_start();
if (!isset($_SESSION['levelid'])) {
  header("Location:logout.php");
}
include "connectionvar.php";
if (isset($_POST['save']) and isset($_POST['title']) and isset($_POST['content'])) {
  $userid = $_SESSION['userid'];
  $title = $_POST['title'];
  $categoryid = $_POST['category'];
  $content = $_POST['content'];
  $date = date('Y-m-d');
  $query = "INSERT INTO `post` (`user_id`, `title`, `content`, `statuspost`, `date`) VALUE ('$userid', '$title', '$content', '0', '$date')";
  mysqli_query($conn, $query);
  // header("Location:index.php");
// temporary
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
  <link rel="stylesheet" href="froala/code_view.css">
  <link rel="stylesheet" href="froala/draggable.css">
  <link rel="stylesheet" href="froala/colors.css">
  <link rel="stylesheet" href="froala/emoticons.css">
  <link rel="stylesheet" href="froala/image_manager.css">
  <link rel="stylesheet" href="froala/image.css">
  <link rel="stylesheet" href="froala/line_breaker.css">
  <link rel="stylesheet" href="froala/table.css">
  <link rel="stylesheet" href="froala/char_counter.css">
  <link rel="stylesheet" href="froala/fullscreen.css">
  <link rel="stylesheet" href="froala/file.css">
  <link rel="stylesheet" href="froala/quick_insert.css">
  <link rel="stylesheet" href="froala/help.css">
  <link rel="stylesheet" href="froala/spell_checker.css">
  <link rel="stylesheet" href="froala/special_characters.css">
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
</head>

<body>
<?php require('navbar.php'); ?> <br>
<form method = 'POST' action = "<?php echo $_SERVER['PHP_SELF']; ?>">
  <input type = 'text' name = 'title' value = 'Write Title!'> 
  <select name = 'category' >
    <?php 
    include "categorylistquery.php";
    while ($rows = mysqli_fetch_array($categories)) {
      echo "<option value ='". $rows['category_id']. "'>". $rows['categoryname']. "</option>";
    } ?>
  </select>
  <div id="editor">
      <textarea name = 'content' id='edit'>Write Blog!</textarea>
      <input type = 'submit' name = 'save' value = 'save' >
  </div>
  </form>

  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>

  <script type="text/javascript" src="froala/froala_editor.min.js"></script>
  <script type="text/javascript" src="froala/align.min.js"></script>
  <script type="text/javascript" src="froala/char_counter.min.js"></script>
  <script type="text/javascript" src="froala/code_beautifier.min.js"></script>
  <script type="text/javascript" src="froala/code_view.min.js"></script>
  <script type="text/javascript" src="froala/colors.min.js"></script>
  <script type="text/javascript" src="froala/draggable.min.js"></script>
  <script type="text/javascript" src="froala/emoticons.min.js"></script>
  <script type="text/javascript" src="froala/entities.min.js"></script>
  <script type="text/javascript" src="froala/file.min.js"></script>
  <script type="text/javascript" src="froala/font_size.min.js"></script>
  <script type="text/javascript" src="froala/font_family.min.js"></script>
  <script type="text/javascript" src="froala/fullscreen.min.js"></script>
  <script type="text/javascript" src="froala/image.min.js"></script>
  <script type="text/javascript" src="froala/image_manager.min.js"></script>
  <script type="text/javascript" src="froala/line_breaker.min.js"></script>
  <script type="text/javascript" src="froala/inline_style.min.js"></script>
  <script type="text/javascript" src="froala/link.min.js"></script>
  <script type="text/javascript" src="froala/lists.min.js"></script>
  <script type="text/javascript" src="froala/paragraph_format.min.js"></script>
  <script type="text/javascript" src="froala/paragraph_style.min.js"></script>
  <script type="text/javascript" src="froala/quick_insert.min.js"></script>
  <script type="text/javascript" src="froala/quote.min.js"></script>
  <script type="text/javascript" src="froala/table.min.js"></script>
  <script type="text/javascript" src="froala/save.min.js"></script>
  <script type="text/javascript" src="froala/url.min.js"></script>
  <script type="text/javascript" src="froala/help.min.js"></script>
  <script type="text/javascript" src="froala/print.min.js"></script>
  <script type="text/javascript" src="froala/spell_checker.min.js"></script>
  <script type="text/javascript" src="froala/special_characters.min.js"></script>
  <script type="text/javascript" src="froala/word_paste.min.js"></script>

  <script>
    (function () {
      new FroalaEditor("#edit")
    })()
  </script>
</body>

</html>