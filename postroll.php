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
      echo $rows['titlepost'];
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
    <button type="submit" class="btn btn-primary btn-lg btn-block" name ='viewop[]' value = '
      <?php
      echo $postid;
      ?>'>Continue reading</button>
    </div>
  </div>
</div>
</html>