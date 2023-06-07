<?php
session_start();
if($_SESSION['logged']==true){

require_once 'connection.php';

$id = $_GET["id"];
 $ids = $_SESSION['id'];
  
 $item_query = "select * from payment where id = '$id'";
 
 $result=  mysqli_query($con, $item_query);
 $row = mysqli_fetch_assoc($result);
 
 $u_id = $row['user_id'];
 $name = $row['name'];
 $phone = $row['phone'];
 $email = $row['email'];
 $paid = $row['paid'];
 if($paid=="unpaid"){
   
  $p="paid";
            $sql = "update payment set paid = '$p' where id = '$id'";
            mysqli_query($con, $sql);
           header("Location: paidinguser.php?id=" . $u_id);
            
        }
 else{
     die("la asr");
 }
}else{
//    header('location:login.php');
}



?>