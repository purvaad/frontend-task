<?php 
session_start();
    
include 'functions.php';
include 'database.php'; //include the database connection file

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="index.css">
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

	
    <h1>Welcome, this is your Dashboard.</h1>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Email</th>
                    <th scope="col">photo</th> 
                    <!-- <th scope="col">Email</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql= "SELECT * FROM user ORDER BY created_at DESC LIMIT 5";
                $result = mysqli_query($con, $sql);
                while($row=mysqli_fetch_array($result)){
                    $id = $row["id"];
                    $fname = $row["fname"];
                    $lname = $row["lname"];
                    $username = $row["username"];
                    $mobile = $row["mobile"];
                    $email = $row["email"];
                    $photo = $row["photo"];

                    $imagePath = 'uploads/' . $photo;

                    echo "<tr>
                    <th scope='row'>$id</th>
                    <td>$fname</th>
                    <td>$lname</th>
                    <td>$username</th>
                    <td>$mobile</th>
                    <td>$email</th>
                    <td><img src='$imagePath' alt='User Photo' width='100'></th> 
                    </tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    
    
</body>
</html>