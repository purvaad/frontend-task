
<?php
$hostname = "172.104.166.158";  
$username = "training_purvad";       
$password = "EDFusc9uZg0Sp5jq";           
$database = "training_purvad";  

//attempt to establish a connection
$con = mysqli_connect($hostname, $username, $password, $database);

//check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} 
else {
    // echo "Connected successfully!";
}
?>