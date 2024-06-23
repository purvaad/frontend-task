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
    <title>cart details</title>
    <link rel="stylesheet" href="index.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    h2{
        text-align: center; 
        margin-bottom: 20px;
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
                
			</nav>

            <!-- calling cart func -->
            <?php
                cart();

            ?>
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
        
        <div class="container">
            <form action="cart.php" method="post">
        <table class="table">
            <h3>Your Cart</h3>
            <?php
                $ip = getIPAddress();
                $cart_query = "SELECT * FROM `cart_details` WHERE ip_address= '$ip' ";
                $result = mysqli_query($con, $cart_query);
                $num_of_rows = mysqli_num_rows($result);
                if($num_of_rows>0){
                    echo "

                    <thead>
                    <tr>
                        <th>PRODUCT TITLE</th>
                        <th>PRODUCT IMAGE</th>
                        <th>QUANTITY</th>
                        <th>TOTAL PRICE</th>
                        <th>REMOVE</th>
                        <th colspan='2'>OPERATIONS</th>
                    </tr>
                </thead>

        
                <tbody>";
                 
                $total_price = 0;
            
                while($row=mysqli_fetch_array($result)){
                    $product_id = $row['product_id'];
                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                    $result_products = mysqli_query($con, $select_products);
                    while($row_product_price = mysqli_fetch_array($result_products)){
                        $product_price= array($row_product_price['product_price']);
                        $price_table = $row_product_price['product_price'];
                        $product_title = $row_product_price['product_title'];
                        $product_photo = $row_product_price['product_photo1'];
                        $product_price= array_sum($product_price);
                        $total_price += $product_price;             

                    ?>
            
            <tr>
                <th><?php echo $product_title ?></th>
                <th><img class="cart-img" src="./images/<?php echo $product_photo ?>" alt=""></th>
                <th><input type="text" name="qty" id="quantity" class="quantity"></th>
                <?php
                    $ip = getIPAddress();
                    if(isset($_POST['update_cart'])){
                        $quantities = $_POST['qty'];
                        $update_cart = "UPDATE `cart_details` SET quantity=$quantities WHERE ip_address='$ip'";
                        $result_products_quantity = mysqli_query($con, $update_cart);
                        $total_price = $total_price * $quantities;
                    }

                ?>
                <th><?php echo $product_price ?>/-</th>
                <th><input type="checkbox" name="removeitem[]" value="<?php echo $product_id ?>"></th>
                <th>
                    <!-- <button class="table-btn">Update</button> -->
                    <input type="submit" value="Update Cart" class="table-btn" name="update_cart">
                    <!-- <button class="table-btn">Remove</button> -->
                    <input type="submit" value="Remove Cart" class="table-btn" name="remove_cart">

                </th>
            </tr>
            <?php 
                    }
                    } 
                }else {
                    echo "<h2>No products in the cart!</h2>";

                }
            ?>

            </tbody>
        </table>
        <?php
                if($num_of_rows > 0){
                    echo "<div class='amount'>";
                    echo "<h2 class='total'>Sub Total: <strong>" . $total_price . "/-</strong> </h2>"; // Corrected this line
                    echo "<input type='submit' value='Continue Shopping' class='amount-btn' name='conitue_shopping'>";
                    echo "<button class='amount-btn'><a class='amount-btn' href='checkout.php'>Checkout</a></button>";
                    echo "</div>";
                } else {
                    echo "<input type='submit' value='Continue Shopping' class='amount-btn' name='conitue_shopping'>";
                }
                if(isset($_POST['conitue_shopping'])){
                    echo "<script>window.open('index.php','_self')</script>";
                }

                ?>
        
        </form>

        <!-- func to remove item  -->
        <?php

        function remove_item(){
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    // echo $remove_id;
                    $delete_query = "DELETE FROM `cart_details` WHERE product_id = $remove_id";
                    $result_del = mysqli_query($con , $delete_query);
                    if($result_del){
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo $remove_items = remove_item();

        ?>

    </div>
 


 <footer class="footer">
    <div class="footer-bottom">
    <p>&copy; 2024 My Shopping Cart - by Purva(multidots) All rights reserved.</p>
    </div>
</footer>
</body>
</html>