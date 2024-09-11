<?php
session_start();
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: http://localhost/obva%20system/mechanic.html");
    exit;
}
require_once 'db_connection.php'; // Include your database connection file


if (isset($_GET['request_id'])) {
    $request_id = $_GET['request_id'];

    // Delete the service request
    $delete_query = "DELETE FROM service_requests WHERE request_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $request_id);
    if ($stmt->execute()) {
        header("location: list_service_requests.php");
    } else {
        echo "Error deleting service request.";
    }
    $stmt->close();
}

$conn->close();
?>
