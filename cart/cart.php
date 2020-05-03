<?php
session_start();
if(!isset($_SESSION['username']))
{
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
$username = $_SESSION['username'];
if (isset($_GET["input"])) {
    if ($_GET["input"] == "remove") {
        foreach ($_SESSION["cart"] as $keys => $values) {
            if ($values["ItemID"] == $_GET["id"]) {
                unset($_SESSION["cart"][$keys]);
                echo '<script>alert("The item has been successfully removed.\nClick on OK to go back.")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    }
    elseif ($_GET["input"]=="buyNow") {
        if (!empty($_SESSION["cart"])) {
            $transactionData="";
            foreach ($_SESSION["cart"] as $keys => $values) {
                    $transactionData = strval($transactionData) . ucfirst($values["name"]) . "-" . strval($values["quantity"]) . "-";
            }
            $con = new mysqli($host, $dbUsername, $dbpassword, $dbname);
            $query = " INSERT INTO `transactions`(`userName`, `purchaseData`) VALUES ('$username','$transactionData')";
            echo $query;
            if (mysqli_query($con, $query)) {
                foreach ($_SESSION["cart"] as $keys => $values) {
                    $transactionData = strval($transactionData) . ucfirst($values["name"]) . "-" . strval($values["quantity"]) . "-";
                    unset($_SESSION["cart"][$keys]);
                    echo '<script>alert("The transaction is successful.\nClick on OK to go back.")</script>';
                    echo '<script>window.history.go(-1);</script>';
            }
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($con);
            }
            } 
            else {
                echo '<script>alert("The are no items currently in the cart.")</script>';
            }
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
    <title>Wired - Shopping Cart</title>
    <style>
        .center {
            margin: auto;
            width: 60%;
            border: 3px solid white;
            padding: 10px;
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
    <br><br>
    <div class="center">
        <div class="table-responsive">
            <table class="table table-bordered card-title bg-info text-white p-2 text-uppercase">
                <tr>
                    <th width="20%">Item</th>
                    <th width="10%">Quantity</th>
                    <th width="10%">Price</th>
                    <th width="10%">Sum</th>
                    <th width="10%">Remove</th>
                </tr>
                <?php
                if (!empty($_SESSION["cart"])) {
                    $sum = 0;
                    foreach ($_SESSION["cart"] as $keys => $details) {
                ?>
                        <tr>
                            <td><?php echo $details["name"]; ?></td>
                            <td><?php echo $details["quantity"]; ?></td>
                            <td>$ <?php echo $details["price"]; ?></td>
                            <td>$ <?php echo number_format($details["quantity"] * $details["price"], 2); ?></td>
                            <td><a href="cart.php?input=remove&id=<?php echo $details["ItemID"]; ?>"><span class="text-danger">Remove Item</span></a></td>
                        </tr>
                    <?php
                        $sum = $sum + ($details["quantity"] * $details["price"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right">$ <?php echo number_format($sum, 2); ?></td>
                        <td></td>
                    </tr>
                <?php
                }
                ?>
            </table>
                <div class="btn-group d-flex">
                 <a href="cart.php?input=buyNow" class="btn btn-primary btn-sm">BUY NOW</a>
                </div>
        </div>
    </div>
    <div id="footer"></div>
</body>

</html>
