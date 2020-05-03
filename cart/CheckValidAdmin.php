<?php
include('header.php');
session_start();
$Name = $_POST['Name'];
$Password = $_POST['Password'];
$Admin = "admin";
if (!empty($Name) || !empty($Password)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbpassword = "";
    $dbname = "mysql";
    //create connection
    //print $Password;
    $conn = new mysqli($host, $dbUsername, $dbpassword, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
        $check="select Name,Password,userType from users where Name='$Name' && Password='$Password' && userType='$Admin'";
        $result=mysqli_query($conn,$check);
        $num=mysqli_num_rows($result);
        $type = mysqli_fetch_array($result);
        if($num==1 && $type['userType']=="admin"){
            $_SESSION['username']=$Name; 
            $_SESSION['userType']=$type['userType'];
            header('location:upload.php');
         }
  		else{
            echo '<script>alert("Wrong Username/Pw combination.\nPlease Try again.\nClick OK to go Back");</script>';
            echo '<script>window.history.go(-1);</script>';
      }
	    mysqli_close($conn);
}
?>