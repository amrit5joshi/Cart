<?php
//  include('header.php');
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['userType'])) {
    if($_SESSION['userType']=="user"){
        header('Location: index.php');
        exit;      
    }
    elseif($_SESSION['userType']=="admin"){
      header('Location: upload.php');
      exit; 
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Shopping Cart</title>
  <style>
    body {
      background-color: #424141;
      margin: 0;
      padding: 0;
      background: #424141;
    }

    .divv {

      border-radius: 100%;
      width: 500px;
      margin: auto;
      border: 3px solid;
      position: absolute;
      top: calc(100% - 70%);
      left: calc(100% - 70%);
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script>
    $(function() {
      $("#header").load("header.php");
      $("#footer").load("footer.php");
    });
  </script>
</head>

<body>
  <div id="header"></div>
  <div align="center" id="Login_div" class="divv" style="background-color:grey">
    <br>
    <p align="center"> <h2>Please enter your Credentials</h2> </p><br>
    <form id="Pest" action="CheckValidAdmin.php" method="post">
      <LABEL>USERNAME :</LABEL> <input type="text" name="Name" required><br><br>
      <LABEL> PASSWORD : </LABEL><input type="Password" name="Password" required><br><br>
      <input type="submit" name="submit" value="LOGIN" /><br><br><br>
    </form>
  </div>
</body>

</html>