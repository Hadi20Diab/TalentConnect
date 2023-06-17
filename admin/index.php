<?php 

include "structuralAdminPage.php";

?>


            <!-- ======================= Cards ================== -->
            <div class="cardBox">

                <a href="companys_Management.php">

                    <div class="card">
                        <?php
                            $select_companys = mysqli_query($conn, "SELECT 	company_id  FROM `company`"); 
                            $numbers_of_companys  = mysqli_num_rows($select_companys);
                            
                        ?>
                            <div>
                                <div class="numbers"><?= $numbers_of_companys ; ?></div>
                                <div class="cardName">Companies </div>
                            </div>
    
                            <div class="iconBx">
                                <i class="fa fa-solid fa-city"></i>
                                <!-- <img src="https://cdn-icons-png.flaticon.com/512/4300/4300058.png" class="cardImgIcon" alt=""> -->
                                <!-- <ion-icon name="" class="fa-thin fa-buildings"></ion-icon> -->
                            </div>
                    </div>

                </a>

                <a href="universities_Mangment.php">
                    <div class="card">
                    <?php
                        $select_universities = mysqli_query($conn, "SELECT university_ID  FROM `universities`"); 
                        $numbers_of_universities = mysqli_num_rows($select_universities);
                        
                    ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_universities ; ?></div>
                            <div class="cardName">Universities</div>
                        </div>
    
                        <div class="iconBx">
                            <i class="fa fa-light fa-graduation-cap"></i>
                            <!-- <ion-icon name="storefront-outline"></ion-icon> -->
                        </div>
                    </div>

                </a>

                <a href="companys_Mangment.php">

                    <div class="card">
                    
                        <?php
                            $select_individuals = mysqli_query($conn, "SELECT individual_ID  FROM `individuals`");
                            $numbers_of_individuals = mysqli_num_rows($select_individuals);
                        ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_individuals ?></div>
                            <div class="cardName">Individuals</div>
                        </div>
                    
                        <div class="iconBx">
                            <i class="fa fa-regular fa-user"></i>
                            <!-- <ion-icon name="cart-outline"></ion-icon> -->
                        </div>
                    </div>

                </a>

                <a href="paymentDetails.php">
                  <div class="card">
                      <?php
                          $currentYear = date('Y');
                          $select_payment = mysqli_query($conn, "SELECT MONTH(payment_date) AS month,YEAR(payment_date) AS year, SUM(amount) AS total_amount FROM payments 
                                                                WHERE  YEAR(payment_date) = $currentYear
                                                                GROUP BY MONTH(payment_date)");
                          $net_payment=0;
                          
                          while($fetch_payment= mysqli_fetch_assoc($select_payment)){
                            $net_payment  += $fetch_payment['total_amount'] *10 /100; // 10% for each course
                          }
                          // // Reset the pointer to the first row

                          // mysqli_data_seek($select_payment, 0);
                          // $fetch_payment = mysqli_fetch_assoc($select_payment);
                      ?>
                      <div>
                          <div class="numbers">$<?= $net_payment ?></div>
                          <div class="cardName">Net Payment</div>
                      </div>
                      <div class="iconBx">
                          <i class="fa-solid fa-money-bill"></i>
                      </div>
                  </div>

                </a>

                
            </div>



<?php
    $select_Graduated = mysqli_query($conn, "SELECT Is_Graduated FROM `individuals` WHERE Is_Graduated=true");
    
    
    $numbers_of_Graduated = mysqli_num_rows($select_Graduated);
    $numbers_of_underGraduated = $numbers_of_individuals - mysqli_num_rows($select_Graduated);


    $totalUser=$numbers_of_Graduated + $numbers_of_underGraduated +$numbers_of_companys +$numbers_of_universities
?>





<!-- Chart -->
<h2 style="padding: 30px;">System OverView</h2>
<div class="ChartsDIV">
  <div class="OverViewCHART">

    
    <style>
      #chartContainer {
        max-width: 100%;
        height: auto;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="../js/chart.js"></script> -->

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('chartContainer').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Company', 'University', 'Graduated Student', 'Undergraduate Student'],
            datasets: [{
              label: 'System Percentage %',
              data: [
                <?= $numbers_of_companys/$totalUser*100 ; ?>,
                <?= $numbers_of_universities/$totalUser*100 ; ?>,
                <?= $numbers_of_Graduated/$totalUser*100 ?>,
                <?= $numbers_of_underGraduated/$totalUser*100 ?>
              ], // Example data (replace with actual percentages)
              backgroundColor: ['rgb(255, 99, 132)', 'rgb(75, 240, 102)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)'],
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              display: true,
              position: 'bottom'
            },
            title: {
              display: true,
              text: 'System Percentage Chart'
            }
          }
        });
      });
    </script>
    <canvas id="chartContainer"></canvas>
  </div>

<!-- for payment chart -->






  <?php
    // Initialize arrays to store the chart data
    $labels = [];
    $data = [];

    // Create an array with all month abbreviations
    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

    // Get the current month
    $currentMonth = date('n'); // Returns the current month as a number (1-12)

    // Initialize the monthly data array with 0 values 
    $monthlyData = array_fill(0, $currentMonth - 1, 0); // this values will be changed with data from database

    // Fetch data from the result set
      mysqli_data_seek($select_payment, 0); // Reset the pointer to the first row

    while ($row = mysqli_fetch_assoc($select_payment)) {
      $month = intval($row['month']); // Get the month value from the query result
      if ($month <= $currentMonth && $row['year'] == $currentYear) {
        $monthlyData[$month - 1] = $row['total_amount']; // Map the data to the corresponding month index
      }
    }
    

    // Populate the labels and data arrays
    foreach ($months as $index => $month) {
      if ($index < $currentMonth) {
        $data[] = $monthlyData[$index] *10/100;// 10% for each course
      } else {
        // $data[] = 0;
      }
      $labels[] = $month;
    }
  ?>

  <div class="paymentChart">
    <canvas id="paymentChart"></canvas>
    <script>
      // The data should include the payment amounts for each month
      const labels = <?php echo json_encode($labels); ?>;
      const data = <?php echo json_encode($data); ?>;

      const paymentChart = new Chart(document.getElementById('paymentChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Payment',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
  </div>
</div>





<style>
  .ChartsDIV{
    width: 100%;
    display:flex;
  }
  .OverViewCHART{
    width: 30%;
  }
  .paymentChart{
    width: 70%;
  }
</style>


    <script>
        document.getElementById("Dashboard-LeftBar").classList.add("actived");
    </script>

    </div>
    <title>Admin Dashboard</title>
</body>

</html>