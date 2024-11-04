<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="admin/dashboard.php">Admin Dashboard</a>
        <?php elseif (isset($_SESSION['role'])): ?>
            <a href="user/dashboard.php">Dashboard</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </nav>
</header>
