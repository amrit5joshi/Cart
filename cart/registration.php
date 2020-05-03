<?php
include('header.php');
$Name = $_POST['SName'];
$Password = $_POST['SPassword'];
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
        $check="select * from users where Name='$Name'";
        $result=mysqli_query($conn,$check);
        $num=mysqli_num_rows($result);
  		if($num==1){
  			
        header('location:index.php?isSuccess=-1');
  		}
  		else{
		$sql = "INSERT Into users 
		(Name, Password) values('$Name', '$Password')";
		mysqli_query($conn, $sql);
	    header('location:index.php?isSuccess=1');
	    }
	    mysqli_close($conn);
}
