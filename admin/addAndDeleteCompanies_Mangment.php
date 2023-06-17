<?php 

include_once '../connection.php';
session_start();
if(!isset($_SESSION['admin_id'])){  //if admin id is not  set in the session, this means the admin  is not logged in and there's a one that's want to access the admin page and we should prevent it in order to allow only the admin that's login correct and save it's id in the session to go to admin page , then we redirect it to the adminLogin page and when he logged in gthen it will store the admin_id in the session and he will be able to go to admin page when he logged in
    header('location:adminLogin.php');  //only the admin will acces the admin page when he logged in correclty, otherwise it will be redirected to adminLogin.php
  }
else{
    $admin_id = $_SESSION['admin_id'];
}

// admin LOGOUT
if(isset($_POST['logout-btn'])){
   
    echo ' 
        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
            <img src="assets/imgs/question.jpg" >
            <h2 style="color:var(--nav-main);">Question</h2>
            <p style="margin-bottom:3rem;">Are you sure you want to logout from website ?</p>
            
            
            <a href="adminLogin.php" class="choice-btn yes">yes</a>
            <a href="" class="choice-btn no">No</a>

        </div>
    ';  
}

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- <title>Admins</title> -->
        <!-- ======= Styles ====== -->
        <link rel="stylesheet" href="../css/all_icon.css" />

        <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" >
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/empty.css">
        <link rel="stylesheet" href="assets/css/profile.css">
        <link rel="stylesheet" href="assets/css/dark.css">
        <link rel="stylesheet" href="assets/css/alert.css">
        
        <!-- Common Style -->
        <link rel="stylesheet" href="assets/css/commonStyle.css">

        <style>

            .delete-btn{
                padding: 10%;
                width: 7rem;
                border-radius: 10px;
                color: #fff;
                font-weight: 400;
                font-size: large;
                background-color: red;
                border: none;
                transition: 0.5s ease;
            }
                
            .delete-btn:hover{
                width: 8rem;
                
                cursor: pointer;
                
                
            }
        </style>
    </head>
        
    <body>
        <!-- =============== Navigation ================ -->
        <div class="container">


            <div class="navigation">
                <ul>
                    <li>
                        <a href="home.html" >

                            <span class="title" style="font-weight:600 ; font-size:25px; display: flex;     padding-top: 2px;     margin-left: -13px;">
                                <img src="assets/imgs/talentConnectLOGO.png" style="height: 100%; filter: invert(0.9);" alt="">
                                TalentConnect
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="index.php" id="Dashboard-LeftBar">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- <li>
                        <a href="customers.php" id="UserManagement-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/1570/1570102.png" alt="">

                                <ion-icon name="people-outline" class="fa-light fa-bars-progress"></ion-icon>
                            </span>
                            <span class="title">User Management</span>
                        </a>
                    </li> -->

                    <li>
                        <a href="restaurants.php" id="CourseManagement-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/2832/2832673.png" alt="">
                                <!-- <ion-icon name="storefront-outline"></ion-icon> -->
                            </span>
                            <span class="title">Course Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="delivery.php" id="InternshipManagement-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8920/8920564.png" alt="">
                                <!-- <i class="fa-solid fa-truck"></i> -->
                            </span>
                            <span class="title">Internship Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="food-categories.php" id="ScholarshipManagement-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8920/8920733.png" alt="">
                                <!-- <ion-icon name="grid-outline"></ion-icon> -->
                            </span>
                            <span class="title">Scholarship Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="foods.php" id="JobManagement-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/8388/8388689.png" alt="">
                                <!-- <ion-icon name="fast-food-outline"></ion-icon> -->
                            </span>
                            <span class="title">Job Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="feedback.php" id="Feedback-LeftBar">
                            <span class="icon">
                                <img class="imgIcon" src="https://cdn-icons-png.flaticon.com/512/2450/2450969.png" alt="">
                                <!-- <ion-icon name="cart-outline"></ion-icon> -->
                            </span>
                            <span class="title">Feedback and Suggestions</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="admins.php" id="admins-LeftBar">
                            <span class="icon">

                            <!-- <i class="fa fa-light fa-user-plus fa-xl"></i> -->
                            <ion-icon name="person-add-outline"></ion-icon>
                            </span>
                            <span class="title">Admins</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="messages.php">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Messages</span>
                        </a>
                    </li>
                    <li>
                        <a href="reviews.php">
                            <span class="icon">
                                <ion-icon name="star-half-outline"></ion-icon>
                            </span>
                            <span class="title">Reviews</span>
                        </a>
                    </li>
                    <li>
                        <a href="about-us.php">
                            <span class="icon">
                                <ion-icon name="information-circle-outline"></ion-icon>
                            </span>
                            <span class="title">About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="faq.php">
                            <span class="icon">
                                <ion-icon name="help-circle-outline"></ion-icon>
                            </span>
                            <span class="title">FAQ</span>
                        </a>
                    </li> --> 
                    <li>
                        <a href="https://www.tidio.com/panel/conversations" target="_blank">
                            <span class="icon">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </span>
                            <span class="title">Chatbot</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!--  =============== topbar ===============  -->

                <!-- ========================= Main ==================== -->
            <div class="main">
                <div class="topbar" style="box-shadow:0 .5rem 1rem rgba(0,0,0,.1); height:5rem;">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
                    <div class="appearance">
                        <div class="light-dark">
                            <i class="btn fas fa-moon" data-color="#e4e6eb #e4e6eb #24292D #24292D #242526"></i>
                        </div>
                        <div class="color-icon">
                            <div class="icons">
                                <i class="fas fa-palette"></i>
                                <i class="fas fa-sort-down arrow"></i>
                            </div>
                            <div class="color-box">
                                <h3>Color Switcher</h3>
                                <div class="color-switchers">
                                    <button class="btn blue active" data-color="#fff #24292d #4070f4 #0b3cc1 #F0F8FF"></button>
                                    <button class="btn orange" data-color="#fff #242526 #F79F1F #DD8808 #fef5e6"></button>
                                    <button class="btn purple" data-color="#fff #242526 #8e44ad #783993 #eadaf1"></button>
                                    <button class="btn green" data-color="#fff #242526 #3A9943 #2A6F31 #DAF1DC"></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="user" style="border-radius:50%; margin-right:2rem; width:3rem; height:3rem; ">
                        <ion-icon name="person-outline" id="user-btn" style=" margin:.5rem; font-size:40px; font-weight:500;margin-left:.3rem;margin-right:5rem;  border-radius:50%;"></ion-icon>
                    </div>
                    

                    <div class="profile"  style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255));">
                
                        <form action="" method="post">
                            <?php
                                $select_profile = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id = '$admin_id'");
                                
                                $fetch_profile = mysqli_fetch_assoc($select_profile);
                            ?>
                            <p>
                                <? $fetch_profile['admin_Name']; ?>
                            </p>
                            <a href="update_profile.php" class="update-btn" style="box-shadow: 0 5px 10px rgba(0,0,0,0.7);">update profile</a>
                            <div class="flex-btn">
                            
                                <input type="submit" class="logout-btn" name="logout-btn" value="Logout" style="box-shadow: 0 5px 10px rgba(0,0,0,0.7);">
                            </div>
                            <!-- <a href="../home.php" class="home-btn" style="box-shadow: 0 5px 10px rgba(0,0,0,0.7);">Home page</a>  -->
                        </form>
                    </div>
                </div>


        
        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>
        <script src="assets/js/dark.js"></script>
        <script>
            let navbar = document.querySelector('.navigation');
            let profile = document.querySelector(' .profile');


            document.querySelector('#user-btn').onclick = () =>{
                profile.classList.toggle('active');
                navbar.classList.remove('active');
            }
            let popup = document.getElementById("popup");

                

            function closePopup(){
                popup.classList.add("open-popup");
            } 
        </script>
        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <!-- </div> -->
            <!-- open Closes-tag div to make the new page inside the main DIV -->

<!--         
    </body>

</html>
 -->




            

            
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

</html>