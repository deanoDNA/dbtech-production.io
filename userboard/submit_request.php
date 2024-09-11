<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    // $last_name = $_POST['last_name'];
    // $phone_number = $_POST['phone_number'];
    $custom_problem = $_POST['custom_problem'];
    $terms = isset($_POST['terms']) ? 1 : 0;

    if ($terms) {
        // Verify the user ID, last name, and phone number match in the users_table
        $sql = "SELECT ID FROM users_table WHERE ID = ?";
        
        $stmt = $conn -> prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Insert the service request into the service_requests table
            $insert_sql = "INSERT INTO service_requests (ID, service_id, custom_problem, request_date) VALUES (?, ?, ?, NOW())";
            $insert_stmt = $conn->prepare($insert_sql);
            $insert_stmt->bind_param("iis", $user_id, $service_id, $description);

            if ($insert_stmt->execute()) {
                echo "Service request submitted successfully.";
            } else {
                echo "Error: " . $insert_stmt->error;
            }

            $insert_stmt->close();
        } else {
            echo "Error: User information does not match.";
        }

        $stmt->close();
    } else {
        echo "You must accept the terms and conditions.";
    }

    $conn->close();
}
?>
