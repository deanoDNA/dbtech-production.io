<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "obva_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['id'];
$sql = "SELECT * FROM users_table WHERE ID = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>First Name: {$row['first_name']}</p>";
    echo "<p>Last Name: {$row['last_name']}</p>";
    echo "<p>Phone Number: {$row['phone_number']}</p>";
    echo "<p>Username: {$row['username']}</p>";
} else {
    echo "No user found.";
}

$conn->close();
?>
