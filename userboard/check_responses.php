<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: https://localhost/obva%20system/login.html");
    exit();
}

include 'db_connection.php';

$sql = "SELECT COUNT(*) AS new_responses FROM service_requests WHERE request_id='$request_id' AND response IS NOT NULL AND response_seen=0";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$new_responses = $row['new_responses'] > 0;

if ($new_responses) {
    $update_sql = "UPDATE service_requests SET response_seen=1 WHERE request_id='$request_id_id' AND response IS NOT NULL";
    $conn->query($update_sql);
}

echo json_encode(['new_responses' => $new_responses]);

$conn->close();
?>
