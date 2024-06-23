<?php

@session_start();
     
include ('./functions/common-function.php');
include ('database.php'); //include the database connection file
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment page</title>

</head>
<style>
    body{
        display: flex;
        flex-direction: column;
        align-items:center;
    }

    .container{
        justify-content:center;
    }
    .container h1{
        text-align: center;
        margin-bottom: 50px;
    }
    .home-btn{
    height: 35px;
    width: 120px;
    color: #EEEEEE;
    font-size: 14px;
    font-weight: 400;
    margin-right: 20px;
    border: none;
    cursor: pointer;
    background: #31363F;
    transition: all 0.1s ease;
    border-radius: 6px;
    text-decoration: none;
}

</style>
<body>
    <?php

        $ip = getIPAddress();
        $get_user = "SELECT * FROM users WHERE user_ip= '$ip'";
        $result = mysqli_query($con, $get_user);
        $run_query = mysqli_fetch_array($result);
        $user_id = $run_query['user_id'];


    ?>
    <div class="container">
    <h1>PAYMENT</h1>

    <div class="status">
        <h3>Pay Offline</h3>
        <button class='home-btn'><a class='home-btn' href='order.php?user_id=<?php echo $user_id ?>'>pay</a></button>

        <button class='home-btn'><a class='home-btn' href='index.php'>Go To Home</a></button>

    </div>

    </div>
    
    
</body>
</html>