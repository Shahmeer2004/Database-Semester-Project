<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "frelance");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $budget = $_POST['budget'];
    $deadline = $_POST['deadline'];

    $sql = "INSERT INTO projects (title, description, category, budget, deadline) 
            VALUES ('$title', '$description', '$category', '$budget', '$deadline')";

    if ($conn->query($sql)) {
        echo "Project added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    $conn->close();
}
?>
<style>
    /* ===== RESET & GLOBAL ===== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #fff;
  color: #333;
  line-height: 1.6;
}

img {
  max-width: 100%;
  display: block;
}

a {
  text-decoration: none;
  color: inherit;
}

/* ===== HEADER ===== */
.header {
  background-color: #477166;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 30px;
}

.logo {
  font-size: 28px;
  font-weight: bold;
}

.logo .highlight {
  color: #2ecc71;
}

.navbar {
  display: flex;
  list-style: none;
  gap: 20px;
}

.navbar a {
  font-size: 18px;
  padding: 8px;
  transition: color 0.3s;
}

.navbar a:hover {
  color: #0bdaae;
}
    form {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    button[type="submit"] {
        background-color: #2ecc71;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #27ae60;
    }
</style>
 <header class="header">
    <a href="/" class="logo">Work<span class="highlight">Hive</span></a>
    <nav class="navigation">
      <ul class="navbar">
        <li><a href="index.html">Home</a></li>
        <li><a href="project.php">Projects</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="addproject.php">Add Project</a></li>
        <li><a href="login.html">Login</a></li>
      </ul>
    </nav>
  </header>

<form method="post">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="text" name="category" placeholder="Category" required><br>
    <input type="number" step="0.01" name="budget" placeholder="Budget" required><br>
    <input type="date" name="deadline" required><br>
    <button type="submit">Add Project</button>
</form>
