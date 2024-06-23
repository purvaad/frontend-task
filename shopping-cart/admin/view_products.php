<?php
include ('../database.php');

// Fetch products from the database
$product_query = "SELECT * FROM products";
$product_result = mysqli_query($con, $product_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>View Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Brand ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterate over each product and display its details
            while ($row = mysqli_fetch_assoc($product_result)) {
                echo "<tr>";
                echo "<td>{$row['product_id']}</td>";
                echo "<td>{$row['product_title']}</td>";
                echo "<td>{$row['product_description']}</td>";
                echo "<td>{$row['product_price']}</td>";
                echo "<td>{$row['category_id']}</td>";
                echo "<td>{$row['brand_id']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
