<?php

include ('../database.php');

if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    //accessing photo
    $product_photo1 = $_FILES['product_photo1']['name'];
    $product_photo2 = $_FILES['product_photo2']['name'];
    $product_photo3 = $_FILES['product_photo3']['name'];

    //accessing photo tmp name
    $tmp_photo1 = $_FILES['product_photo1']['tmp_name'];
    $tmp_photo2 = $_FILES['product_photo2']['tmp_name'];
    $tmp_photo3 = $_FILES['product_photo3']['tmp_name'];

    //checking empty condition
    if($product_title=='' or $product_description=='' or $product_keyword=='' or 
    $product_categories=='' or $product_brands=='' or $product_price=='' or $product_photo1=='' or $product_photo2=='' or $product_photo3==''){
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    }else{
        move_uploaded_file($tmp_photo1,"./product_images/$product_photo1");
        move_uploaded_file($tmp_photo2,"./product_images/$product_photo2");
        move_uploaded_file($tmp_photo3,"./product_images/$product_photo3");

        //insert query
        $insert_product = "INSERT INTO `products` (product_title, product_description, product_keyword, category_id, brand_id, product_photo1, product_photo2, product_photo3, product_price, date, status) 
        VALUES ('$product_title','$product_description','$product_keyword','$product_categories','$product_brands','$product_photo1','$product_photo2','$product_photo3','$product_price',NOW(),'$product_status')" ;
        $result_query = mysqli_query($con, $insert_product);
        if($result_query){
            echo "<script>alert('Successfully inserted product!')</script>";
        }

    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert product</title>
    <link rel="stylesheet" href="insertproduct.css">
</head>
<body>

    <div class="container_insert">
        <div class="container-product">
        
        <h2 class="register">Insert Products</h2>
        <form action="" method="post" class="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_title">Product Title:</label>
                <input type="text" name="product_title" id="product_title" placeholder="Enter product title" required="required">
            </div>

            <div class="form-group">
                <label for="product_description">Product Description:</label>
                <input type="text" name="product_description" id="product_description" placeholder="Enter product description" required="required">
            </div>

            <div class="form-group">
                <label for="product_keyword">Product Keywords:</label>
                <input type="text" name="product_keyword" id="product_keyword" placeholder="Enter product keyword" required="required">
            </div>

            <!-- category -->
            <div class="form-group">
                <select name="product_categories" id="" class="form-select">
                    <option value="">Select Product Category</option>
                    <?php
                        $select_query = "select * from categories";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $category_title = $row['category_title'];
                            $category_id = $row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?>
                    
                </select>                
            </div>

            <!-- brands -->
            <div class="form-group">
                <select name="product_brands" id="" class="form-select">
                    <option value="">Select Product Brands</option>
                    <?php
                        $select_query = "select * from brands";
                        $result_query = mysqli_query($con, $select_query);
                        while($row = mysqli_fetch_assoc($result_query)){
                            $brand_title = $row['brand_title'];
                            $brand_id = $row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?>
                </select>                
            </div>


            <!-- image1 -->
            <div class="form-group">
                <label for="product_photo1">Product Photo 1:</label>
                <input type="file" name="product_photo1" id="product_photo1" accept=".jpg,.jpeg,.png" >
            </div>

            <div class="form-group">
                <label for="product_photo2">Product Photo 2:</label>
                <input type="file" name="product_photo2" id="product_photo2" accept=".jpg,.jpeg,.png" >
            </div>

            <div class="form-group">
                <label for="product_photo3">Product Photo 3:</label>
                <input type="file" name="product_photo3" id="product_photo3" accept=".jpg,.jpeg,.png" >
            </div>

                <!-- price  -->
            <div class="form-group">
                <label for="product_price">Product Price:</label>
                <input type="text" name="product_price" id="product_price" placeholder="Enter product price" required="required">
            </div>
            
            <div class="form-group">
                <input class="submit" type="submit" name="insert_product" value="Insert Product">
            </div>
        </form>
    </div>

    </div>
    
    
</body>
</html>