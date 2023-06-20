<?php 
include_once 'structuralAdminPage.php';
?>

          

            
            <!-- ================ Individuals List Container================= -->
            <div class="details">
            <?php 
             $select_Individuals= mysqli_query($conn, "SELECT * FROM `individuals` ORDER BY individual_ID ");
             $Individuals_count = mysqli_num_rows($select_Individuals);






            // ADD COMPANY

             if(isset($_POST['submit'])){
   

                $name = mysqli_real_escape_string($conn,$_POST['individual_Name']);
                $email = mysqli_real_escape_string($conn,$_POST['email'] );
                $pass =mysqli_real_escape_string($conn, $_POST['pass'] );     
                $cpass = mysqli_real_escape_string($conn, $_POST['cpass'] );
           
                
                //check add Individuals is already exists or not
                 
                $select_company = mysqli_query($conn, "SELECT * FROM `individuals` WHERE individual_Email = '$email'");
                
                if(mysqli_num_rows($select_company) > 0){
                    
                    echo '  <div class="popup " id="popup">
                                <img src="assets/imgs/error.jpg" >
                                <h2>Warning!</h2>
                                <p> Email already exists!
                                    </br> Register with new email!
                                </p>
                                <button type="button" onclick="closePopup()">OK</button>
                            </div>
            
                
                 ';
                }else{
                    if($pass != $cpass){ // check passwrod & confirm password if =
                        echo '  <div class="popup " id="popup">
                                    <img src="assets/imgs/error.jpg" >
                                    <h2>Warning!</h2>
                                    <p>confirm password not matched!</br> Try again!</p>
                                    <button type="button" onclick="closePopup()">OK</button>
                                </div>
                         ';
                    }else{
                        $securePass=md5($cpass);
                        $insert_company = mysqli_query($conn, "INSERT INTO `individuals`(individual_Name,individual_Email, individual_Password, individual_Status) VALUES('$name', '$email', '$securePass', 'approved')");
                        
                        echo '
                                <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
                                    <img src="assets/imgs/tick.png" >
                                    <h2 style="color:green;">Thank you!</h2>
                                    <p >New Individuals registered successfully!</p>
                                    <button type="button" style="background: #6fd649;" onclick="closePopup()">OK</button>
                                </div>
                      ';
                        
                    }
                }
                 
            
            
                
            }
            




             echo '
             
             <div class="recentOrders">
                 <!-- <form action="" method="POST"> -->
                 <div class="cardHeader" >
                        <a href="Individuals_Managementy.php" style="display: flex;     place-items: center;" >
                            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                            <h2 style="margin: 0 20px;">Individuals</h2>
                        </a>
                        <button id="addAdminBtn" class="btn" onclick=showHideAddAdminSection()>Add Individuals</button>
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
                         <h3 class="titleHeader">register new  Individuals</h3>
                           
                            <input type="text" style="color: black;" name="individual_Name" required placeholder="Enter Individual Name" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                         
                            <input type="email" style="color: black;"  pattern="/^[a-zA-Z0-9.!#$%&"*+-/=?\^_"{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" name="email" required placeholder="enter email" maxlength="25"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                            
                            <input type="password" style="color: black;" name="pass" required placeholder="enter password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                            <input type="password" style="color: black;" name="cpass" required placeholder="confirm  password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                         <div class="button">
                             <input type="submit" value="register now" id="addADMINbtn" name="submit">
                         </div>
                     </form>

                 </section>
             ';
             if ($Individuals_count >0) { ?>

                    <!-- </form> -->
                    <!-- ================ Admins List ================= -->
                    <section class="adminList">

                        <table >
                            <h3 class="titleHeader">Individuals List</h3>

                            <!-- ============== Search ============== -->
                            <div style="    display: flex;     flex-direction: row;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                <i class="fa fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="" id="search-item" placeholder="Search By Individual Name" onkeyup="CompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
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
                                    <!-- <td>ID</td> -->
                                    <td>Name</td>
                                    <td>Email</td>
                                    
                                    <td>Status</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <form action="" method="post">

                                <?php


                                // addmin DELELT 
                                if(isset($_GET['aaid'])){
                                    $aid = $_GET['aaid'];
                                    $delete_admin = mysqli_query($conn, "DELETE FROM `individuals` WHERE individual_ID='$aid'");
                                    // print("$delete_admin");
                                    // header("location:addAndDeleteIndividuals_Mangment.php");

                                }



                                if(isset($_GET['aid']) && isset($_GET['aname'])){
                                    $aid = $_GET['aid'];
                                    $aname = $_GET['aname'];
                                    
                                    echo ' 
                                        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
                                            <img src="assets/imgs/question.jpg" >
                                            <h2 style="color:var(--nav-main);">Question</h2>
                                            <p style="margin-bottom:3rem;">Are you sure you want to delete 
                                                <span style="color:red">'.$aname.'</span>
                                            ?</p>
                                            
                                            
                                            <a href="addAndDeleteIndividuals_Mangment.php?aaid='.$aid.'" class="choice-btn yes">yes</a>
                                            <a href="addAndDeleteIndividuals_Mangment.php" class="choice-btn no">No</a>

                                        </div>

                                    ';
                                }

                                ?>



                                <?php
                                
                                
                                    while ($fetch_Individual = mysqli_fetch_assoc($select_Individuals)) {
                                ?>
                                <tr id="singleROW">
                                    <input type="hidden" name="aid" value="<?= $fetch_Individual['individual_ID']; ?>">
                                    <input type="hidden" name="aname" value="<?= $fetch_Individual['individual_Name']; ?>">

                                        <td>
                                            <p>
                                                <?= $fetch_Individual['individual_Name']; ?>
                                            </p>
                                        </td>
                                        <td><?= $fetch_Individual['individual_Email']; ?></td>
                                        <td>
                                            <?= $fetch_Individual['individual_Status']; ?>
                                        </td>
                                        
                                        <!--<td><input type="submit" class="delete-btn" name="delete-btn"  value="Delete"></td> -->
                                        <td><a href="addAndDeleteIndividuals_Mangment.php?aid=<?= $fetch_Individual['individual_ID']; ?>&aname=<?= $fetch_Individual['individual_Name']; ?>"  class="delete-btn">Delete</a></td>
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

        <title>Manage Company</title>
    </body>

</html>