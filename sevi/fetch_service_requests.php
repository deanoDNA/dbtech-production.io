<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT FROM requests .id, u.name, s.name, s.created_at ;
        JOIN users_table u ON sr.ID = u.ID 
        IN services_request s ON sr.service_id = s.service_id";

$result = $conn->query($sql);


$query = "SELECT * FROM users_table WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statusClass = $row['mechanicNotified'] ? 'completed' : 'pending';
        echo "<div class='list-group-item $statusClass'>
                <h5>Request from {$row['username']}</h5>
                <p>Service: {$row['service_name']}</p>
                <p>Description: {$row['description']}</p>
                <button class='btn btn-success' onclick='respondRequest({$row['id']})'>Respond</button>
              </div>";
    }
} else {
    echo "<div class='list-group-item'>No service requests.</div>";
}

$conn->close();
?>
