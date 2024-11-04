<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../db/db.php';

// Fetch all transactions
$transactionQuery = "SELECT * FROM orders ORDER BY order_date DESC";
$transactionResults = $conn->query($transactionQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Transaction Management</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Transaction Management</h1>
        <table class="table">
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
            <?php while ($transaction = $transactionResults->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $transaction['id']; ?></td>
                    <td><?php echo $transaction['user_id']; ?></td>
                    <td><?php echo $transaction['order_date']; ?></td>
                    <td><?php echo $transaction['status']; ?></td>
                    <td><?php echo $transaction['total_amount']; ?></td>
                    <td><a href="transaction_details.php?order_id=<?php echo $transaction['id']; ?>">View Details</a></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
