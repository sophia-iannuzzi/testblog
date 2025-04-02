<html>
<body>
<h1> Posts per category </h1>
   <canvas id="myChart" width="400" height="400"></canvas>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const myChart = new Chart(ctx, {...});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
<?php
include("../connectionvar.php");
$query = "SELECT * FROM `category` JOIN `categorychart` ON category.category_id=categorychart.category_id";
$result = mysqli_query($conn, $query);
?>
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
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</script>
</body>
</html>

