<?php
include_once "../php/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $subject = $_POST["Subject"];
    $message = $_POST["Message"];

    // Prepare and execute the SQL statement to insert data into the 'suggestions' table
    $sql = "INSERT INTO suggestion (fullname, email, subject, message) VALUES (:name, :email, :subject, :message)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);
        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
$conn = null;
?>