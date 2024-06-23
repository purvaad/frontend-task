<?php
session_start();
    
include 'functions.php';
include 'database.php'; //include the database connection file


$errors = array(); //initialize an empty array to store validation errors

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //validate and sanitize input data
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    
    // Check if a photo is uploaded
    if($_FILES["photo"]["error"] === 4) {
        $errors['photo'] = "User Photo is required";
    } else {    
        // Validate photo file
        $validExtensions = ['jpg', 'jpeg', 'png'];
        $photoExtension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            
        if(!in_array($photoExtension, $validExtensions)) {
            $errors['photo'] = "Only JPG, JPEG, and PNG file types are allowed";
        } 
            
        if($_FILES['photo']['size'] > 2000000) {
            $errors['photo'] = "Photo size should be less than 2 MB";
        }
    }

    // Validate other form fields
    if(!preg_match("/^[a-zA-Z-' ]*$/", $fname)){
        $errors[] = "Only letters allowed for First Name";
    } elseif(strlen($fname) < 3) {
        $errors[] = "First name should have minimum 3 characters";
    }

    if(!preg_match("/^[a-zA-Z-' ]*$/", $lname)){
        $errors[] = "Only letters allowed for Last Name";
    } elseif(strlen($lname) < 2) {
        $errors[] = "Last name should have minimum 2 characters";
    }

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
        $photoName = $username . '.' . $photoExtension;
        $targetPath = './uploads/' . $photoName;
        
        // Check if the username is already taken
        $check_query = "SELECT * FROM user WHERE username = '$username'";
        $check_result = mysqli_query($con, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "Username already taken. Please choose a different username.";
        } else {
            // Insert data into the user table
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
                // Prepare and execute the SQL statement for insertion
                $sql = "INSERT INTO user (fname, lname, username, mobile, email, photo, password) 
                        VALUES ('$fname', '$lname', '$username', '$mobile', '$email', '$photoName', '$hashed_password')";
            
                if (mysqli_query($con, $sql)) {
                    // Redirect to the login page after successful insertion
                    header("Location: login.php");
                    exit; 
                } else {
                    // Handle the insertion error
                    $errors[] = "Error inserting data into the database: " . mysqli_error($con);
                }
            } else {
                // Handle the photo upload error
                $errors['photo'] = "Error uploading the picture: " . error_get_last()['message'];
            }
        }
    }
    
    
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Registration Form</title>
</head>
<body>
    <div class="container">
        
        <header class="register">Register</header>
        <form action="registration.php" method="post" class="form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" placeholder="First Name">
                <?php if(!empty($errors) && in_array("Only letters allowed for First Name", $errors)) echo "<div class='error'>Only letters allowed for First Name</div>"; ?>
                <?php if(!empty($errors) && in_array("First name should have minimum 3 characters", $errors)) echo "<div class='error'>First name should have minimum 3 characters</div>"; ?>
            </div>
            <div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" placeholder="Last Name">
                <?php if(!empty($errors) && in_array("Only letters allowed for Last Name", $errors)) echo "<div class='error'>Only letters allowed for Last Name</div>"; ?>
                <?php if(!empty($errors) && in_array("Last name should have minimum 2 characters", $errors)) echo "<div class='error'>Last name should have minimum 2 characters</div>"; ?>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Username">
                <?php if(!empty($errors) && in_array("Enter correct username", $errors)) echo "<div class='error'>Enter correct username</div>"; ?>
                <?php if(!empty($errors) && in_array("Username should be maximum 25 characters long", $errors)) echo "<div class='error'>Username should be maximum 25 characters long</div>"; ?>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile No.:</label>
                <input type="number" name="mobile" placeholder="Mobile number">
                <?php if(!empty($errors) && in_array("Enter correct mobile no.", $errors)) echo "<div class='error'>Enter correct mobile no.</div>"; ?>
                <?php if(!empty($errors) && in_array("Mobile no. should be 10 digits", $errors)) echo "<div class='error'>Mobile no. should be 10 digits</div>"; ?>
            </div>
            <div class="form-group">
                <label for="email">Email ID:</label>
                <input type="email" name="email" placeholder="Email">
                <?php if(!empty($errors) && in_array("Enter correct email id", $errors)) echo "<div class='error'>Enter correct email id</div>"; ?>
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
