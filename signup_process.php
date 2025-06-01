<?php
include 'db_connect.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if user or email already exists
$check = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
$check->bind_param("ss", $username, $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("Username or Email already exists.");
}

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Signup successful. <a href='login.html'>Login here</a>";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
