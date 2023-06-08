<?php

session_start();
if($_SESSION['logged']==true){
require_once 'connection.php';
 $value="10$";
 $id = $_SESSION['id'];
if(isset($_GET['id']) && isset($_GET['semester'])) {
    
  $ids = $_GET['id'];
  $month= $_GET['semester'];
 
 

}
$paid="unpaid";
echo $ids;
  $item_query = "select * from passenger where id = '$ids'";
 
 $result=  mysqli_query($con, $item_query);
 $row = mysqli_fetch_assoc($result);
 
 $fn = $row['FullName'];
 $pn = $row['phoneNumber'];
 $e = $row['email'];
 
 
   
    $sql_add_query = "INSERT INTO payment(user_id,name,phone,email,month,value,paid) VALUES('$ids','$fn','$pn','$e','$month','$value','$paid')";

        if(mysqli_query($con, $sql_add_query) === FALSE){
            die("Could not add the new reservation"); 
            
        
        
}else{
    header('location:paymentad.php');
} 
 
}else{
//    header('location:login.php');
}


