<?php
@include ('./database.php');

// Fetch orders from the database
$order_query = "SELECT * FROM orders";
$order_result = mysqli_query($con, $order_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
        
    </style>
</head>
<body>
    <h2>Order Details</h2>
    <table>
        <thead>
            <tr>
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
            // Iterate over each row of the result set
            while ($row = mysqli_fetch_assoc($order_result)) {
                echo "<tr>";
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
