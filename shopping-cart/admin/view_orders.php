<?php
include ('../database.php');

// Fetch orders from the database
$order_query = "SELECT * FROM orders";
$order_result = mysqli_query($con, $order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>View Orders</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Amount Due</th>
                <th>Invoice Number</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Order Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterate over each order and display its details
            while ($row = mysqli_fetch_assoc($order_result)) {
                echo "<tr>";
                echo "<td>{$row['order_id']}</td>";
                echo "<td>{$row['user_id']}</td>";
                echo "<td>{$row['amount_due']}</td>";
                echo "<td>{$row['invoice_number']}</td>";
                echo "<td>{$row['total_products']}</td>";
                echo "<td>{$row['order_date']}</td>";
                echo "<td>{$row['order_status']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
