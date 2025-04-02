<html>
<body>
    <select name = 'filterop'>
        <option value = '0'>all</option>
        <?php
        while ($row = mysqli_fetch_array($pcategories)) {
            echo "<option value = '". $row['category_id']. "'>". $row['categoryname']. "</option>";
        }
        ?>
    </select>
    <input type = 'submit' name = 'filter' value = 'filter'>   
</body>
</html>