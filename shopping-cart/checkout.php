<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include ('./database.php');
include ('./functions/common-function.php');

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check out page</title>
    <link rel="stylesheet" href="index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body> 
    <div class="header">
			<nav class="navbar">
				<ul class="items-left">
                <li class="nav-item">
                        <a class="active" class="link" href="home.php">My Shopping Cart</a>
                    </li>
					<li class="nav-item">
                        <a class="link" href="index.php">Products</a>
                    </li>
					<li class="nav-item">
                    <a class="link" href="profile.php">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                    </li>

				</ul>
                <ul class="items-right">
                    <li class="nav-item">
                        <form action="search_product.php" method="get">
                            <input type="search" class="search" placeholder="search products..." name="search_data">
                            <input class="search-btn" type="submit" value="Search" name="search_data_product">
                        </form>
                        
                    </li>

				</ul>
			</nav>
        </div>
         
        <!-- <div class="heading">
            
            <?php
            // if(!isset($_SESSION['username'])){
            //     echo "<h3>Welcome, user!</h3>";
            //     echo "<button class='log-btn'><a  href='login.php'>Login</a></button>";
            // }else{
            //     echo "<h3>Welcome, " . $_SESSION['username'] . "</h3>";
            //     echo "<button  class='log-btn'><a href='logout.php'>Logout</a></button>";

            // }

            ?>
            
        </div> -->

        
	

        <div class="checkout-form">
            <?php
            if(!isset($_SESSION['username'])){
                include('./login.php');
            }else{
                include('./payment.php');
            }

            ?>
        </div>


<footer class="footer">
    <div class="footer-bottom">
    <p>&copy; 2024 My Shopping Cart - by Purva(multidots) All rights reserved.</p>
    </div>
</footer>


</body>
</html>