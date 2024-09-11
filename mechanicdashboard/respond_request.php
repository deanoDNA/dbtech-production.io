<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

// Check if the mechanic is logged in
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: http://localhost/obva%20system/mechanic.html");
    exit;
}

if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Update the service request status or send a notification
    // Example: Change the status to "In Progress"
    $update_query = "UPDATE service_requests SET status = 'In Progress' WHERE request_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("i", $request_id);
    if ($stmt->execute()) {
        echo "Service request status updated to 'In Progress'.";
    } else {
        echo "Error updating service request status.";
    }
    $stmt->close();
}

$conn->close();
?>
