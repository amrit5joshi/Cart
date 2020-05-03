<?php
include('header.php');
$host = "localhost";
$dbUsername = "root";
$dbpassword = "";
$dbname = "mysql";
if(isset($_POST['submit'])){
  $Name = $_POST['Name'];
  $Price = $_POST['Price'];
  $itemType =$_POST['type'];
  $img = $_FILES['file'];
  print_r($img);
  $imgName = $_FILES['file']['name'];
  $imgTmpName = $_FILES['file']['tmp_name'];
  $imgSize = $_FILES['file']['size'];
  $imgError = $_FILES['file']['error'];
  $imgExt = $_FILES['file']['type'];

  $doc_path = realpath(dirname(__FILE__)).'/assests/img/';
  $ext = explode('.',$imgName);
  $fileExt = strtolower(end($ext));

  $allowedExt = array('jpg','jpeg','png');

  if(in_array($fileExt,$allowedExt)){
    if($imgError === 0){
      if($imgSize < 1200000){
        $fileName = uniqid('',true).".".$fileExt;
        $imgFolder = $doc_path.$fileName;
        if(move_uploaded_file($imgTmpName,$imgFolder)){
          $conn = new mysqli($host, $dbUsername, $dbpassword, $dbname);
  
          if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
          }
            
            $sql = "INSERT Into shoppingcart 
            (Name, Image,Price, itemType) values('$Name', '$fileName','$Price','$itemType')";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header('location:admin.php?isSuccess=1');
          }
          else{
            echo 'Some Error';
          }     
        }
      }
      else{
        echo 'File size is too big';
      }
    }
    else{
      echo 'There is an error while uploading the file';
    }
  }
  else{
    echo 'Invalid file type Uploaded';
  }
?>