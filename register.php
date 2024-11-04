<?php
include 'db/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $role = 'user'; // default role for new users

    // Handle file upload for profile picture
    $profileImage = $_FILES['profile_image']['name'];
    $target_dir = "assets/img/profiles/";
    $target_file = $target_dir . basename($profileImage);
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password, email, firstname, lastname, address, age, sex, role, profile_image)
            VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$address', $age, '$sex', '$role', '$profileImage')";
    if ($conn->query($sql) === TRUE) {
        echo "<p>Registration successful! <a href='login.php'>Login here</a></p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/style.css">
    <title>User Registration</title>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="form-container">
        <h2>Register</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <label>Email:</label>
            <input type="email" name="email" required>
            <label>First Name:</label>
            <input type="text" name="firstname">
            <label>Last Name:</label>
            <input type="text" name="lastname">
            <label>Address:</label>
            <input type="text" name="address">
            <label>Age:</label>
            <input type="number" name="age">
            <label>Sex:</label>
            <select name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
            <label>Profile Picture:</label>
            <input type="file" name="profile_image">
            <button type="submit">Register</button>
        </form>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
