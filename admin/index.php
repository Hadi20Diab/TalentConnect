<?php 

include "structuralAdminPage.php";

?>


            <!-- ======================= Cards ================== -->
            <div class="cardBox">

                <a href="companys_Management.php">

                    <div class="card">
                        <?php
                            $select_companys = mysqli_query($conn, "SELECT * FROM `company`"); 
                            $numbers_of_companys  = mysqli_num_rows($select_companys);
                            
                        ?>
                            <div>
                                <div class="numbers"><?= $numbers_of_companys ; ?></div>
                                <div class="cardName">Companys </div>
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
                        $select_universities = mysqli_query($conn, "SELECT * FROM `universities`"); 
                        $numbers_of_universities = mysqli_num_rows($select_universities);
                        
                    ?>
                        <div>
                            <div class="numbers"><?= $numbers_of_companys ; ?></div>
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
                            $select_individuals = mysqli_query($conn, "SELECT * FROM `individuals`");
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

                
            </div>



<?php
    $select_Graduated = mysqli_query($conn, "SELECT Is_Graduated FROM `individuals` WHERE Is_Graduated=true");
    
    
    $numbers_of_Graduated = mysqli_num_rows($select_Graduated);
    $numbers_of_underGraduated = $numbers_of_individuals - mysqli_num_rows($select_Graduated);


?>
<!-- Chart -->
<div class="ChartDIV">
  <style>
    #chartContainer {
      max-width: 100%;
      height: auto;
    }
  </style>
  <script src="../js/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var ctx = document.getElementById('chartContainer').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Company', 'University', 'Graduated Student', 'Undergraduate Student'],
          datasets: [{
            label: 'System Percentage',
            data: [<?= $numbers_of_companys ; ?>,
            <?= $numbers_of_companys ; ?>,
            <?= $numbers_of_Graduated ?>,
            <?= $numbers_of_underGraduated ?>], // Example data (replace with actual percentages)
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








    <script>
        document.getElementById("Dashboard-LeftBar").classList.add("actived");
    </script>

    </div>
    <title>Admin Dashboard</title>
</body>

</html>