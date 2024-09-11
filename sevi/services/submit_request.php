<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $description = $_POST['description'];

    // Verify the user ID, last_name, and phone_number match in the users_table
    $sql = "SELECT ID FROM users_table WHERE ID = ? AND last_name = ? AND phone_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $last_name, $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Insert the service request into the service_requests table
        $insert_sql = "INSERT INTO service_requests (ID, service_id, custom_problem, request_date) VALUES (?, ?, ?, NOW())";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iis", $user_id, $service_id, $description);

        if ($insert_stmt->execute()) {
            header("location: thank_you.html");
    
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    } else {
        header('Location: https://localhost/OBVA%20system/index.html');
    }

    $stmt->close();
    $conn->close();
}
?>
