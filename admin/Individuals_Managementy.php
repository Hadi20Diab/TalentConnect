<?php 

include "structuralAdminPage.php";

?>





            <!-- ======================= Cards ================== -->
            <h2 style="padding: 30px;">
                <i class="fa-solid fa-pen-to-square fa-lg fa-xl" style="     color: var(--nav-main); "></i>  
                View - Edit Individuals
            </h2>

            <div class="cardBox">

                <a href="IndividualsView_Mangment.php">

                    <div class="card">
                        <?php
                            $select_individuals = mysqli_query($conn, "SELECT individual_ID  FROM `individuals`"); 
                            $numbers_of_individuals  = mysqli_num_rows($select_individuals);
                            
                        ?>
                            <div>
                                <div class="cardName">View Individuals</div>
                                <div class="numbers"><?= $numbers_of_individuals ; ?></div>
                            </div>
    
                            <div class="iconBx">
                                <i class="fa-solid fa-users"></i>
                            </div>
                    </div>

                </a>

                <?php
                if($fetch_profile['role']=='host'){
                                    
                ?>
                    <a href="addAndDeleteIndividuals_Mangment.php">
                        <div class="card">
                            <div>
                                <div class="cardName">Add/Delete Individuals</div>
                            </div>
        
                            <div class="iconBx" style="display: flex;">
                                <i class="fa-solid fa-user"></i>
                                <i class="fa-solid fa-plus-minus" style="scale: 0.6;"></i>
                            </div>
                        </div>

                    </a>
                <?php
                }
                ?>

                <!-- <a href="companysAnalytics_Management.php">

                    <div class="card">
                        <div>
                            <div class="cardName">Company Analytics</div>
                        </div>
                    
                        <div class="iconBx">
                            <i class="fas fa-thin fa-chart-bar"></i>
                        </div>
                    </div>

                </a> -->

                

                
            </div>



            <!-- Company Status-->

            <!-- =======================Individuals Cards ================== -->
            <h2 style="padding: 30px;">
                <i class="fa-solid fa-circle-exclamation fa-lg" style="     color: var(--nav-main); "></i>
                Individuals Status
            </h2>
            <div class="cardBox">
                <a href="pendingIndividuals_Mangment.php"  class="card pending" >
                    <?php
                        $select_pending_Individuals = mysqli_query($conn, "SELECT * FROM `individuals` WHERE individual_Status='pending'"); 
                        $numbers_of_pending_Individuals = mysqli_num_rows($select_pending_Individuals);
                    
                     ?>
                    <div>
                        <div class="numbers"><?= $numbers_of_pending_Individuals ?></div>
                        <div class="cardName">Pending Individuals</div>
                    </div>

                    <div class="iconBx">
                        <i class="fa-solid fa-user-pen"></i>
                    </div>
                </a>
                
                <a href="approvedIndividual_Mangment.php" class="card approved" >
                     <?php
                        $select_approved_Individuals = mysqli_query($conn, "SELECT individual_ID  FROM `individuals` WHERE individual_Status='approved'"); 
                        $numbers_of_approved_Individuals = mysqli_num_rows($select_approved_Individuals);
                    
                     ?>
                    <div>
                        <div class="numbers" ><?= $numbers_of_approved_Individuals ?></div>
                        <div class="cardName">Approved Individuals</div>
                    </div>

                    <div class="iconBx" style="display: flex;">
                        <i class="fa-solid fa-users"></i>
                        <i class="fa-solid fa-check " style="scale: 0.8;"></i>
                    </div>
                </a>

                <a href="blockedIndividuals_Mangment.php" class="card rejected" >
                     <?php
                        $select_rejected_Individuals = mysqli_query($conn, "SELECT individual_ID  FROM `individuals` WHERE individual_Status='blocked'"); 
                        $numbers_of_rejected_Individuals = mysqli_num_rows($select_rejected_Individuals);
                    
                     ?>
                    <div>
                        <div class="numbers"><?= $numbers_of_rejected_Individuals ?></div>
                        <div class="cardName">Blocked Individuals</div>
                    </div>

                    <div class="iconBx">
                        <i class="fa-sharp fa-solid fa-users-slash"></i>
                    </div>
                </a>

                

                
            </div>














    </div>
    <title>Manage Individuals</title>

    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>
</body>

</html>