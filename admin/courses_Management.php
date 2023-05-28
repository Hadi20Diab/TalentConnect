<?php 

include "structuralAdminPage.php";

?>
    <title>Courses Management</title>
    <script>
        document.getElementById("CourseManagement-LeftBar").classList.add("actived");
    </script>




            <!-- ======================= Cards ================== -->
            <h2 style="padding: 30px;">View - Edit Courses</h2>

            <div class="cardBox">

                <a href="coursesView_Mangment.php">

                    <div class="card">
                        <?php
                            $select_courses = mysqli_query($conn, "SELECT * FROM `courses`"); 
                            $numbers_of_courses  = mysqli_num_rows($select_courses);
                            
                        ?>
                            <div>
                                <div class="cardName">View Courses</div>
                                <div class="numbers"><?= $numbers_of_courses ; ?></div>
                            </div>
    
                            <div class="iconBx">
                                <!-- <i class="fa fa-books-medical"></i> -->
                                <i class="fa fa-duotone fa-book-atlas"></i>
                            </div>
                    </div>

                </a>

                <a href="addAndDeleteCourses_Mangment.php"  class="card pending" >

                    <div>
                        <div class="cardName">Add/Delete Courses</div>
                    </div>

                    <div class="iconBx">
                        <i class="fas fa-regular fa-pen-nib"></i>
                        <!-- <ion-icon name="people-outline"></ion-icon> -->
                    </div>
                </a>

                <!-- <a href="companysAnalytics_Management.php">

                    <div class="card">
                        <div>
                            <div class="cardName">Company Analytics</div>
                        </div>
                    
                        <div class="iconBx">
                        </div>
                    </div>

                </a> -->

                

                
            </div>



            <!-- Company Status-->

            <!-- =======================Companies Cards ================== -->
            <h2 style="padding: 30px;">Courses Analysis</h2>
            <div class="cardBox">
                <a href="coursesView_Mangment.php">

                    <div class="card">
                            <div>
                                <div class="cardName">Enroll Someone</div>
                            </div>

                            <div class="iconBx">
                                <i class="fa fa-duotone fa-user-plus"></i>
                            </div>
                    </div>

                </a>

                
                    <div class="card">
                            <div>
                                <div class="cardName">Unenroll Someone</div>
                            </div>

                            <div class="iconBx">
                                <i class="fa fa-duotone fa-user-minus"></i>
                            </div>
                    </div>

                </a>

                
            </div>








    </div>

    <script>
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>
</body>

</html>