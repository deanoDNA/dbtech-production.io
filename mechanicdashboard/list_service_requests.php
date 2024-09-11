<?php
require_once 'db_connection.php'; // Include your database connection file

// Check if the mechanic is logged in
session_start();
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: https://localhost/obva%20system/mechanicdashboard.html");
    exit;
}

// Fetch service requests
$service_requests_query = "SELECT sr.request_id, sr.ID, sr.service_id, sr.custom_problem, sr.request_date, s.service_name
                           FROM service_requests sr
                           JOIN services_table s ON sr.service_id = s.service_id";
$service_requests_result = $conn->query($service_requests_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    <link rel="stylesheet" href="styles.css">
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
    <header>
        <nav>
            <ul>
                <li><a href="mechanic_dashboard.php">Dashboard</a></li>
                <li><a href="list_service_requests.php">Service Requests</a></li>
                <li><a href="mechanic_profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests</title>
    <link rel="stylesheet" href="path/to/your/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Service Requests</h1>
<table border="1">
    <tr>
        <th>Service Name</th>
        <th>Description</th>
        <th>Request Date</th>
        <th>Actions</th>
    </tr>
    <?php
    // Fetch service requests from the database
    include 'db_connection.php';

    // Fetch service requests
$service_requests_query = "SELECT sr.request_id, sr.ID, sr.service_id, sr.custom_problem, sr.request_date, s.service_name
FROM service_requests sr
JOIN services_table s ON sr.service_id = s.service_id";
$service_requests_result = $conn->query($service_requests_query);

    $result = $conn->query($service_requests_query);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['service_name'] . "</td>";
            echo "<td>" . $row['custom_problem'] . "</td>";
            echo "<td>" . $row['request_date'] . "</td>";
            echo "<td><a href='#' class='respond-btn' data-id='" . $row['request_id'] . "'>Respond</a> | <a href='delete_request.php?request_id=" . $row['request_id'] . "'>Delete</a></td>";
            
            echo "</tr>";

           
            
        }
    } else {
        echo "<tr><td colspan='4'>No service requests found</td></tr>";
    }
    $conn->close();
    ?>
</table>

<div id="responseModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="responseForm" action="submit_response.php" method="post">
            <input type="hidden" name="request_id" id="request_id">
            <label for="response_message">Response:</label><br>
            <textarea name="response_message" id="response_message" required></textarea><br><br>
            <button type="submit">Submit Response</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        var modal = document.getElementById("responseModal");
        var span = document.getElementsByClassName("close")[0];

        $(".respond-btn").click(function(){
            var requestId = $(this).data('id');
            $("#request_id").val(requestId);
            modal.style.display = "block";
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>

</body>
</html>
