<?php
// Include the database connection file
require_once 'connection.php';

// Initialize variables for form validation
$username = htmlspecialchars($_POST['username']);
$password = $_POST['password'];

// Retrieve user information from the database based on the entered username
$query = "SELECT * FROM customers WHERE username = :username";
$stmt = $conn->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// After successful login
if ($user) {
    // Verify the entered password against the stored hash
    $hashedPassword = $user['password'];
    if (password_verify($password, $hashedPassword)) {
        // Start a session and set session variables
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the home page
        header('Location: ../index.php');
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo 'Incorrect password';
    }
} else {
    echo 'User not found';
} 

// Close the database connection
$conn = null;
?>
