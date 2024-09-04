<?php
include 'db.php';

$sql = "SELECT * FROM tbl_products";
$stmt = $conn->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
    <a href="create.php">
        <button type="button">Add New Product</button>
    </a>
    
    <?php
    if (count($products) > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>";
        foreach ($products as $product) {
            echo "<tr>
                    <td>{$product['id']}</td>
                    <td>{$product['name']}</td>
                    <td>{$product['description']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['quantity']}</td>
                    <td>{$product['created_at']}</td>
                    <td>{$product['updated_at']}</td>
                    <td>
                        <form action='update.php' method='get' style='display:inline;'>
                            <input type='hidden' name='id' value='{$product['id']}'>
                            <button type='submit'>Edit</button>
                        </form>
                        <form action='delete.php' method='post' style='display:inline;'>
                            <input type='hidden' name='id' value='{$product['id']}'>
                            <button type='submit' onclick='return confirm(\"Are you sure you want to delete this product?\");'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No products found";
    }
    ?>
</body>
</html>
