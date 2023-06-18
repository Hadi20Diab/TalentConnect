<?php 

include "structuralAdminPage.php";

?>
<title> Revenue Overview</title>
<?php
$currentYear = date('Y');

$query = "SELECT c.course_ID, c.course_Name, c.course_Creator, c.course_Fees, SUM(p.amount) AS revenue
FROM courses AS c
JOIN payments AS p ON c.course_ID = p.course_ID
WHERE YEAR(payment_date) = $currentYear
GROUP BY c.course_ID, c.course_Name, c.course_Creator, c.course_Fees
ORDER BY revenue DESC
LIMIT 5
";

$result = mysqli_query($conn, $query);


$labels = []; // Course names
$data = []; // Revenue generated
$creators = []; // Course creators


while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['course_Name'];
    $data[] = $row['revenue'] *10/100; // 10% for each course
    $creators[] = $row['course_Creator'];
}
?>
<!-- <div style="     display: flex;     align-items: center;     margin: 1rem 1rem 0; "> -->
<a href="index.php" style="display: flex; place-items: center;  margin: 1rem 1rem 0;">
    <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
    <h2 style="padding: 30px;">Course Revenue Overview</h2>
    <i class="fas fa-sharp fa-regular fa-money-bill-trend-up fa-2xl" style="     color: var(--nav-main);  margin-bottom: 10px;"></i>
</a>
<div style=" margin: 0 1rem 1rem;">
  <canvas id="courseRevenueChart"></canvas>
</div>
<script>



  const labels = <?php echo json_encode($labels); ?>;
  const data = <?php echo json_encode($data); ?>;
  const creators = <?php echo json_encode($creators); ?>;

  const courseRevenueChart = new Chart(document.getElementById('courseRevenueChart'), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Revenue',
          data: data,
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      plugins: {
        tooltip: {
          callbacks: {
            title: function (context) {
              const index = context[0].dataIndex;
              return labels[index];
            },
            label: function (context) {
              const index = context.dataIndex;
              const revenue = data[index];
              const creator = creators[index];
              const label = labels[index];
              return label + '\nRevenue: $' + revenue.toFixed(2) + ', Created By: ' + creator;
            }
          }
        }
      }
    }
  });
</script>