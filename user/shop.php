<?php
session_start();
include '../db.php'; // Database connection

// Fetch products from the database
$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Product Catalog - EM Quality Shoes</title>
</head>
<body>
    <?php include '../includes/header.php'; ?> <!-- Include header -->

    <main>
        <h1>Shop Our Collection</h1>

        <!-- Filter Options -->
        <div class="filter-options">
            <h3>Filter by:</h3>
            <form method="GET" action="shop.php">
                <select name="brand">
                    <option value="">Select Brand</option>
                    <option value="Nike">Nike</option>
                    <option value="Adidas">Adidas</option>
                    <option value="Puma">Puma</option>
                    <option value="Reebok">Reebok</option>
                    <option value="New Balance">New Balance</option>
                </select>
                <select name="size">
                    <option value="">Select Size</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <input type="submit" value="Filter" class="btn">
            </form>
        </div>

        <div class="product-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <img src="../assets/img/products/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="description"><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="price">Price: $<?php echo number_format($row['price'], 2); ?></p>
                        <p class="rating">Rating: <?php echo htmlspecialchars($row['rating']); ?> ★</p>
                        <a href="product_details.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                        <button class="btn add-to-cart" data-id="<?php echo $row['id']; ?>">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products available at the moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?> <!-- Include footer -->
    <script src="../assets/js/script.js"></script> <!-- Include JavaScript for cart functionality -->
</body>
</html>
