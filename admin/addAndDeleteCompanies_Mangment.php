<?php 
include_once 'structuralAdminPage.php';
?>
        
            <!-- ================ Companies List Container================= -->
            <div class="details">
            <?php 
             $select_Companies= mysqli_query($conn, "SELECT * FROM `company` ORDER BY company_id ");
             $Companyies_count = mysqli_num_rows($select_Companies);






            // ADD COMPANY

             if(isset($_POST['submit'])){
   

                $name = mysqli_real_escape_string($conn,$_POST['companyName']);
                $email = mysqli_real_escape_string($conn,$_POST['email'] );
                $pass =mysqli_real_escape_string($conn, $_POST['pass'] );     
                $cpass = mysqli_real_escape_string($conn, $_POST['cpass'] );
           
                
                //check add company
                 
                $select_company = mysqli_query($conn, "SELECT * FROM `company` WHERE company_Email = '$email'");
                
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
                        $insert_company = mysqli_query($conn, "INSERT INTO `company`(company_Name,company_Email	, company_Password , company_Status) VALUES('$name', '$email', '$securePass', 'approved')");
                        
                        echo '
                                <div class="popup" id="popup" style="background: rgb(226, 252, 214);">
                                    <img src="assets/imgs/tick.png" >
                                    <h2 style="color:green;">Thank you!</h2>
                                    <p >new company registered successfully!</p>
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
                        <a href="companys_Management.php" style="display: flex;     place-items: center;" >
                            <i class="fa fa-light fa-circle-chevron-left fa-xl" style="color: #4e6997;"></i>
                            <h2 style="margin: 0 20px;">Companies</h2>
                        </a>
                        <button id="addAdminBtn" class="btn" onclick=showHideAddAdminSection()>Add Companies</button>
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
                         <h3 class="titleHeader">register new Company</h3>
                           
                            <input type="text" style="color: black;" name="companyName" required placeholder="enter company name" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">                   
                         
                         <input type="email" style="color: black;"  pattern="/^[a-zA-Z0-9.!#$%&"*+-/=?\^_"{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" name="email" required placeholder="enter email" maxlength="25"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                         
                         <input type="password" style="color: black;" name="pass" required placeholder="enter password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                         <input type="password" style="color: black;" name="cpass" required placeholder="confirm  password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, "")">
                         <div class="button">
                             <input type="submit" value="register now" id="addADMINbtn" name="submit">
                         </div>
                     </form>

                 </section>
             ';
             if ($Companyies_count >0) { ?>

                    <!-- </form> -->
                    <!-- ================ Admins List ================= -->
                    <section class="adminList">

                        <table >
                            <h3 class="titleHeader">Company List</h3>

                            <!-- ============== Search ============== -->
                            <div style="    display: flex;     flex-direction: row;     border-radius: 20px;     flex-wrap: nowrap;     justify-content: center;     align-items: center;">
                                <i class="fa fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="" id="search-item" placeholder="Search By Company Name" onkeyup="CompanySearch()" style="width: 50%;     height: 30px;     margin-left: 3%;     border: none;     border-radius: 20px;">                            
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
                                    <td>View</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <form action="" method="post">

                                <?php


                                // addmin DELELT 
                                if(isset($_GET['aaid'])){
                                    $aid = $_GET['aaid'];
                                    $delete_admin = mysqli_query($conn, "DELETE FROM `company` WHERE company_id='$aid'");
                                    // print("$delete_admin");
                                    // header("location:companiesView_Mangment.php");

                                }



                                if(isset($_GET['aid']) && isset($_GET['aname'])){
                                    $aid = $_GET['aid'];
                                    $aname = $_GET['aname'];
                                    
                                    echo ' 
                                        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
                                            <img src="assets/imgs/question.jpg" >
                                            <h2 style="color:var(--nav-main);">Question</h2>
                                            <p style="margin-bottom:3rem;">Are you sure you want to delete '.$aname.'?</p>
                                            
                                            
                                            <a href="companiesView_Mangment.php?aaid='.$aid.'" class="choice-btn yes">yes</a>
                                            <a href="companiesView_Mangment.php" class="choice-btn no">No</a>

                                        </div>

                                    ';
                                }

                                ?>



                                <?php
                                
                                
                                    while ($fetch_company = mysqli_fetch_assoc($select_Companies)) {
                                ?>
                                <tr id="singleROW">
                                    <input type="hidden" name="aid" value="<?= $fetch_company['company_id']; ?>">
                                    <input type="hidden" name="aname" value="<?= $fetch_company['company_Name']; ?>">

                                        <td>
                                            <p>
                                                <?= $fetch_company['company_Name']; ?>
                                            </p>
                                        </td>
                                        <td><?= $fetch_company['company_Email']; ?></td>
                                        <td>
                                            <?= $fetch_company['company_Status']; ?>
                                        </td>
                                        

                                        <td><a href="../viewCompanyProfile.php?company_id=<?= $fetch_company['company_id']; ?>" class="foods-btn" target="_blank">View</a></td>

                                        <!--<td><input type="submit" class="delete-btn" name="delete-btn"  value="Delete"></td> -->
                                        <td><a href="companiesView_Mangment.php?aid=<?= $fetch_company['company_id']; ?>&aname=<?= $fetch_company['company_Name']; ?>"  class="delete-btn">Delete</a></td>
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

    <style>
        .foods-btn{
            background-color: #ffd700;
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

        .foods-btn:hover {
            letter-spacing: 0.4rem;
            /* width: 13rem; */
            cursor: pointer;
            
        }
    </style>
</html>