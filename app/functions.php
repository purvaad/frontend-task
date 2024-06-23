<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

function check_login($con){
    if(isset($_SESSION['username']))
    {
        $username = $_SESSION['username']; 
        $query = "SELECT * FROM user WHERE username = '$username' LIMIT 1"; 

        $result = mysqli_query($con, $query);
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;

        }
    }

    //redirect to login
    header("Location: login.php");
    die;
}
?>
