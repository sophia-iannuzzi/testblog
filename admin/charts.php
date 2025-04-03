<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #piechart {
      width: 200;
      height: 200;
    } 

    #barchart {
      width: 200;
      height: 200;
    }
  </style>
</head>

<body>

<?php
include("../connectionvar.php");
$query = "SELECT * FROM `category` JOIN `categorychart` ON category.category_id=categorychart.category_id";
$result = mysqli_query($conn, $query);
?>
<script>
  const ctx = document.getElementById('piechart');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [
         <?php
         while($row = mysqli_fetch_array($result)) {
            echo "'". $row['categoryname']. "',";
         }
         ?>
         ],
      datasets: [{
        label: '# of posts in category',
        data: [
         <?php
         $query = "SELECT * FROM `category` JOIN `categorychart` ON category.category_id=categorychart.category_id";
         $result = mysqli_query($conn, $query);
         while($row = mysqli_fetch_array($result)) {
         echo $row['blogcount']. ",";
         }
         ?>
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: false,
      maintainAspectRation: false
    }
  });
</script>

<?php
$year = date('Y');
$query = "SELECT * FROM `month`";
$month = mysqli_query($conn, $query);
?>
<script>
  const ctx2 = document.getElementById('barchart');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [{
        label: 'Amount of Registers',
        data: [
          <?php
          while($row = mysqli_fetch_array($month)) {
            $query = "SELECT * FROM `month` JOIN `registerchart` ON month.month_id=registerchart.month_id WHERE year='$year' ORDER BY registerchart.month_id";
            $amount = mysqli_query($conn, $query);
            $c = 0;
            while ($rows = mysqli_fetch_array($amount)) {
              if($rows['month_id'] == $row['month_id']) {
                echo $rows['registercount']. ", ";
                $c = 1;
              }
            }
            if($c == 0) {
              echo "0, ";
            }
          }
          ?>
        ],
        borderWidth: 4
      }]
    },
    options: {
      responsive: false,
      maintainAspectRation: false
    }
  });
</script>
</body>
</html>