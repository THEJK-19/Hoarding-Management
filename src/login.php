<?php
// Your database credentials
$servername = "localhost";
$username = "email";
$password = "password";
$dbname = "hoarding_management";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Hash password function
function hashPassword($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    return $hash;
}

// Verify login credentials
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve the user's hashed password from the database
    $query = "SELECT password FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the entered password with the stored hashed password
        if (password_verify($password, $hashedPassword)) {
            // Passwords match, redirect to the home page
            header("Location: main.php");
            exit();
        } else {
            // Passwords do not match, display an error message
            $errorMessage = "Error: Incorrect email or password. Please try again.";
        }
    } else {
        // No user found with the entered email, display an error message
        $errorMessage = "Error: Incorrect email or password. Please try again.";
    }
}

// Close database connection
$conn->close();
?>
