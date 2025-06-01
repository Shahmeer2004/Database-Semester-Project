<?php
$conn = new mysqli("localhost", "root", "", "frelance");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM projects ORDER BY posted_on DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dashboard – WorkHive</title>
  <link rel="stylesheet" href="dashboard.css">
  <style>
:root {
  --primary-color: #477166;
  --secondary-color: #2ecc71;
  --accent-color: #0bdaae;
  --text-color: #333;
  --light-bg: #f8f9fa;
  --card-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  --hover-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  --transition: all 0.2s ease;
}
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  background-color: var(--light-bg);
  color: var(--text-color);
  margin: 0;
  padding: 0;
  line-height: 1.5;
}
main {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Header Styles */
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
  text-decoration: none;
  color: white;
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
  text-decoration: none;
  color: white;
}

.navbar a:hover {
  color: #0bdaae;
}
 h1 {
      font-size: 2.8rem;
      font-weight: 700;
      color: #477166;
      margin-bottom: 0.5rem;
      text-align: center;
    }

    p {
      font-size: 1.2rem;
      color: #4B5563;
      margin-bottom: 2rem;
      text-align: center;
    }

.project-container {
  display: flex;
  flex-wrap: wrap;
  gap: 30px; /* increased from 20px to 30px */
  justify-content: flex-start;
  padding: 20px 20px;
}

.project-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  width: calc(25% - 30px); /* 4 cards per row with spacing */
  box-sizing: border-box;
  transition: transform 0.2s ease;
  margin-bottom: 30px;
}
.project-card:hover {
  transform: translateY(-5px);
  
}

.project-card h3 {
  font-size: 20px;
  margin-top: 0;
  margin-bottom: 10px;
}

.project-card p {
  margin: 5px 0;
  color: #333;
}

.project-card strong {
  color: #000;
}

.add-btn {
  background-color: #007bff;
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 8px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight: bold;
  margin-top: 15px;
  cursor: pointer;
  transition: background 0.3s;
}

.add-btn:hover {
  background-color: #0056b3;
}
@media (max-width: 1200px) {
  .project-card {
    width: calc(33.33% - 30px); /* 3 per row on medium screens */
  }
}

@media (max-width: 768px) {
  .project-card {
    width: calc(50% - 30px); /* 2 per row on small screens */
  }
}

@media (max-width: 480px) {
  .project-card {
    width: 100%; /* 1 per row on mobile */
  }
}
</style>
</head>
<body>
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
  <h1>Dashboard</h1>
  <p>Welcome to your dashboard! Here are the latest projects:</p>
<div class="project-container">
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="project-card">
      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
      <p><strong>Deadline:</strong> <?= htmlspecialchars($row['deadline']) ?> days</p>
      <p><strong>Profit:</strong> ₹<?= number_format($row['budget']) ?></p>
     
    </div>
  <?php endwhile; ?>
</div>
</html>
