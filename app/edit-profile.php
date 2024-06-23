<?php
session_start();
include 'functions.php';
include 'database.php';

$user_data = check_login($con);

$errors = array();

// To get current username from session
$currentUsername = $_SESSION['username'];

if(isset($_POST['update'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password']; 

    $newPhotoUploaded = ($_FILES["photo"]["error"] !== 4);

    //check if a photo is uploaded
    if($newPhotoUploaded) { //only validate if new photo is uploaded
        //validate photo file
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
        // Handle file upload
        if ($newPhotoUploaded) {
            $photoName = $_FILES["photo"]["name"];
            $targetPath = 'uploads/' . $photoName;
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetPath)) {
                // Update photo in the database
                mysqli_query($con, "UPDATE user SET photo='$photoName' WHERE username='$currentUsername'");
            } else {
                $errors[] = "Failed to move uploaded file";
            }
        }

        // Hash the password if provided
        $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

        // Update user profile
        $update_query = "UPDATE user SET fname='$fname', lname='$lname', username='$username', mobile='$mobile', email='$email'";
        if ($hashed_password !== null) {
            $update_query .= ", password='$hashed_password'";
        }
        $update_query .= " WHERE username='$currentUsername'";

        $result = mysqli_query($con, $update_query);
        if ($result) {
            header("location:userprofile.php?profile_updated=1");
            exit;
        } else {
            $errors[] = 'Error updating profile: ' . mysqli_error($con);
        }

    }
}

// Delete Profile function
if(isset($_POST['delete_profile'])){
    // Perform deletion of the users account
    mysqli_query($con, "DELETE FROM user WHERE username='$currentUsername'");
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./edit.css">
</head>
<body> 
    <header>
        <nav class="navbar">
				<ul class="items-left">
					<li class="nav-item">
                        <h1>Hello, <?php echo $user_data['username'] ; ?>!</h1> 
                    </li>
                </ul>
                <ul class="items-right">
					<li class="nav-item">
                        <a class="home" href="#">Home</a>
                    </li>
					<li class="nav-item">
                        <a class="link" href="userprofile.php">Edit Profile</a>
                    </li>
					<li class="nav-item">
                        <a href="logout.php" class="logout">Logout</a>
                    </li>

				</ul>
        </nav>
    </header>
    <div class="container">
        <h1 class="title">Edit your profile</h1>        

        <form method="post" class="form" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php
            $sql = "SELECT * FROM user WHERE username = '$currentUsername'";
            $result = mysqli_query($con, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                    <?php if(!empty($errors) && in_array("Only letters allowed for First Name", $errors)) echo "<div class='error'>Only letters allowed for First Name</div>"; ?>
                    <?php if(!empty($errors) && in_array("First name should have minimum 3 characters", $errors)) echo "<div class='error'>First name should have minimum 3 characters</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                    <?php if(!empty($errors) && in_array("Only letters allowed for Last Name", $errors)) echo "<div class='error'>Only letters allowed for Last Name</div>"; ?>
                    <?php if(!empty($errors) && in_array("Last name should have minimum 2 characters", $errors)) echo "<div class='error'>Last name should have minimum 2 characters</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" value="<?php echo $row['username']; ?>">
                    <?php if(!empty($errors) && in_array("Enter correct username", $errors)) echo "<div class='error'>Enter correct username</div>"; ?>
                    <?php if(!empty($errors) && in_array("Username should be maximum 25 characters long", $errors)) echo "<div class='error'>Username should be maximum 25 characters long</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="mobile">Mobile No.:</label>
                    <input type="number" name="mobile" value="<?php echo $row['mobile']; ?>">
                    <?php if(!empty($errors) && in_array("Enter correct mobile no.", $errors)) echo "<div class='error'>Enter correct mobile no.</div>"; ?>
                    <?php if(!empty($errors) && in_array("Mobile no. should be 10 digits", $errors)) echo "<div class='error'>Mobile no. should be 10 digits</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>">
                    <?php if(!empty($errors) && in_array("Enter correct email id", $errors)) echo "<div class='error'>Enter correct email id</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="photo">Current Photo:</label>
                    <?php if (!empty($row['photo'])): ?>
                        <img src="uploads/<?php echo $row['photo']; ?>" alt="User Photo" width="50">
                    <?php else: ?>
                        No photo available
                    <?php endif; ?>
                    <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png">
                    <?php if(!empty($errors['photo'])) echo "<div class='error'>" . $errors['photo'] . "</div>"; ?>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                    <?php if(!empty($errors) && in_array("Password must be at least 8 characters long", $errors)) echo "<div class='error'>Password must be at least 8 characters long</div>"; ?>
                    <?php if(!empty($errors) && in_array("Password should have maximum 16 characters", $errors)) echo "<div class='error'>Password should have maximum 16 characters</div>"; ?>

                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password">
                    <?php if(!empty($errors) && in_array("Password does not match", $errors)) echo "<div class='error'>Password does not match</div>"; ?>
                </div>
            <?php } ?>
            <div class="form-group">
                <div class="row">
                    <button class="button" type="submit" name="update">Update Profile</button>
                    <!-- Delete Profile button -->
                    <button class="button" type="button" onclick="confirmDelete()">Delete Profile</button>
                </div>
            </div>
        </form>
    </div>

    <!-- JS function for deletion -->
    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete the profile?");
            if (result) {
                // If user confirms, submit the form for profile deletion
                document.getElementById("deleteForm").submit();
            }
        }
    </script>

    <!-- for profile deletion -->
    <form id="deleteForm" method="post">
        <input type="hidden" name="delete_profile">
    </form>
</body>
</html>
