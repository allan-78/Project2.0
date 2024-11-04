<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "em_quality_shoes";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Use a more user-friendly error message for production
    die("Database connection failed. Please try again later.");
}

// Set the character set to UTF-8 for proper encoding
$conn->set_charset("utf8");

// Function to securely close the connection
function closeConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}

// Example function to register a new user (as a reference for prepared statements)
function registerUser($firstname, $lastname, $age, $sex, $address, $email, $password, $profile_picture) {
    global $conn;

    // Hash the password before storing it
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (firstname, lastname, age, sex, address, email, password, profile_picture)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssisssss", $firstname, $lastname, $age, $sex, $address, $email, $passwordHash, $profile_picture);

    // Execute statement
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Close statement
    $stmt->close();
}

// Function to log in a user
function loginUser($email, $enteredPassword) {
    global $conn;

    // Prepare SQL statement
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $storedPasswordHash);
        $stmt->fetch();

        // Verify the password
        if (password_verify($enteredPassword, $storedPasswordHash)) {
            session_regenerate_id(true); // Regenerate session ID
            $_SESSION['user_id'] = $id; // Set user session variable
            return true; // Login successful
        }
    }
    return false; // Login failed
}

// Close the connection when done
// closeConnection($conn);
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "em_quality_shoes";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Use a more user-friendly error message for production
    die("Database connection failed. Please try again later.");
}

// Set the character set to UTF-8 for proper encoding
$conn->set_charset("utf8");

// Function to securely close the connection
function closeConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}

// Example function to register a new user (as a reference for prepared statements)
function registerUser($firstname, $lastname, $age, $sex, $address, $email, $password, $profile_picture) {
    global $conn;

    // Hash the password before storing it
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO users (firstname, lastname, age, sex, address, email, password, profile_picture)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssisssss", $firstname, $lastname, $age, $sex, $address, $email, $passwordHash, $profile_picture);

    // Execute statement
    if (!$stmt->execute()) {
        die("Error executing statement: " . $stmt->error);
    }

    // Close statement
    $stmt->close();
}

// Function to log in a user
function loginUser($email, $enteredPassword) {
    global $conn;

    // Prepare SQL statement
    $sql = "SELECT id, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $storedPasswordHash);
        $stmt->fetch();

        // Verify the password
        if (password_verify($enteredPassword, $storedPasswordHash)) {
            session_regenerate_id(true); // Regenerate session ID
            $_SESSION['user_id'] = $id; // Set user session variable
            return true; // Login successful
        }
    }
    return false; // Login failed
}

// Close the connection when done
// closeConnection($conn);
?>
