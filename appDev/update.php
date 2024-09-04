<?php
require 'config.php';

// Ensure the id parameter is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request. No ID provided.");
}

$id = $_GET['id'];

// Fetch product data for the given id
$sql = "SELECT * FROM tbl_products WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE tbl_products SET name = ?, description = ?, price = ?, quantity = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $quantity, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
        <p>Name: <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required></p>
        <p>Description: <input type="text" name="description" value="<?php echo htmlspecialchars($product['description']); ?>" required></p>
        <p>Price: <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required></p>
        <p>Quantity: <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required></p>
        <button type="submit" name="update">Update Product</button>
    </form>
    <form action="index.php" method="get">
        <button type="submit">Back to Product</button>
    </form>

</body>
</html>
