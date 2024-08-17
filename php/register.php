<?php
// Include the database connection file
require_once 'connection.php';

// Initialize variables for form validation
$fullname = $username = $email = $password = $successMessage = $errorMessage = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $fullname = htmlspecialchars($_POST['fullname']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
    $phone = htmlspecialchars($_POST['phone']);

    // Check if the username already exists in the database
    $checkQuery = "SELECT COUNT(*) AS count FROM customers WHERE username = :username";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(':username', $username);
    $checkStmt->execute();
    $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $errorMessage = 'Username is already registered. Please choose a different username.';
        echo $errorMessage;
    } else {
        // Insert data into the database
        $insertQuery = "INSERT INTO customers (full_name, username, email, password, location, phone) VALUES (:fullname, :username, :email, :password, :location, :phone)";
        $insertStmt = $conn->prepare($insertQuery);

        $insertStmt->bindParam(':fullname', $fullname);
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':password',$password);
        $insertStmt->bindParam(':location',$location);
        $insertStmt->bindParam(':phone', $phone);


        if ($insertStmt->execute()) {
            $successMessage = 'Registration successful!';
            echo $successMessage;
            header('Location: ../index.php');
            // Clear form fields after successful registration
            $fullname = $username = $email = $password = '';
        } else {
            $errorMessage = 'Error during registration.';
            echo $errorMessage;
        }
    }
}

// Close the database connection
$conn = null;
?>
