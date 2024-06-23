<?php

@session_start();
     
include ('./functions/common-function.php');
include ('database.php'); 

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

//total price and items
$ip = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
$result_cart = mysqli_query($con , $cart_query);
$invoice_number = mt_rand();
$status = 'pending';
$count_product = mysqli_num_rows($result_cart);

while($row_price = mysqli_fetch_array($result_cart)){
    $product_id = $row_price['product_id'];
    $quantity = $row_price['quantity']; // Fetch quantity from cart_details table
    $product_query = "SELECT * FROM products WHERE product_id= $product_id";
    $result_product = mysqli_query($con , $product_query);
    while($row_price = mysqli_fetch_array($result_product)){
        $product_price = $row_price['product_price']; // no need to put it into an array
        $total_price += $product_price * $quantity;

        // Insert order pending
        $insert_pending = "INSERT INTO order_pending (user_id, invoice_number, product_id, quantity, order_status)
                           VALUES ($user_id, $invoice_number, $product_id, $quantity, '$status')";
        $pending_query = mysqli_query($con , $insert_pending);
    }
}

// Insert order
$insert_order = "INSERT INTO orders (user_id, amount_due, invoice_number, total_products, order_date, order_status)
                 VALUES ($user_id, $total_price , $invoice_number, $count_product, NOW(), '$status')";
$result_query = mysqli_query($con , $insert_order);
if($result_query){
    echo "<script>alert('Order Placed!')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//delete items from cart
$empty_cart = "DELETE FROM cart_details Where ip_address='$ip'"; 
$result_delete = mysqli_query($con , $empty_cart);

?>
