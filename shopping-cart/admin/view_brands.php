<?php
include ('../database.php');

// Fetch brands from the database
$brand_query = "SELECT * FROM brands";
$brand_result = mysqli_query($con, $brand_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>View Brands</h2>
    <table>
        <thead>
            <tr>
                <th>Brand ID</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterate over each brand and display its details
            while ($row = mysqli_fetch_assoc($brand_result)) {
                echo "<tr>";
                echo "<td>{$row['brand_id']}</td>";
                echo "<td>{$row['brand_title']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
