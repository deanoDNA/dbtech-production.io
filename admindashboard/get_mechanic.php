<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "obva_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mechanic_id = $_GET['id'];
$sql = "SELECT * FROM mechanics_table WHERE mechanic_id = $mechanic_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<p>First Name: {$row['first_name']}</p>";
    echo "<p>Last Name: {$row['last_name']}</p>";
    echo "<p>Phone Number: {$row['phone_number']}</p>";
    echo "<p>Username: {$row['username']}</p>";
    echo "<p>Expertise: {$row['expertise']}</p>";
    echo "<p>Location: {$row['location']}</p>";
} else {
    echo "No mechanic found.";
}

$conn->close();
?>
