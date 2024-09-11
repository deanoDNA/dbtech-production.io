<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM services_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='col-md-4 mb-4'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['service_name']}</h5>
                        <p class='card-text'>{$row['description']}</p>
                        <button class='btn btn-primary' onclick='requestService({$row['service_id']})'>Request Service</button>
                    </div>
                </div>
              </div>";
    }
} else {
    echo "<div class='col-12'><p>No services available.</p></div>";
}

$conn->close();
?>
