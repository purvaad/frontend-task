<?php

include ('../database.php');

if(isset($_POST['insert_brand'])){
    $brands_title = $_POST['brand_title'];

    $select_query = "SELECT * FROM brands WHERE brand_title='$brands_title' ";
    $select_result = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($select_result);
    if($number>0){
        echo "<script>alert('Brand already present!')</script>";
    }else{
        $insert_query = "INSERT INTO brands (brand_title) VALUES ('$brands_title')";
        $result = mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Brand inserted successfully.')</script>";
        }
    } 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert category</title>
</head>
<style>

    .form-brand{
        width: 80%;
        margin: 20px auto;
    }
    .input-brand{
        width: 200px;
    }
    .submit-brand{
        height: 35px;
        width: 140px;
        color: #EEEEEE;
        font-size: 12px;
        font-weight: 400;
        margin: 0 20px;
        border: none;
        cursor: pointer;
        background: #31363F;
        transition: all 0.1s ease;
        border-radius: 6px;
        text-decoration: none;
    }
</style>
<body>
<h2>Insert Categories</h2>

<form action="" method="post" class="form-brand">
    <!-- margin=2 -->
            <div class="form-group">
                <label for="brand_title">Brand Name:</label>
                <input type="text" name="brand_title" placeholder="Insert Brands" class="input-brand">
            </div>
            <br>
           
            <div class="form-group">
                 <input class="submit-brand" type="submit" name="insert_brand" value="Insert Brands">
            </div>
            
</form>
    
</body>
</html>
