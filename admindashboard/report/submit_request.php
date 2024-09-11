<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : null;
    $custom_problem = isset($_POST['custom_problem']) ? $_POST['custom_problem'] : null;
    $user_id = 1; // Replace this with the actual user ID from your session or authentication system

    // Insert request into the database
    $stmt = $conn->prepare("INSERT INTO requests_table (service_id, user_id, custom_problem, status) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("iis", $service_id, $user_id, $custom_problem);

    if ($stmt->execute()) {
        echo "Request submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
