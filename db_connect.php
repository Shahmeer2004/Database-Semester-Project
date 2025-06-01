<?php
$servername = "localhost";
$username = "root"; // Use your DB username
$password = "";     // Use your DB password
$dbname = "frelance"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
