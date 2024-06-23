<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include ('../database.php');
include 'functions.php';


$user_data = check_login($con);

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
<body> 
    <div class="header">
			<nav class="navbar">
				<ul class="items-left">
					<li class="nav-item">
                        <a class="active" class="link" href="index.php">My shopping Cart </a>
                    </li>
					<li class="nav-item">
                        <h3>Welcome, <?php echo $user_data['username'] ; ?>!</h3> 
                    </li>

				</ul>
                <ul class="items-right">
                    
                    <li class="nav-item">
                        <button class="logout"><a href="admin-logout.php" class="logout-link">Logout</a></button>
                    </li>

				</ul>
			</nav>
		</div>
        <div class="heading">
            <h3 class="text-center">Manage Details</h3>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="admin-pic">
                <?php
                $username = $_SESSION['username'];
                $user_img = "SELECT * FROM `admin` WHERE username = '$username'";
                $result_img = mysqli_query($con, $user_img);
                $row_img = mysqli_fetch_array($result_img);
                $user_img = $row_img['photo'];
                echo"
                    <img src='./admin-img/$user_img' alt='User Photo' width='100'>"
                ?>
                    <p><?php echo $user_data['username'] ; ?></p>
                </div>
                

                <div class="options">
                    <button>
                        <a href="index.php?insert_product" class="nav-link">Insert Products</a>
                    </button>
                    <button>
                        <a href="index.php?view_products" class="nav-link">View Products</a>
                    </button>
                    <button>
                        <a href="index.php?insert-category" class="nav-link">Insert Categories</a>
                    </button>
                    <button>
                        <a href="index.php?view_categories" class="nav-link">View Categories</a>
                    </button>
                    <button>
                        <a href="index.php?insert-brands" class="nav-link">Insert Brands</a>
                    </button>
                    <button>
                        <a href="index.php?view_brands" class="nav-link">View Brands</a>
                    </button>
                    <button>
                        <a href="index.php?view_orders" class="nav-link">All Orders</a>
                    </button>
                    <button>
                        <a href="index.php?view_users" class="nav-link">List Users</a>
                    </button>
            </div>
            </div> 
            
        </div>

        <div class="container">
            <?php

                if(isset($_GET['insert_product'])){
                    include('insert_product.php');
                }

                if(isset($_GET['insert-category'])){
                    include('insert-categories.php');
                }
                
                if(isset($_GET['insert-brands'])){
                    include('insert-brands.php');
                }
                if(isset($_GET['view_brands'])){
                    include('view_brands.php');
                }

                if(isset($_GET['view_products'])){
                    include('view_products.php');
                }
                if(isset($_GET['view_categories'])){
                    include('view_categories.php');
                }
                if(isset($_GET['view_orders'])){
                    include('view_orders.php');
                }
                if(isset($_GET['view_users'])){
                    include('view_users.php');
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