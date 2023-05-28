<?php 
   //when the admin press on logout link in the admin page , then this page will be executed that's will logout the admin by destroy the session that's will remove all the values from it and destroy it, which means the admin is not logged in now
   session_start();
   session_unset();
   session_destroy();
   header("location: ../userRegistration.php");  //after he logout, then it will be redirected to adminLogin.php file which is the login page of admin  in order to relogin agqin if he want 
   
?>