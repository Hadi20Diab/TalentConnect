<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "talent-connect";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(mysqli_connect_errno()){
    die("Database connection failed: ".mysqli_connect_error());
}



?>