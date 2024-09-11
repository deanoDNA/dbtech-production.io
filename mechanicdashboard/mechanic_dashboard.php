<?php
session_start();
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: http:localhost://obva%20system/mechanic.html");
    exit;
}
require_once 'db_connection.php'; // include your database connection file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="navbar">
        <h1>Mechanic Dashboard</h1>
        <div class="logout">
            <a href="http://localhost/obva%20system/mechanic.html">Logout</a>
        </div>
    </div>
    <div class="sidebar">
        <a href="mechanic_dashboard.php">Dashboard</a>
        <a href="manage_services.php">Manage Services</a>
        <a href="list_service_requests.php">Service Requests</a>
        <a href="mechanic_profile.php">View Profile</a>
    </div>
    <div class="content">
        <h2 align="center">Welcome Here to Manage your services and view service requests here</h2>
        
    </div>
</body>
</html>
