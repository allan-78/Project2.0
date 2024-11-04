<?php
session_start();
include '../db.php'; // Database connection

if (!isset($_GET['id'])) {
    header("Location: shop.php");
    exit();
}

$productId = $_GET['id'];
$query = "SELECT * FROM products WHERE id = " . intval($productId);
$result = $conn->query($query);
$product = $result->fetch_assoc();

if (!$product) {
    header("Location: shop.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title><?php echo htmlspecialchars($product['name']); ?> - EM Quality Shoes</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>

        <div class="product-details">
            <img src="../assets/img/products/<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <div class="details">
                <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price">Price: $<?php echo number_format($product['price'], 2); ?></p>
                <p class="rating">Rating: <?php echo htmlspecialchars($product['rating']); ?> ★</p>

                <h3>Select Size:</h3>
                <form method="POST" action="add_to_cart.php">
                    <select name="size" required>
                        <option value="">Choose a size</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="reviews">
            <h3>Customer Reviews</h3>
            <!-- Placeholder for reviews; you can fetch these from the database -->
            <p>No reviews yet.</p>
        </div>

        <div class="return-policy">
            <h3>Return Policy</h3>
            <p>If you are not satisfied with your purchase, you can return it within 30 days for a full refund.</p>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
