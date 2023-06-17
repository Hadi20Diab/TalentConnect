<?php 

include "../connection.php";
session_start();
error_reporting(0);

if(isset($_SESSION['admin_id'])){  //if admin id is set in the session, this means he registerd and its value in the sessino, then we redirect it to the admin page and when logged in  user in admin page and want to go again to admin login page , then he can't go to it because we write here that's if admin id in session then redirect it to admin page
    header('location:index.php');
}

//this will be executed when we press on the login button
if(isset($_POST['login-btn'])){
  
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']) ); //we use md5 to encrypt the password that's user enetered it
  

  
  $result = mysqli_query($conn, "SELECT admin_id FROM admin WHERE email='$email' AND password= '$password'");
  $check_admin = mysqli_num_rows($result);

  if($check_admin > 0){    //it means he is the admin 
    $row = mysqli_fetch_assoc($result);
    $_SESSION['admin_id'] = $row['admin_id']; 
    $_POST['email'] = '';  //we put it empty to remove the writing of user from inputs fields when hi logged in successfully
    $_POST['password'] = '';

   header("location: index.php");
  }
  else{ //if it is not the admin
    
    echo '<div class="popup" id="popup">
    <img src="assets/imgs/error.jpg" >
    <h2>Warning!</h2>
    <p>Login details is incorrect.</br> Try again!</p>
    <button type="button" onclick="closePopup()">OK</button>
</div>
    
    
     ';
  }
  
  
  



}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/dark.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <script src="assets/js/app.js"></script>
    <title>Admin Login</title>

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
</head>
<body>
    <div class="container" style="max-width: 450px; max-height:800px;">
    
        <div class="card">
            <div class="card-body" >
                <div class="circle">

                </div>
                <header class="myHed text-center">
                    <i class="far fa-user"></i>
                    <p>ADMIN LOGIN</p>
                </header>
                <form action="adminLogin.php" method="post" class="main-form text-center">
                    <div class="form-group my-0">
                        <label class="my-0">
                            <i class="fas fa-user" style="margin-right: 2rem;"></i>
                            <input type="email" pattern='^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$' style="width: 100% ;" value="<?php echo  $_POST['email']; ?>" name="email" class="myInput" required placeholder="Email">

                        </label>
                    </div>
                    <div class="form-group my-0">
                        <label class="my-0">
                            <i class="fas fa-lock" style="margin-right: 2rem;" ></i>
                            <input type="password" style="width: 100% ;" required id="password" value="<?php echo  $_POST['password']?>" name="password" class="myInput" placeholder="Password">

                        </label>
                    </div>
                    <label  class="check_1" style="color:var(--nav-main); font-weight:700;">
                        <input type="checkbox"  id="showPassword"  onclick="show()">
                         Show Password
                    </label>
                    <div class="form-group">
                        <label >
                            
                            <input type="submit" name="login-btn" class="form-control button" value="LOGIN">

                        </label>
                    </div>
                    
                </form>

            </div>
        </div>

    </div>
    
    <!-- bootstrap-->
    <script src="assets/js/dark.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>

   

        <script>
    let popup = document.getElementById("popup");

    

    function closePopup(){
    popup.classList.add("open-popup");
}
    </script>



</body>
</html>