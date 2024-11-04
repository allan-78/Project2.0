<?php
session_start();
include 'db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: user/dashboard.php");
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
