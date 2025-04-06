<?php
$catquery = "SELECT * FROM `postcat` JOIN `category` ON postcat.category_id=category.category_id WHERE postcat.post_id=$postid AND category.status='1'";
$category = mysqli_query($conn, $catquery);
?>

<html>
<div class="col-md-6">
      <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary-emphasis">
            <?php
            while ($crow = mysqli_fetch_array($category)) {
            echo " | ". $crow['categoryname']. " | ";
            }
            ?>
          </strong>
          <h3 class="mb-0">
            <?php
            echo $rows['title'];
            ?>
          </h3>
          <div class="mb-1 text-body-secondary">
            <?php
            echo "By: ". $rows['fname']. " ". $rows['lname']. "<br> Published: ". $rows['date']. "<br>";
            ?>
          </div>
          <p class="card-text mb-auto">
            <?php
            $content = $rows['content'];
            $content=strip_tags($content);
            echo substr($content, 0, 30). "...";
            ?>
          </p>
          <form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'> 
          <button type ='submit' name ='viewop[]' value = '
          <?php
          echo $postid;
          ?>'>
            Continue reading</button>
        </form>
        </div>
        <div class="col-auto d-none d-lg-block">
          <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
        </div>
      </div>
    </div>
</html>