<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
include '../db/db.php';

$userId = $_SESSION['user_id'];

// Fetch the user's orders
$orderQuery = "SELECT * FROM orders WHERE user_id = $userId ORDER BY order_date DESC";
$orderResults = $conn->query($orderQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Order History</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Your Order History</h1>
        <table class="table">
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
            <?php while ($order = $orderResults->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $order['id']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['total_amount']; ?></td>
                    <td><a href="order_details.php?order_id=<?php echo $order['id']; ?>">View Details</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
