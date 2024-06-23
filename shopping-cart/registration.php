<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
    
include ('./functions/common-function.php');
include ('database.php'); //include the database connection file


$errors = array(); //initialize an empty array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate and sanitize input data
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $photo = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $user_ip = getIPAddress();

    // Validate other form fields

    if(!preg_match("/^[a-zA-Z-' ]*$/", $username)){
        $errors[] = "Enter correct username";
    } elseif(strlen($username) > 25) {
        $errors[] = "Username should be maximum 25 characters long";
    }

    if(!preg_match("/^[0-9]*$/", $mobile)){
        $errors[] = "Enter correct mobile no.";
    } elseif(strlen($mobile) != 10) {
        $errors[] = "Mobile no. should be 10 digits";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Enter correct email id";
    }

    if (filter_var($address)<0){
        $errors[] = "Address Required";
    }

    if(strlen($password) < 8){
        $errors[] = "Password must be at least 8 characters long";
    } elseif(strlen($password) > 16) {
        $errors[] = "Password should have maximum 16 characters";
    }

    if($password != $confirm_password){
        $errors[] = "Password does not match";
    }


    // If there are no validation errors, proceed with insertion
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Generate a unique photo name
        // $photoName = $username . '.' . $photoExtension;
        // $targetPath = './user_img' . $photoName;


        
        // Check if the username is already taken
        $check_query = "SELECT * FROM users WHERE username = '$username'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('username already exists!')</script>";
            $errors[] = "Username already taken. Please choose a different username.";
        } else {
            // Insert data into the users table
            if (move_uploaded_file($photo_tmp, "./user_img/$photo")) {
                // Prepare and execute the SQL statement for insertion username	email	password	mobile	address	photo	user_ip	

                $sql = "INSERT INTO users (username, email, password, mobile, address, photo, user_ip ) 
                        VALUES ('$username', '$email', '$hashed_password', '$mobile', '$address', '$photo', '$user_ip')";
            
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('data inserted')</script>";
                    // Redirect to the login page after successful insertion
                    header("Location: login.php");
                    exit; // Terminate the script after redirection
                } else {
                    // die("Connection failed: " . mysqli_connect_error());
                    // Handle the insertion error
                    $errors[] = "Error inserting data into the database: " . mysqli_error($con);
                }
            } else {
                // Handle the photo upload error
                $errors['photo'] = "Error uploading the picture: " . error_get_last()['message'];
            }
        }
    }
    
    
//selecting cart items
$select_cart_items = "SELECT * FROM `cart_details` WHERE ip_address= '$user_ip'";    
$result_cart = mysqli_query($con, $select_cart_items);
$rows_count = mysqli_num_rows($result_cart);
if($rows_count>0){
    $_SESSION['username']=$username;
    echo "<script>alert('You have items in your cart')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";

}else{
    echo "<script>window.open('index.php','_self')</script>";

}


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Registration Form for user</title>
</head>
<body>
    <div class="container">
        
        <header class="register">New User Register</header>
        <form action="registration.php" method="post" class="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Enter your Username">
                <?php if(!empty($errors) && in_array("Enter correct username", $errors)) echo "<div class='error'>Enter correct username</div>"; ?>
                <?php if(!empty($errors) && in_array("Username should be maximum 25 characters long", $errors)) echo "<div class='error'>Username should be maximum 25 characters long</div>"; ?>
            </div>
            <div class="form-group">
                <label for="email">Email ID:</label>
                <input type="email" name="email" placeholder="Enter your email">
                <?php if(!empty($errors) && in_array("Enter correct email id", $errors)) echo "<div class='error'>Enter correct email id</div>"; ?>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile No.:</label>
                <input type="number" name="mobile" placeholder="Mobile number">
                <?php if(!empty($errors) && in_array("Enter correct mobile no.", $errors)) echo "<div class='error'>Enter correct mobile no.</div>"; ?>
                <?php if(!empty($errors) && in_array("Mobile no. should be 10 digits", $errors)) echo "<div class='error'>Mobile no. should be 10 digits</div>"; ?>
            </div>
            
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" placeholder="Enter your address">
                <?php if(!empty($errors) && in_array("Enter correct address", $errors)) echo "<div class='error'>Enter address</div>"; ?>

            </div>

            <div class="form-group">
                <label for="photo">Upload Photo:</label>
                <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png" placeholder="Photo">
                <?php if(!empty($errors['photo'])) echo "<div class='error'>" . $errors['photo'] . "</div>"; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password">
                <?php if(!empty($errors) && in_array("Password must be at least 8 characters long", $errors)) echo "<div class='error'>Password must be at least 8 characters long</div>"; ?>
                <?php if(!empty($errors) && in_array("Password should have maximum 16 characters", $errors)) echo "<div class='error'>Password should have maximum 16 characters</div>"; ?>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <?php if(!empty($errors) && in_array("Password does not match", $errors)) echo "<div class='error'>Password does not match</div>"; ?>
            </div>
            <div class="form-group">
                <input class="submit" type="submit" name="submit" value="Register">
            </div>
            <div class="login">
                <a href="login.php" class="reg-link">Already have account? Login</a>
            </div>
        </form>
    </div>
</body>
</html>
