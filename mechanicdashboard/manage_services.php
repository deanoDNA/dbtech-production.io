<?php
session_start();
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: http://localhost/obva%20system/mechanic.html");
    exit;
}
require_once 'db_connection.php'; // include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO services_table (service_name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $service_name, $description, $price);
    
    if ($stmt->execute()) {
        echo "Service added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Services</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <h1>Manage Services</h1>
        <div class="logout">
            <a href="mechanic_logout.php">Logout</a>
        </div>
    </div>
    <div class="sidebar">
        <a href="mechanic_dashboard.php">Dashboard</a>
        <a href="manage_services.php">Manage Services</a>
        <a href="list_service_requests.php">Service Requests</a>
    </div>
    <div class="content">
        <h2>Manage Services</h2>
        <form action="manage_services.php" method="post">
            <label for="service_name">Service Name:</label>
            <input type="text" id="service_name" name="service_name" required>
            
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
            
            <input type="submit" value="Add Service">
        </form>
    </div>
</body>
</html>
