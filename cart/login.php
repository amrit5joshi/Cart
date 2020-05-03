<?php
session_start();
$value = "WELCOME TO LOGIN PAGE !!!";
if(isset($_SESSION['username']))
{
    header('Location: home.php');
    exit; 
}
if ($_GET) {
  if ($_GET['isSuccess'] == 1) {
    $value = "REGISTRATION SUCCESSFUL !!!<br>LOGIN TO CONTINUE!!!";
  } else if ($_GET['isSuccess'] == 0) {
    $value = "INVALID USERNAME AND PASSWORD!!!";
  } else if ($_GET['isSuccess'] == -1) {
    $value = "USERNAME ALREADY TAKEN!!!";
  } else {
    echo "Something wrong there";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Wired.com</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #424141;
    }

    .divv {
      width: 500px;
      border-radius: 100%;
      margin: auto;
      border: 3px solid grey;
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
    <p align="center"> <?php echo $value; ?> </p><br>
    <form id="Pest" action="CheckValid.php" method="post">
      <button type="button" onclick="myFunctionSignup()">CLICK HERE TO MAKE NEW ACCOUNT</button><br><br>
      <LABEL>USERNAME :</LABEL> <input type="text" name="Name" required><br><br>
      <LABEL> PASSWORD : </LABEL><input type="Password" name="Password" required><br><br>
      <input type="submit" name="submit" value="LOGIN" /><br><br><br>
    </form>
  </div>
  <div id="Signup_div" align="center" class="divv" style="background-color:grey">
    <br><br>
    <form id="Pest" action="Registration.php" method="post">
      <button type="button" onclick="myFunctionLogin()">ALREADY HAVE AN ACCOUNT? LOGIN !</button><br><br>
      USERNAME : <input type="text" name="SName" required><br><br>
      PASSWORD : <input type="Password" name="SPassword" required><br><br>
      <input type="submit" name="submit" value="SIGNUP" /><br><br><br>
    </form>
  </div>
  <div id="footer"></div>
  <script>
    document.getElementById("Signup_div").style.visibility = "hidden";

    function myFunctionSignup() {
      document.getElementById("Login_div").style.visibility = "hidden";
      document.getElementById("Signup_div").style.visibility = "visible";
    }

    function myFunctionLogin() {
      document.getElementById("Login_div").style.visibility = "visible";
      document.getElementById("Signup_div").style.visibility = "hidden";
    }
  </script>
</body>

</html>