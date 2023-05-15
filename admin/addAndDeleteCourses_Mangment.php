<?php 

include "structuralAdminPage.php";
?>


<head>
    <style>
     .empty{
  
  color: var(--black);
  
  background-image: linear-gradient(to bottom, var(--nav-main), rgb(255, 255, 255));
   
  
 }  
.choice-btn{
    padding: 0.7rem;
    width: 30px;
    border-radius: 10px;
    color: #fff;
    font-weight: 400;
    font-size: large;
    background-color: var(--nav-main);
    
    transition: 1s ease;
    margin-left:2rem;
    box-shadow: 0 5px 10px rgba(0,0,0,0.7);
}
.yes:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: #39ff14;
}
.no:hover{
    width: 40rem;         
    cursor: pointer;
    background-color: red;
}


   .details{
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    width: 100%;
  }
    .foods-btn{
        background-color:#ffd700;
        color: var(--white);
        border-radius: 10px;
        text-decoration: none;
        width: 11rem;
        padding: 0.7rem;
        font-weight: 400;
        font-size: large;
        border: none;
        transition: 0.5s ease;
    }
    .foods-btn:hover{
      
      letter-spacing: 0.4rem;
      width: 13rem;
      cursor: pointer;

    }
    .navigation ul li a.actived::before,
    .navigation ul li a.actived::before{
      content: "";
      position: absolute;
      right: 0;
      top: -50px;
      width: 50px;
      height: 50px;
      background-color: transparent;
      border-radius: 50%;
      box-shadow: 35px 35px 0 10px var(--white);
      pointer-events: none;
    }
    .navigation ul li a.actived::after,
    .navigation ul li a.actived::after {
      content: "";
      position: absolute;
      right: 0;
      bottom: -50px;
      width: 50px;
      height: 50px;
      background-color: transparent;
      border-radius: 50%;
      box-shadow: 35px -35px 0 10px var(--white);
      pointer-events: none;
    }

    .navigation ul li a.actived {
      color: var(--nav-main);
      background-color: var(--white);
    }
    .textarea-message{
        border: none;
        resize: none;
    }
    .textarea-message:focus{
        outline: none;
    }
    tr:hover .textarea-message{
        color: inherit;
        background-color: inherit;

    }
    .textarea-message::-webkit-scrollbar {
        width: 5px;
    }
    /* Track */
    .textarea-message::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey;
      border-radius: 10px;
    }
    /* Handle */
    .textarea-message::-webkit-scrollbar-thumb {
      background: #3e3e3e;
      border-radius: 10px;
    }    
    </style>
</head>
            
            <!-- ================ Companies List Container================= -->
    <div class="details" style="margin: 0 10%;">
            <?php 
             $select_Courses_List= mysqli_query($conn, "SELECT * FROM `courses`");
             $Courses_count = mysqli_num_rows($select_Courses_List);

            // ADD COMPANY

            if(isset($_POST['submit'])){
   
                $course_name = mysqli_real_escape_string($conn,$_POST['course_name']);
                $course_description = mysqli_real_escape_string($conn,$_POST['course_description'] );
                $course_instructor =mysqli_real_escape_string($conn, $_POST['course_instructor'] );     
                $course_creator = mysqli_real_escape_string($conn, $_POST['course_creator'] );
                $course_category = mysqli_real_escape_string($conn, $_POST['course_category'] );
                $course_fees = mysqli_real_escape_string($conn, $_POST['course_fees'] );
           

                $insert_course = mysqli_query($conn, "INSERT INTO `courses`(course_name,course_description	, course_instructor , course_creator, course_category, course_fees) VALUES('$course_name', '$course_description', '$course_instructor', '$course_creator', '$course_category', '$course_fees')");
                        
                echo '
                        <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
                            <img src="assets/imgs/tick.png" >
                            <h2 style="color:green;">Thank you!</h2>
                            <p >Course Added Successfully!</p>
                            <button type="button" style="background: #6fd649;" onclick="closePopup()">OK</button>
                        </div>
                ';
                        
            }




            echo '
             
             <div class="recentOrders">
                 <!-- <form action="" method="POST"> -->
                 <div class="cardHeader" >
                        <a href="courses_Management.php" style="display: flex;     place-items: center;" >
                            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                            <h2 style="margin: 0 20px;">Courses</h2>
                        </a>
                        <button id="addAdminBtn" class="btn" onclick=showHideAddAdminSection()>Add Courses</button>
                 </div>



                 <!-- ================ Add Companyies ================ -->

                 <script>
                     
                     function showHideAddAdminSection() {
                         var addAdminBtn=document.getElementById("addAdminBtn");
                         var addAdminSection=document.getElementById("addAdminSection");
                         var addAdminBtnSubmit=document.getElementById("addADMINbtn");

                         if (addAdminSection.classList[1] == "addAdminSectionShow"){
                             addAdminSection.classList.remove("addAdminSectionShow");
             
                         }
                         else{
                             addAdminSection.classList.add("addAdminSectionShow");
     
                         }
                         
                     }


                     addAdminSubmit.onclick=function(){
                         showAddAdminSection();
                     }
                     addAdminBtn.onclick=function(){
                         hideAddAdminSection();
                     }

              
                 </script>
                 <link rel="stylesheet" href="assets/css/add-admin.css">


                    <section class="addAdminSection" id="addAdminSection">
                     <form action="" method="post">
                         <h3 class="titleHeader">Add New Courses</h3>
                         <input type="text" style="color: black;" name="course_name" required placeholder="Course Name" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                         
                         <input type="text" style="color: black;" name="course_description" required placeholder="Course Description" class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                         <input type="text" style="color: black;" name="course_instructor" required placeholder="Instructor Name" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                         
                         
                         <select name="course_creator" id="" style="padding: 1.2rem;     width: 90%;     margin: 4% 5%;     border-radius: 0.8rem;">
                            <option value="">->Course Creator <-</option>
                            ';

                            $select_companies = mysqli_query($conn, "SELECT * FROM `company`");
                                
                            $fetch_companies = mysqli_fetch_assoc($select_companies);
                            

                                
                            while ($fetch_company = mysqli_fetch_assoc($select_Companies)) {
                                echo"
                                    <option value=" . $fetch_company['company_Name'] . " > " .$fetch_company['company_Name']. " </option>
                                ";
                                
                            }
                
                    ?>  
                    </select>
                    <select name="course_category" id="" style="padding: 1.2rem;     width: 90%;     margin: 4% 5%;     border-radius: 0.8rem;">
                            <option value="">->Course Creator <-</option>
                    
                    <?php
                            $select_categories = mysqli_query($conn, "SELECT * FROM `categories`");
                                
                            while ($select_categoy = mysqli_fetch_assoc($select_categories)) {
                                echo"
                                    <option value=" . $select_categoy['category_name'] . " > " .$select_categoy['category_name']. " </option>
                                ";
                                
                            }
                            
                            echo'
                         </select>
                         
                         <input type="number" style="color: black;" name="course_fees" required placeholder="Courses Fees in $" maxlength="10"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   


                         <div class="button">
                             <input type="submit" value="Add Now" id="addADMINbtn" name="submit">
                         </div>
                     </form>

                 </section>
             ';
             if ($Courses_count >0) { ?>

                    <!-- </form> -->
                    <!-- ================ Admins List ================= -->
                    <section class="adminList">

                        <table >
                            <h3 class="titleHeader">Courses List</h3>

                            <!-- ============== Search ============== -->
                            <div style="    display: flex;     flex-direction: row;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                <i class="fa fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="" id="search-item" placeholder="Search By Course Name" onkeyup="CompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
                            </div>
    

                            <script type="text/javascript">
                                function CompanySearch() {
                                    let filter = document.getElementById('search-item').value.toUpperCase();
                                    let singleROW = document.querySelectorAll('#singleROW');
                                    let l = document.getElementsByTagName('p');
                                    
                                    for(var i = 0; i<=l.length ;i++){
                                        let match=singleROW[i].getElementsByTagName('p')[0];
                                        let value=match.innerHTML || match.innerText || match.textContent;
                                        
                                        
                                        if(value.toUpperCase().indexOf(filter) > -1) {
                                            singleROW[i].style.display="";
                                        }
                                        else
                                        {
                                            singleROW[i].style.display="none";
                                        }
                                    }
                                }
                            </script>





                            <thead>
                                <tr>
                                    <td>Course Name</td>
                                    <td>Instructor</td>
                                    <td>Creator</td>
                                    <td>Category</td>
                                    <td>Fees</td>
                                    <td>Description</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <form action="" method="post">

                                <?php


                                // addmin DELELT 
                                if(isset($_GET['ccid'])){
                                    $cid = $_GET['ccid'];
                                    $delete_course = mysqli_query($conn, "DELETE FROM `courses` WHERE course_ID='$cid'");
                                    // print("$delete_admin");
                                    // header("location:addAndDeleteCourses_Mangment.php");

                                }



                                if(isset($_GET['cid']) && isset($_GET['cname'])){
                                    $cid = $_GET['cid'];
                                    $cname = $_GET['cname'];
                                    
                                    echo ' 
                                        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
                                            <img src="assets/imgs/question.jpg" >
                                            <h2 style="color:var(--nav-main);">Question</h2>
                                            <p style="margin-bottom:3rem;">Are you sure you want to delete '.$cname.'?</p>
                                            
                                            
                                            <a href="addAndDeleteCourses_Mangment.php?ccid='.$cid.'" class="choice-btn yes">yes</a>
                                            <a href="addAndDeleteCourses_Mangment.php" class="choice-btn no">No</a>

                                        </div>

                                    ';
                                }

                                ?>



                                <?php
                                
                                
                                    while ($fetch_course = mysqli_fetch_assoc($select_Courses_List)) {
                                ?>
                                <tr id="singleROW">
                                        <td>
                                            <p>
                                                <?= $fetch_course['course_Name']; ?>
                                            </p>
                                        </td>
                                        
                                        <td>
                                            <?= $fetch_course['course_Instructor']; ?>
                                        </td>
                                        <td>
                                            <?= $fetch_course['course_Creator']; ?>
                                        </td>
                                        <td>
                                            <?= $fetch_course['course_Category']; ?>
                                        </td>
                                        <td>
                                            <?= $fetch_course['course_Fees']; ?>
                                        </td>
                                        
                                        <td>
                                            <textarea name="" id="" readonly style="width: 200px;     min-height: 50px;   resize: vertical;     border: none;     border-radius: 10px;">
                                                <?= $fetch_course['course_Description']; ?>
                                            </textarea>
                                        </td>
                                        <!--<td><input type="submit" class="delete-btn" name="delete-btn"  value="Delete"></td> -->
                                        <td><a href="addAndDeleteCourses_Mangment.php?cid=<?= $fetch_course['course_ID']; ?>&cname=<?= $fetch_course['course_Name']; ?>"  class="delete-btn">Delete</a></td>
                                    </tr>
                                    <?php
                            }
                        
                            ?>  
                                </form>
                            </tbody>
                        </table>
                    </section>
                </div>

                <?php }
            else{
                echo '<p class="empty">no admins added yet!</p>';
            } ?>
                            
                
                
            </div>
        </div>
    </div>


    <!-- main div closes tag -->
    </div>
    <script>
        
        function closePopup(){
            var popup = document.getElementById("popup");
            popup.classList.add("open-popup");
        } 
    </script>

    <title>Add/Delete Courses</title>
    <script>
        document.getElementById("CourseManagement-LeftBar").classList.add("actived");
    </script>
</body>

</html>