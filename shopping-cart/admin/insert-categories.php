<?php

include ('../database.php');

if(isset($_POST['insert_cat'])){
    $category_title = $_POST['cat_title'];

    $select_query = "SELECT * FROM categories WHERE category_title='$category_title' ";
    $select_result = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($select_result);
    if($number>0){
        echo "<script>alert('Category already present!')</script>";
    }else{
        $insert_query = "INSERT INTO categories (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Category inserted successfully.')</script>";
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

    .form-cat{
        width: 80%;
        margin: 20px auto;
    }
    .input-cat{
        width: 200px;
    }
    .submit-cat{
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
    <form action="" method="post" class="form-cat">
            <div class="form-group">
                <label for="cat_title">Category Name:</label>
                <input class="input-cat" type="text" name="cat_title" placeholder="Insert Category">
            </div>
            <br>
           
            <div class="form-group">
                 <input class="submit-cat" type="submit" name="insert_cat" value="Insert Category">
            </div>
            
</form>
    
</body>
</html>
