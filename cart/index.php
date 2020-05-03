<?php
$value = "WELCOME TO LOGIN PAGE !!!";
if(isset($_SESSION['username']))
{
  if($_SESSION['userType']=="user"){
    header('Location: home.php');
    exit; 
  }
  elseif($_SESSION['userType']=="admin"){
      header('Location: upload.php');
      exit; 
    }
}
else{
  header('Location: login.php');
  exit; 
}
?>