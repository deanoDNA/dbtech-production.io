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
    $service_id = $_POST['service_id'];
    $ID = 1; 

    $stmt = $conn->prepare("INSERT INTO service_requests (ID, service_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $ID, $service_id);

    if ($stmt->execute()) {
        echo "Service request sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
