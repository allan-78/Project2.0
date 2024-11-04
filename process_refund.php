<?php
session_start();
include '../db.php'; // Database connection

if (!isset($_POST['order_id'])) {
    header("Location: order_history.php");
    exit();
}

$orderId = intval($_POST['order_id']);

// Update the order status to 'Returned'
$query = "UPDATE orders SET status = 'Returned' WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $orderId);

if ($stmt->execute()) {
    // Optionally, you can add a success message
    $_SESSION['message'] = "Your order has been returned successfully.";
} else {
    $_SESSION['message'] = "Error in processing your return. Please try again.";
}

$stmt->close();
$conn->close();
header("Location: order_history.php");
exit();
?>
