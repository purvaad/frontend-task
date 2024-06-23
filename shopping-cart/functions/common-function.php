<?php

// include ('../database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

//getting products

if (!function_exists('getproducts')) {
function getproducts(){
    global $con;

    //condition to check isset
    if (!isset($_GET['category']) && !isset($_GET['brand'])) {
        $select_query = "SELECT * from `products` ORDER BY rand() LIMIT 0,9";
        $result_query = mysqli_query($con, $select_query);
        while($row = mysqli_fetch_assoc($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_photo1 = $row['product_photo1'];
            $product_price = $row['product_price'];
            // Ensure category_id exists before accessing it
            $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $brand_id = $row['brand_id'];
            echo "<div class='col-3'>
                <div class='card'>
                    <img src='./images/$product_photo1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'>Price: $product_price /-</p>
    
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                        <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View More</a>
    
                    </div>
                </div>
            </div>";
        }
    }
    
                
}
}


if (!function_exists('get_selectedcategories')) {

//getting selected categories
function get_selectedcategories(){
    global $con;

    //condition to check isset
    if(isset($_GET['category'] )){
        $category_id = $_GET['category'];
        $select_query = "SELECT * from `products` WHERE category_id=$category_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2>No products for this Catgeory</h2>";

        }
                    // echo $row['product_title'];
                    while($row = mysqli_fetch_assoc($result_query)){
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_photo1 = $row['product_photo1'];
                        $product_price = $row['product_price'];
                        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
                        $brand_id = $row['brand_id'];
                         echo "<div class='col-3'>
                         <div class='card'>
                             <img src='./images/$product_photo1' class='card-img-top' alt='$product_title'>
                             <div class='card-body'>
                                 <h5 class='card-title'>$product_title</h5>
                                 <p class='card-text'>$product_description</p>
                                 <p class='card-text'>₹ $product_price /-</p>
 
                                 <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                 <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View More</a>
 
                             </div>
                         </div>
                     </div>";

                    }
    }
}
}

//getting selected brands

if (!function_exists('get_selectedbrand')) {
function get_selectedbrand(){
    global $con;

    //condition to check isset
    if(isset($_GET['brand'] )){
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * from `products` WHERE brand_id=$brand_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2>No products for this Brand</h2>";

        }   
        while($row = mysqli_fetch_assoc($result_query)){
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_photo1 = $row['product_photo1'];
            $product_price = $row['product_price'];
            $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
            $brand_id = $row['brand_id'];
             echo "<div class='col-3'>
             <div class='card'>
                 <img src='./images/$product_photo1' class='card-img-top' alt='$product_title'>
                 <div class='card-body'>
                     <h5 class='card-title'>$product_title</h5>
                     <p class='card-text'>$product_description</p>
                     <p class='card-text'>₹ $product_price /-</p>

                     <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                     <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View More</a>

                 </div>
             </div>
         </div>";

        }
    }
}
}
                

//func for displaying brands
if (!function_exists('getbrands')) {

 function getbrands(){
    global $con;
    $select_brands = "SELECT * FROM brands";
    $result_brands= mysqli_query($con, $select_brands);
                    // echo $row_data['brand_title'];
            
                    while($row_data = mysqli_fetch_assoc($result_brands)){
                        $brand_title = $row_data['brand_title'];
                        $brand_id = $row_data['brand_id'];
                        echo "<li class='nav-item'>
                        <a href='index.php?brand=$brand_id' class='nav-link menu-nav-link'>
                            <h4>$brand_title</h4>
                        </a>
                    </li>";
                    }
 }
}

//func for displaying categories
if (!function_exists('getcategories')) {
 function getcategories(){
    global $con;
    $select_category = "SELECT * FROM categories";
                    $result_category= mysqli_query($con, $select_category);
                    
                    while($row_data = mysqli_fetch_assoc($result_category)){
                        $category_title = $row_data['category_title'];
                        $category_id = $row_data['category_id'];
                        echo "<li class='nav-item'>
                        <a href='index.php?category=$category_id' class='nav-link menu-nav-link'>
                            <h4>$category_title</h4>
                        </a>
                    </li>";
                    }
 }
}

 //get search products
 if (!function_exists('searched_product')) {
 function searched_product(){
    global $con;

    if(isset($_GET['search_data_product'])){

        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * from `products` WHERE product_keyword like '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "<h2>No result match! Product not available...</h2>";

        }   
                    // echo $row['product_title'];
                    while($row = mysqli_fetch_assoc($result_query)){
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_description = $row['product_description'];
                        $product_photo1 = $row['product_photo1'];
                        $product_price = $row['product_price'];
                        $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
                        $brand_id = $row['brand_id'];
                         echo "<div class='col-3'>
                         <div class='card'>
                             <img src='./images/$product_photo1' class='card-img-top' alt='$product_title'>
                             <div class='card-body'>
                                 <h5 class='card-title'>$product_title</h5>
                                 <p class='card-text'>$product_description</p>
                                 <p class='card-text'>₹ $product_price /-</p>
 
                                 <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                 <a href='product_details.php?product_id=$product_id' class='btn btn-primary'>View More</a>
 
                             </div>
                         </div>
                     </div>";

                    }
    }

 }
}

 //view details
 if (!function_exists('view_details')) {
 function view_details(){
    global $con;

    //condition to check isset
    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id']; 
        $select_query = "SELECT * from `products` WHERE product_id=$product_id";
        $result_query = mysqli_query($con, $select_query);
        if(mysqli_num_rows($result_query) > 0) {
            while($row = mysqli_fetch_assoc($result_query)){
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_photo1 = $row['product_photo1'];
                $product_photo2 = $row['product_photo2'];
                $product_photo3 = $row['product_photo3'];
                $product_price = $row['product_price'];

                //displaying product details
                echo "<div class='product-row'>
                        <div class='col-2'>
                            <div class='card'>
                                <img src='./images/$product_photo1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                    <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>₹ $product_price /-</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
                                    <a href='index.php' class='btn btn-primary'>Go Home</a>

                                    </div>
                            </div>
                        </div>
                        <div class='row-moredetails'>
                            <h4>More images of the product</h4>
                            <div class='product-details'>
                                <div class='more-img'>
                                    <img src='./images/$product_photo2' class='card-img-top' alt='$product_title'>
                                </div>
                                <div class='more-img'>
                                    <img src='./images/$product_photo3' class='card-img-top' alt='$product_title'>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        } 
    }
}
 }

//get ip address func
if (!function_exists('getIPAddress')) {
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  

}  
}


    //cart function
if (!function_exists('cart')) {
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;

        $ip = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];

        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip' 
        AND product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if($num_of_rows>0){
            echo "<h2><script>alert('This itme is already present inside the cart')</script></h2>";
            echo "<script>window.open('index.php', '_self')</script>"; //_self to open it in same tab
        } else{
            $insert_query = "INSERT INTO `cart_details` (product_id,ip_address,quantity) 
            VALUES ($get_product_id, '$ip', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<h2><script>alert('Item added to cart')</script></h2>";
            echo "<script>window.open('index.php','_self')</script>"; 

        }

    }

}
}

//function to cart item no.
if (!function_exists('cart_item')) {
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;

        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $num_cart_items = mysqli_num_rows($result_query);
        } else{
        global $con;

        $ip = getIPAddress();
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $num_cart_items = mysqli_num_rows($result_query);

        }
        echo $num_cart_items ;

    }
}


//total price func
if (!function_exists('total_cart_price')) {
function total_cart_price(){
    global $con;

    $ip = getIPAddress();
    $cart_query = "SELECT * FROM `cart_details` WHERE ip_address= '$ip' ";
    $result = mysqli_query($con, $cart_query);
    $total_price = 0;

    while($row=mysqli_fetch_array($result)){
        $product_id = $row['product_id'];
        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while($row_product_price = mysqli_fetch_array($result_products)){
            $product_price= array($row_product_price['product_price']);
            $product_price= array_sum($product_price);
            $total_price += $product_price;
        }
    } 
    echo $total_price;
}
}

if (!function_exists('check_login')) {

function check_login($con){
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username']; // Corrected variable name
        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1"; // Corrected variable name and added proper SQL syntax

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}
}


//get user order details

if (!function_exists('get_user_order_details')) {

    function get_user_order_details(){
        global $con;
    
        $username = $_SESSION['username'];
        $order_details = "SELECT * FROM users WHERE username = '$username'";
        $result_details = mysqli_query($con, $order_details);
        while($row_query = mysqli_fetch_array($result_details)){
            $user_id = $row_query['user_id'];
            if(!isset($_GET['edit_account'])){
                if(!isset($_GET['my_orders'])){
                    if(!isset($_GET['delete_account'])){
                        $get_orders = "SELECT * FROM orders WHERE user_id = '$user_id' and order_status='pending'";
                        $result_details_query = mysqli_query($con, $get_orders);
                        $row_count = mysqli_num_rows($result_details_query);
                        if($row_count>0){
                            echo "<h2>You have $row_count pending orders<h2>
                            <a href = 'profile.php?my_orders'>Order Details</a>";
                        }else{
                            echo "<h2>You have 0 pending orders<h2>";
    
                        }
    
    
                    }
                }
    
            }
        }
    
    }    
    
}


?>

