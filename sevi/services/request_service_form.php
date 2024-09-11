<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user information from session or database
$username = $_SESSION['username']; // Assume username is stored in session upon login
$user_info_query = "SELECT ID, first_name, last_name, phone_number FROM users_table WHERE username = ?";
$stmt = $conn->prepare($user_info_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$user_info = $stmt->get_result()->fetch_assoc();
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Services Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
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
    <div class="form-container">
        <h2>Request Services Form</h2>
        <form id="serviceRequestForm" action="submit_request.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_info['ID']; ?>">
            <input type="hidden" name="last_name" value="<?php echo $user_info['last_name']; ?>">
            <input type="hidden" name="phone_number" value="<?php echo $user_info['phone_number']; ?>">

            <label for="service_id">Choose a Service:</label>
            <select name="service_id" id="service_id" required>
                <?php
                $services_query = "SELECT service_id, service_name FROM services_table";
                $services_result = $conn->query($services_query);

                while ($row = $services_result->fetch_assoc()) {
                    echo "<option value='" . $row['service_id'] . "'>" . $row['service_name'] . "</option>";
                }
                ?>
            </select>

            <label for="description">Short Description about the Breakdown</label>
            <textarea name="description" id="description" required></textarea>

            <input type="checkbox" name="terms" id="terms" required>
            <label for="terms">Accept our terms and conditions.</label>

            <button type="submit">Submit Request</button>
        </form>
    </div>
</body>
</html>
