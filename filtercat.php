<html>
<body>
<link href="admin/css/sb-admin-2.min.css" rel="stylesheet">
    <select class = "dropdown" name = 'filterop'>
        <option class = "dropdown-header" value = '0'>all</option>
        <?php
        while ($row = mysqli_fetch_array($pcategories)) {
            echo "<option class = 'dropdown-header' value = '". $row['category_id']. "'>". $row['categoryname']. "</option>";
        }
        ?>
    </select>
    <button class="btn-icon-split" type = 'submit' name = 'filter'>
        <span class="text">Filter by Category</span>
    </button>
</body>
</html>