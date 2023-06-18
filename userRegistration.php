<?php 
include "connection.php";
session_start();
error_reporting(0);

// if user logged in and be in home page , then we don't allow it to access again the login page because its already logged in
if(isset($_SESSION['company_id'])){  //if company id is set in the session, this means he registerd and its value in the sessino, then we redirect it to the home page and when logged in to  home page and want to go again to login page , then he can't go to it because we write here that's if user id in session then redurect it to home page
 header('location:company/home.php');
}
if(isset($_SESSION['university_ID'])){  //if user id is set in the session, this means he registerd and its value in the sessino, then we redirect it to the home page and when logged in to home page and want to go again to login page , then he can't go to it because we write here that's if user id in session then redurect it to home page
 header('location:university/home.php');
}
if(isset($_SESSION['individual_ID'])){  //if user id is set in the session, this means he registerd and its value in the sessino, then we redirect it to the home page and when logged in to home page and want to go again to login page , then he can't go to it because we write here that's if user id in session then redurect it to home page
 header('location:individual/home.php');
}


//this will be executed when we press on the sign up button
if (isset($_POST['signup-btn'])) {
    // $username = mysqli_real_escape_string($conn, $_POST['signup-username']);//we get the value of entered value by user fromn $_post by using this method in order to prevent the sql injection from hacker
    $email = mysqli_real_escape_string($conn, $_POST['signup-email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['signup-password'])); //we use md5 to encrypt the password that's user enetered it
    $passwordConf = mysqli_real_escape_string($conn, md5($_POST['passwordConf']));

    // $image= $_FILES['image']['name'];
    // $image_size = $_FILES['image']['size'];
    // $image_tmp_name = $_FILES['image']['tmp_name'];
    // // $image_folder = 'uploaded_img/'.$image;

    //get the type of user
    $type = $_POST['type'];

if ($type === 'company') {

    //check if email aleardy exists in our database
    $resultemail = mysqli_query($conn, "SELECT company_Email FROM `company` WHERE email='$email'");

    $check_email = mysqli_num_rows($resultemail);



    if ($check_email > 0) {  //we check if email is already exits
      echo '<div class="popup " id="popup">
      <img src="admin/assets/imgs/error.jpg" >
      <h2>Warning!</h2>
      <p>Email already exists!</br> Register with new email!</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
    } else {
        if ($password !== $passwordConf) {
          echo '<div class="popup " id="popup">
          <img src="admin/assets/imgs/error.jpg" >
          <h2>Warning!</h2>
          <p>confirm password not matched!</br> Try again!</p>
          <button type="button" onclick="closePopup()">OK</button>
      </div>
      
          
           ';
        } else {
            $sql = "INSERT INTO `company` (company_Name, company_Email, company_Password) VALUES ('$name', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {

                $_SESSION['company_id'] = $row['company_id'];
                $_SESSION['company_Email'] = $row['company_Email'];

                header("location: company/updateProfile.php");

            } else {  //if registration failed in database
                

                echo '<div class="popup " id="popup">
                <img src="admin/assets/imgs/error.jpg" >
                <h2>Warning!</h2>
                <p>User registration failed!</br>Please try again!</p>
                <button type="button" onclick="closePopup()">OK</button>
            </div>
            
                
              ';
            }
        }
    }
}
  elseif($type === 'university'){
   
    //check if email aleardy exists in our database
    $resultemail = mysqli_query($conn, "SELECT university_Email FROM `universities` WHERE university_Email='$email'");
    
    $check_email = mysqli_num_rows($resultemail);
   
    
  
    if ($check_email > 0) {  //we check if email is already exits
      echo '<div class="popup " id="popup">
      <img src="admin/assets/imgs/error.jpg" >
      <h2>Warning!</h2>
      <p>Email already exists!</br> Register with new email!</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
    } else {
      if ($password !== $passwordConf) {
        echo '<div class="popup " id="popup">
        <img src="admin/assets/imgs/error.jpg" >
        <h2>Warning!</h2>
        <p>confirm password not matched!</br> Try again!</p>
        <button type="button" onclick="closePopup()">OK</button>
    </div>
    
        
         ';
      } else {
          $sql = "INSERT INTO `universities` (university_Name, 	university_Email, university_password, university_Logo) VALUES ('$name', '$email', '$password','$image')";
          $result = mysqli_query($conn, $sql);
          if ($result) {

            $_SESSION['university_ID'] = $row['university_ID'];
            $_SESSION['university_Email'] = $row['university_Email'];

            header("location: university/updateProfile.php");
  
              
          } else {  //if registration failed in database
            echo '<div class="popup " id="popup">
            <img src="admin/assets/imgs/error.jpg" >
            <h2>Warning!</h2>
            <p>resataurant registration failed!</br> try again!</p>
            <button type="button" onclick="closePopup()">OK</button>
        </div>
        
            
             ';
          }
      }
  }
  } 
  elseif($type === 'individuals'){
    //check if email aleardy exists in our database
    $resultemail = mysqli_query($conn, "SELECT individual_Email FROM `individuals` WHERE individual_Email='$email'");
    
    $check_email = mysqli_num_rows($resultemail);
    
  
    if ($check_email > 0) {  //we check if email is already exits
      echo '<div class="popup " id="popup">
                <img src="admin/assets/imgs/error.jpg" >
                <h2>Warning!</h2>
                <p>Email already exists!</br> Register with new email!</p>
                <button type="button" onclick="closePopup()">OK</button>
            </div>
      ';
    } else {
      if ($password !== $passwordConf) {
        echo '<div class="popup " id="popup">
                  <img src="admin/assets/imgs/error.jpg" >
                  <h2>Warning!</h2>
                  <p>confirm password not matched!</br> Try again!</p>
                  <button type="button" onclick="closePopup()">OK</button>
              </div>
         ';
      } else {
          $sql = "INSERT INTO `individuals` (individual_Name, individual_Email, individual_Password, 	individual_Status) VALUES ('$name', '$email', '$password', 'pending')";
          $result = mysqli_query($conn, $sql);

          if ($result) {
            
            $_SESSION['individual_ID'] = $row['individual_ID'];
            $_SESSION['individual_Email'] = $row['individual_Email'];
            
            
            header("location: individual/updateProfile.php");
              
          } else {  //if registration failed in database
            echo '<div class="popup " id="popup">
                      <img src="admin/assets/imgs/error.jpg" >
                      <h2>Warning!</h2>
                      <p>Individual registration failed!</br> try again!</p>
                      <button type="button" onclick="closePopup()">OK</button>
                  </div>
            ';
          }
      }
  }


  }
}


//this will be executed when we press on the login button
if(isset($_POST['login-btn'])){
  
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']) ); //we use md5 to encrypt the password that's user enetered it
  
 $type = $_POST['type'];
//if the user is a customer
if ($type === 'company') {
    $result = mysqli_query($conn, "SELECT * FROM `company` WHERE company_Email='$email' AND company_Password= '$password'");
    $check_user = mysqli_num_rows($result);

    if ($check_user > 0) {   //if the user registerd in our website, then he successfully logged in
        $row = mysqli_fetch_assoc($result);
        $status = $row['company_Status'];

        if ($status == 'approved') {
            $_SESSION['company_id'] = $row['company_id'];
            $_SESSION['company_Email'] = $row['company_Email'];

            // $_POST['email'] = '';  //we put it empty to remove the writing of user from inputs fields when hi logged in successfully
            // $_POST['password'] = '';
            header("location: company/companyDashboard.php");
        }
        elseif($status == 'blocked'){
          echo '<div class="popup " id="popup">
      <img src="admin/assets/imgs/error.jpg" >
      <h2>Oooops!</h2>
      <p>You are not allowed to Login to our website. Since you are blocked by admin.</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
        }

        elseif($status == 'pending'){
          echo '<div class="popup " id="popup" style="     background: rgb(190 240 143); "
          >
      <img src="admin/assets/imgs/pending.png" >
      <h2>Your account is currently pending approval.</h2>
      <p>Please wait for further instructions or contact the administrator for more information.</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
        }
     } else { //if user didn't registered in our website
      echo '<div class="popup " id="popup">
      <img src="admin/assets/imgs/error.jpg" >
      <h2>Warning!</h2>
      <p>Login details is incorrect!</br> Please,make sure you entered the correct login information!</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
    }

}

//if the user is university
elseif($type === 'universities'){
 
  $result = mysqli_query($conn, "SELECT * FROM `universities` WHERE (	university_Email='$email' OR university_Name='$email') AND university_password= '$password'");
  $check_restaurant = mysqli_num_rows($result);

if($check_restaurant > 0){   //if the user registerd in our website, then he successfully logged in
    $row = mysqli_fetch_assoc($result);
    $status = $row["status"];
    
    

    if ($status == "approved") {
        $_SESSION['university_ID'] = $row['id'];
        $_POST['email'] = '';  //we put it empty to remove the writing of user from inputs fields when hi logged in successfully
        $_POST['password'] = '';

        header("location: university/home.php");
    } elseif ($status == "blocked") {
        
        echo '<div class="popup " id="popup">
      <img src="admin/assets/imgs/error.jpg" >
      <h2>Oooops!</h2>
      <p>You are not allowed to login.Since you are block by admin.</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';
    } elseif($status == "pending") {
      
      echo '<div class="popup " id="popup" style="     background: rgb(190 240 143); ">
      <img src="admin/assets/imgs/pending.png" >
      <h2>Pending university verification</h2>
      <p>We are in the process of verifying your university account. Thank you for your cooperation.</p>
      <button type="button" onclick="closePopup()">OK</button>
  </div>
  
      
       ';

    }
} 
else{ //if user didn't registered in our website
  echo '<div class="popup " id="popup">
  <img src="admin/assets/imgs/error.jpg" >
  <h2>We are unable to find a registered university with the provided credentials!</h2>
  <p>Please make sure you have registered your university account with our website before attempting to sign in.</p>
  <button type="button" onclick="closePopup()">OK</button>
</div>

  
   ';
  }
  
}

//if the user a individual man

elseif($type === 'individuals'){
  
  $result = mysqli_query($conn, "SELECT * FROM `individuals` WHERE individual_Email='$email'");// AND individual_Password= '$password'
  $check_individual = mysqli_num_rows($result);

  if($check_individual > 0){   //if the user registerd in our website, then he successfully logged in
    $row = mysqli_fetch_assoc($result);
    $status = $row['individual_Status'];
    $individual_Password = $row['individual_Password'];
    if ($status === 'approved' && $individual_Password == $password) {
        $_SESSION['individual_ID'] = $row['individual_ID'];
        $_POST['individual_Email'] = '';  //we put it empty to remove the writing of user from inputs fields when hi logged in successfully
        $_POST['individual_Password'] = '';

        header("location: individual/home.php");
    }
    elseif($individual_Password != $password){
      echo '<div class="popup " id="popup">
                <img src="admin/assets/imgs/error.jpg" >
                <h2>Oooops!</h2>
                <p>It looks like the password you provided is incorrect. <br> If you\'ve forgotten your password, you can use our \'Forgot Password\' feature to reset it.</p>
                <button type="button" onclick="closePopup()">OK</button>
              </div>
      ';
    }
    elseif ($status === "blocked") {
        
        echo '<div class="popup " id="popup">
                <img src="admin/assets/imgs/error.jpg" >
                <h2>Oooops!</h2>
                <p>Your account has been blocked from accessing our services. <br> Please contact our support team for assistance.</p>
                <button type="button" onclick="closePopup()">OK</button>
              </div>
  
      
       ';
    } elseif($status === "pending") {
      
      echo '<div class="popup " id="popup" style="     background: rgb(190 240 143); ">
              <img src="admin/assets/imgs/pending.png" >
              <h2>Our team is currently reviewing your account details. </h2>
              <p>Please stay tuned for further instructions or contact our support team for more information.</p>
              <button type="button" onclick="closePopup()">OK</button>
            </div>    
       ';
    }
  }
  else{ //if user didn't registered in our website
    echo '<div class="popup " id="popup">
    <img src="admin/assets/imgs/error.jpg" >
    <h2>Warning!</h2>
    <p>We couldn\'t find any record of your registration in our system</br>Please sign up for a new account to continue.</p>
    <button type="button" onclick="closePopup()">OK</button>
  </div>
  
    
     ';
  }
  
} 



}

?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script> -->

    <!-- font awesome cdn link  -->
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"> -->
   <link rel="stylesheet" href="css/all_icon.css">
   <link rel="stylesheet" href="css/dark.css">
   <link rel="stylesheet" href="css/alert.css">
    <script src="js/app.js"></script>

    <link rel="stylesheet" href="css/regStyle.css" />
    <title>Sign in & Sign up Form</title>

    <style>

      .homepg{
        text-decoration: none;
        color: var(--switchers-main);
        margin-top: .7rem;
      }
      .homepg:hover{
        text-decoration: underline;
        text-decoration-color: var(--switchers-main);
      }
      .container:before {
        content: "";
        position: absolute;
        height: 2000px;
        width: 2000px;
        top: -10%;
        right: 48%;
        transform: translateY(-50%);
        background-image: linear-gradient(-45deg, var(--switchers-main) 0%, #3a3a3b 100%);
        transition: 1.8s ease-in-out;
        border-radius: 50%;
        z-index: 6;
      }
      .radio-group{
        background-color: #f5f5f5;
        border-radius: 55px;
        padding-right: 10px;
        margin-bottom: 10px;
      }
      .radio{
        font-size: 20px;
        font-weight: 600;
        text-transform: capitalize;
        display: inline-block;
        vertical-align: middle;
       /* color: #333; */
        color: var(--switchers-main);
        position: relative;
        padding-left: 30px;
        cursor: pointer;
        margin-left: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
      }

      .radio + .radio{
        margin-left: 20px;

      }
      .radio input[type="radio"]{
        display: none;
      }
      .radio span{
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 3px solid var(--switchers-main);
        display: block;
        position: absolute;
        left: 0;
        top: 7px;
      }
      .radio span:after{
        content: "";
        height: 8px;
        width: 8px;
        background:var(--switchers-main) ;
        display: block;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale(0);
        border-radius: 50%;
        transition: 300ms ease-in-out 0s;
      }
      .radio input[type = "radio"]:checked ~ span:after {
        transform: translate(-50%, -50%) scale(1);
      }

      #sign-up-btn, #sign-in-btn{
        border-radius:25px ;
        width: 250px;
        background:none;
        border:3px solid var(--white);
        text-transform: uppercase;
        padding: 12px 20px ;
        font-weight: 700;
        min-width: 200px;
        cursor: pointer;
        transition: color 0.4s linear;
        color: var(--white);
        position: relative;
      }
      #sign-up-btn:hover  , #sign-in-btn:hover{
          color: #fff;
          background: var(--nav-main);
      }
      #sign-up-btn::before, #sign-in-btn::before{
          content: "";
          position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background: var(--nav-main);
          z-index: -1;
          transition: transform 0.5s;
          transform-origin: 0 0;
          transition-timing-function: cubic-bezier(0.5, 1.6,0.4, 0.7);
          transform: scaleX(0);
      }

      #sign-up-btn:hover::before, #sign-in-btn:hover::before{
          transform: scaleX(1);
      }
      .btn{
        transform: 0.7s ease;
      }
      .btn:hover{
        transition: scale(1.1);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="userRegistration.php" method="post"  class="sign-in-form">
            <h2 class="title" style='color: var(--switchers-main)'>Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" value="<?php echo  $_POST['email']; ?>" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" id= "password" placeholder="Password" value="<?php echo  $_POST['password']?>" name="password" require/>
            </div>
           <!-- radio button -->
            <div class="radio-group" >
              <label class="radio" >
                <input type="radio"  value="company" name="type" >
                Company
                <span></span>
              </label>
              <label class="radio" >
                <input type="radio"  value="university" name="type">
                University
                <span></span>
              </label>
              <label class="radio"  >
                <input type="radio"  value="individuals" name="type">
                Individuals
                <span></span>
              </label>                           

            </div>            
             <div class="show-pass">
             <label style="color:var(--switchers-main) ; cursor:pointer;margin: 15px auto;" class="check_1">
                <input type="checkbox"  id="showPassword" onclick="show();" >
                Show Password
            </label>
             </div>
            
            
            
            <input type="submit" value="Login" class="btn solid" name="login-btn" />
            <a href="home.php" class="homepg">Home</a>
          </form>
          <form action="userRegistration.php" enctype="multipart/form-data" method="post" class="sign-up-form">
            <h2 class="title" style='color: var(--switchers-main)'>Sign up</h2>
            <!-- <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" value="<?php //echo  $_POST['signup-username']?>" name="signup-username" required/>
            </div> -->
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'  placeholder="Email"  value="<?php echo  $_POST['signup-email']?>" name="signup-email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" id="pass1" placeholder="Password"  value="<?php echo  $_POST['signup-password']?>" name="signup-password" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" id="pass2" placeholder="Confirm Password"  value="<?php echo  $_POST['passwordConf']?>" name="passwordConf" required/>
            </div>
            <!-- <div class="input-field">
              <i class="fa-solid fa-file-image"></i>
              <input style="margin-top:15px ;" type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
            </div> -->

            <!-- radio button -->
            <div class="radio-group">
              <label class="radio" >
                <input type="radio" value="company" name="type" >
                Company
                <span></span>
              </label>
              <label class="radio" >
                <input type="radio" value="university" name="type">
                University
                <span></span>
              </label>
              <label class="radio" >
                <input type="radio" value="individuals" name="type">
                Individuals
                <span></span>
              </label>                           

            </div>


            <div class="show-pass">
             <label style="color:var(--switchers-main) ; cursor:pointer;margin: 15px auto;" class="check_1">
                <input type="checkbox"  id="showPass"  >
                Show Password
            </label>
             </div>
            <input type="submit"  class="btn" value="Sign up" name="signup-btn"/>
             
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              If you don't have an account, please sign up firstly to create one.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="images/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
              Did you sign up? if you have already sign up. You can sign in here.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="images/register.svg" class="image" alt="" />
        </div>
      </div>
      
    </div>

    <script>
      let popup = document.getElementById("popup");

      function closePopup(){
        popup.classList.add("open-popup");

      }
    </script>

    <script src="js/regDynamic.js"></script>
    <script src="js/dark.js"></script>


    <!-- script for login chatbot -->
    <script src="//code.tidio.co/venffcc1urcyn1ttmknvxxonqm0gukpw.js" async></script>

  </body>
</html>