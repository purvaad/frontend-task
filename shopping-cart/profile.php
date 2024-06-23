<?php
session_start();

include ('./database.php');
include ('./functions/common-function.php');

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .profile-item{
        list-style: none;
        padding: 10px;
    }
    .container_profile ul li a{
        text-decoration: none;
        color: #191919;
        display: inline-block;
    }

    .container_profile ul li a:hover{
        border-bottom: solid 1px #000;
    }

    img{
        border-radius:20px;
        object-fit: contain;
    }

    .select-status{
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: 0 auto;
    }
    
</style>

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


        <div class="heading">
            <?php
            if(!isset($_SESSION['username'])){
                echo "<h3>Welcome, user!</h3>";
                echo "<button class='log-btn'><a  href='login.php'>Login</a></button>";
            }else{
                echo "<h3>Welcome, " . $_SESSION['username'] . "</h3>";
                echo "<button  class='log-btn'><a href='logout.php'>Logout</a></button>";
            }
            ?>
        </div>

        <div class="container_profile">
            <!-- <h2>Your Profile</h2> -->
            <ul>
				<li class="profile-item">
                    <a class="active" class="link" href="profile.php"><h3>Your Profile<h3></a>
                </li>

                <?php
                $username = $_SESSION['username'];
                $user_img = "SELECT * FROM users WHERE username = '$username'";
                $result_img = mysqli_query($con, $user_img);
                $row_img = mysqli_fetch_array($result_img);
                $user_img = $row_img['photo'];
                echo"
                <li class='profile-item'>
                    <img src='./user_img/$user_img' alt='User Photo' width='100'>
                </li>";
                ?>
                
                <li class="profile-item">
                    <a class="link" href="profile.php?edit_account">Edit Account</a>
                </li>
                <li class="profile-item">
                        <a class="link" href="profile.php?my_orders">My orders</a>
                </li>
                <li class="profile-item">
                        <a class="link" href="profile.php?delete_user">Delete account</a>
                </li>
               
			</ul>
            <div class="select-status">
            <?php 
                get_user_order_details(); 
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                    include('my_orders.php');
                }
                if(isset($_GET['delete_user'])){
                    include('delete_user.php');
                }
            
            ?>
            </div>

        </div>

        


        <footer class="footer">
    <div class="footer-bottom">
        <p>&copy; 2024 My Shopping Cart - by Purva(multidots) All rights reserved.</p>
    </div>
</footer>
</body>

</html>
