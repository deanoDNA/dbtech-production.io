<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requestId = $_POST['requestId'];

    $stmt = $conn->prepare("UPDATE service_requests SET mechanicNotified = 1 WHERE id = ?");
    $stmt->bind_param("i", $requestId);

    if ($stmt->execute()) {
        echo "Service request responded successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
