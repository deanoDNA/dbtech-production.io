<?php 
session_start();
require_once 'db_connection.php'; 

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user information from session or database
$username = $_SESSION['username']; 
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
    <title>Available Services</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div class="services-container">
        <?php include 'fetch_services.php'; fetch_services(); ?>
    </div>

    <!-- Modal Form -->
    <div id="service-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2 id="modal-service-name">Request Service</h2>
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
    </div>

    <script src="script.js"></script>
</body>
</html>
