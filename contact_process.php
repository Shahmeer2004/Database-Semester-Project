<?php
require 'db_connect.php'; // Use your existing database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        die("All fields are required.");
    }

    // Insert message into DB
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Thank you for your message, $name!";
    } else {
        echo "Something went wrong: " . $stmt->error;
    }

    $conn->close();
}
?>
