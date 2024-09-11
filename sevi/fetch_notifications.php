<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT sr.id, u.username, s.service_name, s.description 
        FROM service_requests sr 
        JOIN users_table u ON sr.ID = u.ID 
        JOIN services_table s ON sr.service_id = s.service_id 
        WHERE sr.custom_problem = 0";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='list-group-item'>
                <h5>Request from {$row['username']}</h5>
                <p>Service: {$row['service_name']}</p>
                <p>Description: {$row['description']}</p>
                <button class='btn btn-success' onclick='respondRequest({$row['id']})'>Respond</button>
              </div>";
        $updateSql = "UPDATE service_requests SET custom_problem = 1 WHERE id = {$row['id']}";
        if ($conn->query($updateSql) !== TRUE) {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "<div class='list-group-item'>No new service requests.</div>";
}

$conn->close();
?>
