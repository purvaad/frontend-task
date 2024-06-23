<?php
session_start();
include 'functions.php';
include 'database.php';

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
                        <a class="home" href="index.php">Home</a>
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
        
        <form method="post" class="form">
            <?php

                $currentUser = $user_data['username'];
                $sql = "SELECT * FROM user WHERE username = '$currentUser'";

                $result = mysqli_query($con , $sql);

                if($result){
                    if(mysqli_num_rows($result)){
                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" name="fname" value="<?php echo $row['fname']; ?>">
                            
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" name="lname" value="<?php echo $row['lname']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" value="<?php echo $row['username']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile No.:</label>
                                <input type="number" name="mobile" value="<?php echo $row['mobile']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email ID:</label>
                                <input type="email" name="email" value="<?php echo $row['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="photo">Current Photo:</label>
                                <?php
                                $imagePath = 'uploads/' . $row['photo'];
                                if (!empty($imagePath) && file_exists($imagePath)) {
                                    echo "<img src='$imagePath' alt='User Photo' width='100'>";
                                } else {
                                    echo "No photo available";
                                }
                                ?>

                            </div>
                            

                           
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" value="<?php echo $row['password']; ?>">
                            </div>

                            <?php
                            
                        }
                    }
                }
            ?>

            <div class="form-group">
                <div class="row">
                    <a href="edit-profile.php"><button class="button-update" type="button" name="update">Update Profile</button></a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
