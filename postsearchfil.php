<html>
<body>
<form method = 'POST' action = '<?php $_SERVER['PHP_SELF'];?>'>
<div class = 'row'>
        <div class="col mx-3">
            <input class = "dropdown-header" type = 'text' name = 'input' placeholder = 'search titles'>
        </div>

        <div class="col">
            <button class="btn-icon-split" type = 'submit' name = 'search'>
                <span class="text">Search</span>
            </button>
        </div>

        <div class="col">
            <select class = "dropdown" name = 'filterop'>
                <option class = "dropdown-header" value = '0'>all</option>
                <?php
                if($_SESSION['loc']=='yourpost') {
                    while ($row = mysqli_fetch_array($categories)) {
                        echo "<option class = 'dropdown-header' value = '". $row['category_id']. "'>". $row['categoryname']. "</option>";
                    }
                } else {
                    while ($row = mysqli_fetch_array($pcategories)) {
                        echo "<option class = 'dropdown-header' value = '". $row['category_id']. "'>". $row['categoryname']. "</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="col">
            <button class="btn-icon-split" type = 'submit' name = 'filter'>
                <span class="text">Filter by Category</span>
            </button>
        </div>

</div>
</form>
</body>
</html>