<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: https://localhost/obva%20system/admin.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="navbar">
        <h1>Admin Dashboard</h1>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="sidebar">
        <a href="index.php">Dashboard</a>
        <a href="manage_mechanics.php">Manage Mechanics</a>
        <a href="list_mechanics.php">List Mechanics</a>
        <a href="list_users.php">List Users</a>
    </div>
    <div class="content">
