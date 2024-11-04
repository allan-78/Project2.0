<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit();
}
include '../db/db.php';

// Logic for adding, updating, and viewing the cart
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Shopping Cart</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <h1>Your Shopping Cart</h1>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <!-- Cart items will be listed here dynamically from the session or database -->
        </table>
        <form method="POST" action="checkout.php">
            <button type="submit">Proceed to Checkout</button>
        </form>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
