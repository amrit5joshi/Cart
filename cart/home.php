<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('Location: index.php');
  exit;
}
if (isset($_SESSION['username']) && isset($_SESSION['userType'])) {
  if($_SESSION['userType']=="admin"){
    echo '<script>alert("Access Denied.\nClick OK to go Back");</script>';
    echo '<script>window.history.go(-1);</script>';     
  }
}
$host = "localhost";
$dbUsername = "root";
$dbpassword = "";
$dbname = "mysql";
$con = new mysqli($host, $dbUsername, $dbpassword, $dbname);
$query = " SELECT `ID`, `Name`, `Image`, `Price` FROM `shoppingcart` order by id ASC ";
$queryfire = mysqli_query($con, $query);
$num = mysqli_num_rows($queryfire);
$username = $_SESSION['username'];
$addSuccess = 3;
if (isset($_POST["addItem"]) && isset($_POST["qty"])) {
  if (isset($_SESSION["cart"])) {
    $items_array = array_column($_SESSION["cart"], "ItemID");
    if (!in_array($_POST["id"], $items_array)) {
      $num = count($_SESSION["cart"]);
      $items = array(
        'ItemID' => $_POST["id"],
        'name' => $_POST["name"],
        'price' => $_POST["price"],
        'quantity' => $_POST["qty"]
      );
      $addSuccess = 1;
      $_SESSION["cart"][$num] = $items;
    } else {
      $addSuccess = 0;
      echo '<script>alert("You have already added the item in cart. \nYou cannot add same item twice.\nPlease remove the item and try adding again.\nClick on OK to go back.")</script>';
    }
  } else {
    $items = array(
      'ItemID' => $_POST["id"],
      'name' => $_POST["name"],
      'price' => $_POST["price"],
      'quantity' => $_POST["qty"]
    );
    $addSuccess = 1;
    $_SESSION["cart"][0] = $items;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Dancing+Script" rel="stylesheet">
  <title>Wired - Home</title>
  <style>
    .container-fluid {
      padding-top: 15px;
      padding-bottom: 15px;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
      max-width: unset;
      float: left;
    }
  </style>
  <script>
    $(function() {
      $("#header").load("header.php");
      $("#footer").load("footer.php");
    });
  </script>
</head>

<body>
  <div id="header"></div>
  <div class="container-fluid">
    <div class="row" align="center">
      <?php
      if ($num > 0) {
        while ($product = mysqli_fetch_array($queryfire)) {
      ?>
          <div class="col-lg-3 col-md-3 col-sm-4">
            <form method="post" action="home.php?action=add">
              <div class="card">
                <h6 class="card-title bg-primary text-white p-2 text-uppercase"> <?php echo $product['Name'];  ?> </h6>
                <div class="card-body">
                  <?php echo "<img src='http://localhost/sal/cart/assests/img/" . $product['Image'] . "' height='130' width='220'> ";  ?>
                  <h6> <?php echo "AU$ " . $product['Price'];  ?>
                </div>

                <input type="hidden" name="id" value="<?php echo $product['ID']; ?>">
                <input type="hidden" name="name" value="<?php echo $product['Name']; ?>">
                <input type="hidden" name="price" value="<?php echo $product['Price']; ?>">
                <div class="btn-group d-flex">
                  <input type="text" name="qty" class="form-control" placeholder="Quantity" value=1>
                  <button name="addItem" class="btn btn-primary btn-sm"> Add to cart </button>
                </div>
              </div>
            </form>
          </div>
      <?php
        }
      }
      ?>
    </div>
    <div class="card-title text-black p-2 text-uppercase"">
    <?php
      if ($addSuccess == 1) {
        echo '<script>alert("You have added the item in cart. \nClick on OK to go back.");</script>';
        echo'<script>window.history.go(-1);</script>';
      } elseif ($addSuccess == 0) {
        echo '<script>alert("You have already added the item in cart.\nCannot add it again. \nClick on OK to go back.")</script>';
        echo '<script>window.history.go(-1);</script>';
      }
      ?>
 </div>
  </div>
  <div id="footer"></div>
</body>
</html>