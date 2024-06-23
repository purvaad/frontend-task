<?php
include ('../database.php');

// Fetch users from the database
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($con, $user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>View Users</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Photo</th>
                <th>User IP</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterate over each user and display their details
            while ($row = mysqli_fetch_assoc($user_result)) {
                echo "<tr>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['mobile']}</td>";
                echo "<td>{$row['address']}</td>";
                echo "<td><img src='../user_img/{$row['photo']}' alt='User Photo' width='100'></td>";
                echo "<td>{$row['user_ip']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
