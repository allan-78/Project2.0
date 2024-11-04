<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>User Dashboard</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <div class="dashboard-links">
            <a href="shop.php" class="btn">Go to Shop</a>
            <a href="cart.php" class="btn">View Cart</a>
            <a href="order_history.php" class="btn">Order History</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
