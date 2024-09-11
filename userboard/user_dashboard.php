<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: https://localhost/obva%20system/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
                body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

header {
    background-color: #4070f4;
    color: #fff;
    padding: 10px 0;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: space-around;
}

nav ul li {
    display: inline;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
}

nav ul li a:hover {
    background-color: #575757;
    border-radius: 5px;
}

main {
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table, th, td {
    border: 1px solid #4070f4;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #4070f4;
}

td a {
    margin-right: 10px;
    text-decoration: none;
    color: #007bff;
}

td a:hover {
    text-decoration: underline;
}

.form-container {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    max-width: 600px;
    margin: 50px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
textarea,
select {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

textarea {
    height: 100px;
}

input[type="checkbox"] {
    margin: 0 10px 0 0;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}
    </style>
</head>
<body>

<h1>Your Service Requests</h1>
<table border="1">
    <tr>
        <th>Service Name</th>
        <th>Description</th>
        <th>Request Date</th>
        <th>Mechanic's Response</th>
    </tr>
    <?php

    include 'db_connection.php';
    $service_requests_query = "SELECT sr.request_id, sr.ID, sr.service_id, sr.custom_problem, sr.request_date, s.service_name
FROM service_requests sr
JOIN services_table s ON sr.service_id = s.service_id";
$result = $conn->query($service_requests_query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['service_name'] . "</td>";
            echo "<td>" . $row['custom_problem'] . "</td>";
            echo "<td>" . $row['request_date'] . "</td>";
            echo "<td>" . (empty($row['response']) ? 'No response yet' : $row['response']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No service requests found</td></tr>";
    }
    $conn->close();
    ?>
</table>


<script>
function checkForNewResponses() {
    $.ajax({
        url: 'check_responses.php',
        method: 'GET',
        success: function(data) {
            if (data.new_responses) {
                alert('You have new responses from mechanics!');
                location.reload();
            }
        }
    });
}

setInterval(checkForNewResponses, 30000); // Check every 30 seconds
</script>

</body>
</html>
