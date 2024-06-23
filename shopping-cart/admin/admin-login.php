<?php
@session_start();

include 'functions.php';
include ('../database.php');

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if (empty($username) || empty($password)) {
        $errors[] = "Please enter all credentials to login...";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
            $errors[] = "Enter correct username";
        } elseif (strlen($username) > 25) {
            $errors[] = "Username should be maximum 25 characters long";
        }

        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long";
        } elseif (strlen($password) > 16) {
            $errors[] = "Password should have maximum 16 characters";
        }

        if (empty($errors)) {
            $sql = "SELECT * FROM `admin` WHERE username = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['username'] = $user_data['username'];
                    header("Location: index.php");
                    die;
                }
            }
            $errors[] = "Wrong username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <div class="container">
        <header class="login">Admin Login</header>
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" class="form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input class="submit" type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
    <footer class="footer">
    <div class="footer-bottom">
    <p>&copy; 2024 My Shopping Cart - by Purva(multidots) All rights reserved.</p>
    </div>
</footer>
</body>
</html>
