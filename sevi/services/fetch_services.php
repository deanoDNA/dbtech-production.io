<?php
require_once 'db_connection.php'; // Include your database connection file

function fetch_services() {
    global $conn;
    $sql = "SELECT service_id, service_name, description, price FROM services_table";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <div class='service-card' data-service-id='{$row['service_id']}' data-service-name='{$row['service_name']}'>
                <h3>{$row['service_name']}</h3>
                <p>{$row['description']}</p>
                <p>Price: {$row['price']}</p>
                <button class='request-service-btn'>Request Service</button>
            </div>";
        }
    } else {
        echo "<p>No services available</p>";
    }
}
?>
