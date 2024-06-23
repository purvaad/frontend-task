<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

@session_start();
     
include ('./functions/common-function.php');
include ('database.php'); //include the database connection file


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
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user_ip = getIPAddress();

            //cart item
            $query_cart = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
            $select_cart = mysqli_query($con, $query_cart);
            $row_count_cart = mysqli_num_rows($select_cart);

            if ($result && mysqli_num_rows($result) > 0) {
                $_SESSION['username'] = $user_data['username'];

                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['username'] = $user_data['username'];
                    if(mysqli_num_rows($result)==1 and $row_count_cart==0){
                        echo "<script>alert('Login successfully!')</script>";
                        echo "<script>window.open('profile.php','_self')</script>";
                    }else{
                        $_SESSION['username'] = $user_data['username'];

                        echo "<script>alert('Login successfully!')</script>";
                        echo "<script>window.open('payment.php','_self')</script>";
                    }
                    
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
    <div class="container_form">
        <header class="login">Login</header>
        <?php if (!empty($errors)) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form method="post" class="container_form">
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
            <br><br>
            <div class="register">
                <a href="registration.php" class="reg-link">Don't have account? Register</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php



?>
