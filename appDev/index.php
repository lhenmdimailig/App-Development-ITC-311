<?php
require 'config.php';

$sql = "SELECT * FROM tbl_products";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql = "DELETE FROM tbl_products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple CRUD</title>
</head>
<body>
    <h1>Products</h1>
    
    <form action="create.php" method="get">
        <button type="submit">Add New Product</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                    <td>
                        <form action="update.php" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form action="index.php" method="post" style="display:inline;">
                            <input type="hidden" name="delete" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
