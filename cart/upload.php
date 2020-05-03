<?php
//  include('header.php');
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['userType'])) {
        header('Location: index.php');
        exit;      
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

    .formStyle {

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
    <div id="Fillup_div" align="center" class="formStyle" style="background-color:grey">
    <br><br>
    <form id="itemUpload" action="Fillup.php" method="post" enctype="multipart/form-data">
      <br>
      <p align="center"> <h3>Please Fill the following form</h3> </p><br>
      <LABEL>NAME OF ITEM :</LABEL> <input type="text" name="Name" required><br><br>
      <LABEL>IMAGE OF ITEM :</LABEL> <input type="file" name="file" required><br><br>
      <LABEL>PRICE OF ITEM :</LABEL> <input type=number step=0.01 min=0.01 name="Price" required><br><br>
      <LABEL for="type">TYPE OF ITEM :</LABEL> 
            <select id="type" name="type">
                <option value="Wired">Wired</option>
                <option value="Wireless">Wireless</option>
                <option value="Accessories">Accessories</option>
            </select>
            <br><br>
      <button type="submit" name="submit"> INSERT THE ITEM </button><br><br><br>
    </form>
  </div>
   <div id="footer"></div>
</body>
</html>