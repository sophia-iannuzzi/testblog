<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    #piechart {
      width: 300;
      height: 300;
    } 

    #barchart {
      width: 500;
      height: 500;
    }
  </style>
</head>

<body>
<h1> Published posts per category </h1>
<canvas id="piechart"></canvas>

<h1> Registers per momth </h1>
<canvas id="barchart"></canvas>

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
        label: '# of Votes',
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
$query = "SELECT * FROM `month` JOIN `registerchart` ON month.month_id=registerchart.month_id WHERE year='$year'";
$amount = mysqli_query($conn, $query);
$query = "SELECT * FROM `month`";
$month = mysqli_query($conn, $query);
?>
<script>
  const ctx2 = document.getElementById('barchart');
  new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: [
        <?php
        while($row = mysqli_fetch_array($month)) {
          echo "'". $row['monthname']. "',";
       }
        ?>
      ],
      datasets: [{
        label: 'Register Count',
        data: [
          <?php
          $rows = mysqli_fetch_array($amount);
          echo $rows['registercount']. ", ";
          while($rows = mysqli_fetch_array($amount)) {
            $nummonthid = $rows['month_id'];
            while ($row = mysqli_fetch_array($month)) {
              $amonthid = $row['month_id'];
              if($amonthid != $nummonthid) {
                echo "1, ";
              } else {
              // echo $rows['registercount']. ",";
              echo "1, ";
              }
            }
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
</body>
</html>