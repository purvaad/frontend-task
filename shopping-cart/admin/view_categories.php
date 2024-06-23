<?php
include ('../database.php');

// Fetch categories from the database
$category_query = "SELECT * FROM categories";
$category_result = mysqli_query($con, $category_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h2>View Categories</h2>
    <table>
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterate over each category and display its details
            while ($row = mysqli_fetch_assoc($category_result)) {
                echo "<tr>";
                echo "<td>{$row['category_id']}</td>";
                echo "<td>{$row['category_title']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
