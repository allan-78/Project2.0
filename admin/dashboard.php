<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Admin Dashboard</h1>
        <div class="dashboard-links">
            <a href="manage_products.php" class="btn">Manage Products</a>
            <a href="manage_orders.php" class="btn">Manage Orders</a>
            <a href="manage_users.php" class="btn">Manage Users</a>
            <a href="view_transactions.php" class="btn">View Transactions</a>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
