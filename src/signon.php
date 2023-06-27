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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Verify that the entered password and confirm password match
    if ($password !== $confirmPassword) {
        $errorMessage = "Error: Passwords do not match. Please try again.";
    } 
    else {
        // Hash the password
        $hashedPassword = hashPassword($password);

        // Save the user credentials in the database
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";
        if ($conn->query($query) === TRUE) {
            echo "User registered successfully.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();

?>
