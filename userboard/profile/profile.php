<?php
session_start();
// include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: https://localhost/obva%20system/index.php');
    exit;
}

$user_id = $_SESSION['user_id'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch user information from the database
$query = "SELECT * FROM users_table WHERE ID = ?";
$stmt = $conn-> prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="stailii.css">
</head>
<body>
<nav class="navbar">
        <a href="https://localhost/obva%20system/userboard/userboard.php"><<< Back Home</a>
        <a href="https://localhost/OBVA%20system/index.html">Logout</a>
    </nav>
    <div class="profile-container">
        <h2>User Profile</h2>
        <img src="../carimage/profile icon.png" alt="Profile Picture" class="profile-picture">
        <p><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></p>
        <p><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <button onclick="window.location.href='edit_profile.php'">Edit Profile</button>
    </div>
</body>
</html>

