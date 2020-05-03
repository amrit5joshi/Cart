<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        #nav {
            width: 100%;
        }

        #nav ul {
            margin: 0;
            padding: 0;
            text-align: center;
            background: #428bca;
            list-style: none;
        }

        #nav a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            width: 150px;
            display: block;
            padding: 15px;
            transition: 0.4s;
        }
        #titeArea {
            text-decoration: none;
            color: white;
            font-size: 20px;
            width: 150px;
            display: block;
            padding: 15px;
            transition: 0.4s;
        }

        #nav li {
            padding-left: 50px;
            display: inline-block;
        }

        #nav a:hover {
            background-color: #000f59;
            transition: 0.6s;
        }

        body {
            background-color: #424141;
        }
    </style>
</head>

<body>
    <div id="nav">
        <?php
        if(isset($_SESSION['username']) && isset($_SESSION['userType'])){
            if($_SESSION['userType']=="admin"){
                echo '
                <ul>
                    <li style="float:left;font-size: 40px;color: white;">
                    <div id="titleArea"> WIRED.com</div>
                    </li>
                    <li style="float:center;font-size: 40px;color: white;">
                         Welcome to Admin Access
                    </li>
                    <li style="float:right;font-size: 30px;color: white;">
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                ';    
            }
            elseif($_SESSION['userType']=="user"){
                echo '
                <ul>
                    <li style="float:left;font-size: 40px;color: white;">
                        WIRED.com
                    </li>
                    <li>
                        <a href="home.php">Home</a>
                    </li>
                    <li>
                        <a href="wired.php">Wired</a>
                    </li>
                    <li>
                        <a href="wireless.php">Wireless</a>
                    </li>
                    <li>
                        <a href="accessories.php">Accessories</a>
                    </li>
                    <li>
                        <a href="cart.php">Cart</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                ';        
            }
        }
        else{
            echo '
            <ul>
                <li style="float:left;font-size: 40px;color: white;">
                <div id="titleArea"> WIRED.com</div>
                </li>
                <li style="float:center;font-size: 40px;color: white;">
                     Shopping made Easy
                </li>
            </ul>
            ';
        }
        ?>
    </div>
</body>

</html>