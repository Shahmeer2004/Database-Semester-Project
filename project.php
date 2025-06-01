<?php
$conn = new mysqli("localhost", "root", "", "frelance");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Basic filtering and sorting
$categoryFilter = $_GET['category'] ?? '';
$sort = $_GET['sort'] ?? '';

$sql = "SELECT * FROM projects";
$conditions = [];

if ($categoryFilter) {
    $conditions[] = "category = '" . $conn->real_escape_string($categoryFilter) . "'";
}

if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

if ($sort === 'profit') {
    $sql .= " ORDER BY budget DESC";
} elseif ($sort === 'deadline') {
    $sql .= " ORDER BY deadline ASC";
} else {
    $sql .= " ORDER BY posted_on DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Projects – WorkHive</title>
  <link rel="stylesheet" href="project.css" />
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

  <!-- Categories -->
  <div class="category-container" style="margin: 20px 20px; padding: 20px 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: var(--card-shadow);">
    <strong style="padding: 20px ">Categories:</strong>
    <div class="category-buttons" style="display: flex; flex-wrap: wrap; gap: 10px; padding: 10px;">
      <?php
      $categories = [
          "All" => "",
          "Web Development" => "Web Development",
          "Video and Animation" => "Video and Animation",
          "Audio and Music" => "Audio and Music",
          "Business" => "Business",
          "Graphic Designing" => "Graphic Designing",
          "AI/ML and Data Science" => "AI/ML and Data Science",
          "Engineering" => "Engineering",
          "Robotics" => "Robotics"
      ];
      foreach ($categories as $label => $value):
        $url = "project.php" . ($value ? "?category=" . urlencode($value) : "");
      ?>
        <button onclick="window.location.href='<?= $url ?>'"><?= $label ?></button>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Filters -->
  <div class="filter-container" style="margin: 20px 20px; padding: 20px 20px; background-color: #f8f9fa; border-radius: 10px; box-shadow: var(--card-shadow);">
    <strong style="padding: 20px ">Filters:</strong>
    <div class="filter-buttons" style="display: flex; flex-wrap: wrap; gap: 10px; padding: 10px;">
      <button onclick="window.location.href='project.php<?= $categoryFilter ? '?category=' . urlencode($categoryFilter) . '&' : '?' ?>sort=profit'">Sort by Profits</button>
      <button onclick="window.location.href='project.php<?= $categoryFilter ? '?category=' . urlencode($categoryFilter) . '&' : '?' ?>sort=deadline'">Sort by Deadlines</button>
    </div>
  </div>

  <!-- Project Cards -->
<div class="project-container">
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="project-card">
      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>
      <p><strong>Deadline:</strong> <?= htmlspecialchars($row['deadline']) ?> days</p>
      <p><strong>Profit:</strong> ₹<?= number_format($row['budget']) ?></p>
      <button class="add-btn">Add to Dashboard</button>
    </div>
  <?php endwhile; ?>
</div>
</body>
</html>
