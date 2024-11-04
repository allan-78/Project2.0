<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add or update product
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $brand = $_POST['brand'];
    $sex = $_POST['sex'];
    $color = $_POST['color'];
    $style = $_POST['style'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];

    // Handle image upload
    $productImage = $_FILES['product_image']['name'];
    $target_dir = "../assets/img/products/";
    $target_file = $target_dir . basename($productImage);
    move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);

    // Insert or update product
    if (isset($_POST['product_id'])) {
        // Update product
        $productId = $_POST['product_id'];
        $sql = "UPDATE products SET name='$productName', price=$price, size='$size', brand='$brand', sex='$sex', color='$color', style='$style', rating=$rating, description='$description', image='$productImage' WHERE id=$productId";
    } else {
        // Add new product
        $sql = "INSERT INTO products (name, price, size, brand, sex, color, style, rating, description, image) VALUES ('$productName', $price, '$size', '$brand', '$sex', '$color', '$style', $rating, '$description', '$productImage')";
    }
    if ($conn->query($sql) === TRUE) {
        echo "Product saved successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch products for display
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Manage Products</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Manage Products</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Product Name:</label>
            <input type="text" name="product_name" required>
            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>
            <label>Size:</label>
            <input type="text" name="size" required>
            <label>Brand:</label>
            <input type="text" name="brand" required>
            <label>Sex:</label>
            <select name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="unisex">Unisex</option>
            </select>
            <label>Color:</label>
            <input type="text" name="color" required>
            <label>Style:</label>
            <input type="text" name="style" required>
            <label>Rating:</label>
            <input type="number" step="0.1" max="5" name="rating">
            <label>Description:</label>
            <textarea name="description"></textarea>
            <label>Product Image:</label>
            <input type="file" name="product_image" required>
            <button type="submit">Save Product</button>
        </form>
        
        <h2>Product List</h2>
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php while ($product = $products->fetch_assoc()): ?>
                <tr>
                    <td><img src="../assets/img/products/<?php echo $product['image']; ?>" width="50"></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
                        <a href="delete_product.php?id=<?php echo $product['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
