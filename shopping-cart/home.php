<?php

include ('./database.php');
include ('./functions/common-function.php');

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="home.css">

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
                        <form action="" method="get">
                            <input type="search" class="search" placeholder="search products..." name="search_data">
                            <input class="search-btn" type="submit" value="Search" name="search_data_product">
                        </form>
                    </li>

				</ul>
        </nav>
    </div>
    <main class="hero-main">
        
            <div class="slider">
                <div class="slide-item">
                    <a href="index.php?brand=1"><img src="./home-img/slider-img5.jpeg" alt="Image 1"></a>
                </div>
                <div class="slide-item">
                    <a href="index.php?brand=12"><img src="./home-img/slider-img2.jpeg" alt="Image 2"></a>
                </div>
                <div class="slide-item">
                <a href="index.php?brand=12"><img src="./home-img/slider-img3.jpeg" alt="Image 3"></a>
                </div>
                <div class="slide-item">
                <a href="index.php?brand=4"><img src="./home-img/slider-img4.jpeg" alt="Image 3"></a>
                </div>
            </div>

            <section class="featured-brands">
                <div class="heading">
                    <h2>Shop By Brands</h2>
                </div>
                <div class="brands">
                    <a href="index.php?brand=4"><img src="./home-img/brand1.png" alt="Image 1"></a>
                    <a href="index.php?brand=11"><img src="./home-img/brand2.png" alt="Image 2"></a>
                    <a href="index.php?brand=3"><img src="./home-img/brand3.png" alt="Image 3"></a>
                    <a href="index.php?brand=1"><img src="./home-img/brand4.png" alt="Image 4"></a>
                    <a href="index.php?brand=12"><img src="./home-img/brand5.png" alt="Image 5"></a>
                    <a href="index.php?brand=2"><img src="./home-img/brand6.png" alt="Image 6"></a>
                    <a href="index.php?brand=5"><img src="./home-img/brand7.png" alt="Image 7"></a>
                </div>

            </section>
        
        <section class="new-arrivals">
            <h2 class="apple">New arrivals</h2>
            <div class="ribbon">
                <?php

                // Function to display product cards
                function displayProductCard($product_id, $product_title, $product_description, $product_photo, $product_price)
                {
                    echo "<div class='ribbon-card'>
                            <img src='./images/$product_photo' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price /-</p>

                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View More</a>

                            </div>
                        </div>";
                }

                // Function to get products from the database
                function getProductsFromDatabase()
                {
                    global $con;

                    $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,5";
                    $result_query = mysqli_query($con, $select_query);

                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_photo = $row['product_photo1']; // Assuming product_photo1 is the main photo
                        $product_price = $row['product_price'];

                        // Display product card
                        displayProductCard($product_id, $product_title, $product_description, $product_photo, $product_price);
                    }
                }
                getProductsFromDatabase();
                ?>

            </div>

            
        </section>

        <section class="apple-card">
            <h2 class="apple">Apple</h2>
            <h3>THE ULIMATE CHOICE</h3>
            <div class="container">
                <div class="card">
                    <div class="imgBx">
                        <img src="./home-img/iphone_13.png" alt="">
                    </div>
        
                    <div class="contentBx">
        
                        <h2>iphone 13</h2>
        
                        <div class="size">
                            <h3>All kinds of awesome.</h3>
                            
                        </div>
        
                        <div class="color">
                            <h3>Color :</h3>
                            <div class="color-options">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>

                        <a href="product_details.php?product_id=9">View Details</a>
                    </div>
        
                </div>
                <div class="card">
                    <div class="imgBx">
                        <img src="./home-img/iphone_14_.png" alt="">
                    </div>
        
                    <div class="contentBx">
                        <h2>iphone 14</h2>
        
                        <div class="size">
                            <h3>As amazing as ever.</h3>
                            
                        </div>
                        <div class="color">
        
                            <h3>Color :</h3>
                            <div class="color-options">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <a href="product_details.php?product_id=6">View Details</a>
                    </div>
        
                </div>
                
                <div class="card">
                    <div class="imgBx">
                        <img src="./home-img/iphone-15pro.png" alt="">
                    </div>
        
                    <div class="contentBx">
                        <h2>iphone 15 pro</h2>
        
                        <div class="size">
                            <h3>The ultimate iPhone.</h3>
                            
                        </div>
                        <div class="color">
        
                            <h3>Color :</h3>
                            <div class="color-options">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <a href="product_details.php?product_id=5">View Details</a>
                    </div>
        
                </div>
        
            </div>

        </section>
    </main>
    
    
<footer class="footer">
    <div class="footer-bottom">
    <p>&copy; 2024 My Shopping Cart - by Purva(multidots) All rights reserved.</p>
    </div>
</footer>

</body>
<script src="./script.js"></script>
</html>