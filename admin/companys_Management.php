<?php 

include "structuralAdminPage.php";

?>





            <!-- ======================= Cards ================== -->
            <h2 style="padding: 30px;">
                <i class="fa-solid fa-pen-to-square fa-lg fa-xl" style="     color: var(--nav-main); "></i>  
                View - Edit Companies
            </h2>

            <div class="cardBox">

                <a href="companiesView_Mangment.php">

                    <div class="card">
                        <?php
                            $select_companys = mysqli_query($conn, "SELECT * FROM `company`"); 
                            $numbers_of_companys  = mysqli_num_rows($select_companys);
                            
                        ?>
                            <div>
                                <div class="cardName">View Companies</div>
                                <div class="numbers"><?= $numbers_of_companys ; ?></div>
                            </div>
    
                            <div class="iconBx">
                                <i class="fas fa-regular fa-building-circle-exclamation"></i>
                                <!-- <i class="fas fa fa-sharp fa-regular fa-building-circle-arrow-right"></i> -->
                            </div>
                    </div>

                </a>

                <?php
                if($fetch_profile['role']=='host'){
                                    
                ?>
                    <a href="addAndDeleteCompanies_Mangment.php">
                        <div class="card">
                            <div>
                                <div class="cardName">Add/Delete Company</div>
                            </div>
        
                            <div class="iconBx">
                                <i class="fas fa-light fa-building-circle-check"></i>                            <!-- <ion-icon name="storefront-outline"></ion-icon> -->
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

            <!-- =======================Companies Cards ================== -->
            <h2 style="padding: 30px;">
                <i class="fa-solid fa-circle-exclamation fa-lg" style="     color: var(--nav-main); "></i>
                Companies Status
            </h2>
            <div class="cardBox">
                <a href="pendingCompany_Mangment.php"  class="card pending" >
                    <?php
                        $select_pending_companies = mysqli_query($conn, "SELECT * FROM `company` WHERE company_Status='pending'"); 
                        $numbers_of_pending_companies = mysqli_num_rows($select_pending_companies);
                    
                     ?>
                    <div>
                        <div class="numbers"><?= $numbers_of_pending_companies ?></div>
                        <div class="cardName">Pending Companies</div>
                    </div>

                    <div class="iconBx">
                        <i class="fas fa-regular fa-pen-nib"></i>
                        <!-- <ion-icon name="people-outline"></ion-icon> -->
                    </div>
                </a>
                
                <a href="approvedCompany_Mangment.php" class="card approved" >
                     <?php
                        $select_approved_companies = mysqli_query($conn, "SELECT * FROM `company` WHERE company_Status='approved'"); 
                        $numbers_of_approved_companies = mysqli_num_rows($select_approved_companies);
                    
                     ?>
                    <div>
                        <div class="numbers" ><?= $numbers_of_approved_companies ?></div>
                        <div class="cardName">Approved Companies</div>
                    </div>

                    <div class="iconBx">
                        <i class="fas fa-light fa-building-circle-check"></i>
                        <!-- <ion-icon name="storefront-outline"></ion-icon> -->
                    </div>
                </a>

                <a href="blockedCompany_Mangment.php" class="card rejected" >
                     <?php
                        $select_rejected_companies = mysqli_query($conn, "SELECT * FROM `company` WHERE company_Status='blocked'"); 
                        $numbers_of_rejected_companies = mysqli_num_rows($select_rejected_companies);
                    
                     ?>
                    <div>
                        <div class="numbers"><?= $numbers_of_rejected_companies ?></div>
                        <div class="cardName">Blocked companies</div>
                    </div>

                    <div class="iconBx">
                        <i class="fas fa-regular fa-building-circle-xmark"></i>
                        <!-- <ion-icon name="cart-outline"></ion-icon> -->
                    </div>
                </a>

                

                
            </div>














    </div>
    <title>Manage Companies</title>

    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>
</body>

</html>