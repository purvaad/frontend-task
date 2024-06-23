<?php

if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM users WHERE username = '$username'";
    $result_query = mysqli_query($con, $select_query );
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $email = $row_fetch['email'];
    $mobile = $row_fetch['mobile'];
    $address = $row_fetch['address'];
}

    if(isset($_POST['user_update'])){
        $update_id = $user_id;
        $username = $_POST['username'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        $photo = $_FILES['photo']['name'];
        $photo_imp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($photo_tmp, "./user_img/$photo");

        //update details
        $update_user = "UPDATE users SET username='$username',email = '$email',mobile = $mobile, address = '$address', photo = '$photo' where user_id = $user_id";
        $result_update = mysqli_query($con, $update_user);
        if($result_update){
            echo "<script>User Profile Updated!</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit acc</title>
</head>
<style>
    .form{
    margin-top: 30px;
}

.form .form-group{
    width: 100%;
    margin-top: 10px;
}

.form-group label{
    color: #222831;
    font-size: 12px;
    float: left;

}

.form :where(.form-group input) {
    position: relative;
    margin: 0 auto;
    height: 35px;
    width: 100%;
    padding: 5px 15px;
    font-size: 14px;
    color: #31363F;
    border: 1px solid #ddd;
    border-radius: 6px;
    outline: none;
    background-color: #EEEEEE;
  }
input.img{
    display: inline-flex;
    width: 42%;
}

.submit{
    height: 40px;
    width: 60%;
    color: #EEEEEE;
    font-size: 18px;
    font-weight: 400;
    margin-top: 10px;
    border: none;
    cursor: pointer;
    background: #31363F;
    transition: all 0.1s ease;
    border-radius: 6px;

}
</style>
<body>
    <h2 class="title">Edit Account</h2>    
    <form action="" method="post" class="form" enctype="multipart/form-data">
    <div class="form-group">
                <label for="username">Your Username:</label>
                <input type="text" name="username" placeholder="Enter your Username" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <label for="email">Your Email ID:</label>
                <input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
            </div>

            <div class="form-group">
                <label for="mobile">Your Mobile No.:</label>
                <input type="number" name="mobile" placeholder="Mobile number" value="<?php echo $mobile; ?>">
            </div>
            
            <div class="form-group">
                <label for="address">Your Address:</label>
                <input type="text" name="address" placeholder="Enter your address" value="<?php echo $address; ?>">
            </div>

            <div class="form-group">
                <label for="photo">Your Photo:</label>
                <input class="img" type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png">
                <img src="./user_img/<?php echo $user_img?>" alt='User Photo' width='100'>
            </div>
            
            <div class="form-group">
                <input class="submit" type="submit" name="user_update" value="Edit Account">
            </div>
    </form>
    
</body>
</html>