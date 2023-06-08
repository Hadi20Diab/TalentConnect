<?php 
include "../connection.php";
session_start();

if(!isset($_SESSION['company_id'])){  //if admin id is not  set in the session, this means the admin  is not logged in and there's a one that's want to access the admin page and we should prevent it in order to allow only the admin that's login correct and save it's id in the session to go to admin page , then we redirect it to the adminLogin page and when he logged in gthen it will store the admin_id in the session and he will be able to go to admin page when he logged in
    header('location:../userRegistration.php');  //only the admin will acces the admin page when he logged in correclty, otherwise it will be redirected to adminLogin.php
  }
else{
    $company_id = $_SESSION['company_id'];
}
?>
<?php

// company LOGOUT
if(isset($_POST['logout-btn'])){
   
    echo ' 
        <div class="popup "  id="popup" style="box-shadow: 0 5px 10px rgba(0,0,0,0.4); background-image: linear-gradient(to top, var(--nav-main), rgb(255, 255, 255)); ">
            <img src="assets/imgs/question.jpg" >
            <h2 style="color:var(--nav-main);">Question</h2>
            <p style="margin-bottom:3rem;">Are you sure you want to logout from website ?</p>
            
            
            <a href="logout.php?" class="choice-btn yes" onclick="admin-logout()">yes</a>
            <a href="#" class="choice-btn no" onclick="closePopup()">No</a>
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
        <!-- ======= Styles ====== -->

        <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" >
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/empty.css">
        <link rel="stylesheet" href="assets/css/profile.css">
        <link rel="stylesheet" href="assets/css/dark.css">
        <link rel="stylesheet" href="assets/css/alert.css">

        <link rel="stylesheet" href="assets/css/customers.css">
        <link rel="stylesheet" href="assets/css/navbar.css">

        
        <!-- Common Style -->
        <link rel="stylesheet" href="assets/css/commonStyle.css">
        <link rel="stylesheet" href="../css/all_icon.css" />

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
                        <a href="companyDashboard.php" id="Dashboard-LeftBar">
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
                        <a href="courses_Management.php" id="CourseManagement-LeftBar">
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
                    <!-- <li>
                        <a href="https://www.tidio.com/panel/conversations" target="_blank">
                            <span class="icon">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </span>
                            <span class="title">Chatbot</span>
                        </a>
                    </li> -->
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
                                $select_profile = mysqli_query($conn, "SELECT company_Name FROM `company` WHERE company_id = '$company_id'");
                                
                                $fetch_profile = mysqli_fetch_assoc($select_profile);
                            ?>
                            <h2 style="text-align: center">
                                <?= $fetch_profile['company_Name']; ?>
                            </h2>
                            <a href="updateProfile.php" class="update-btn" style="box-shadow: 0 5px 10px rgba(0,0,0,0.7);">update profile</a>
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


 <style>
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

    </style>
