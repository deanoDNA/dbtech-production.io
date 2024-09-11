<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

// Check if the mechanic is logged in
if (!isset($_SESSION['mechanic_loggedin']) || $_SESSION['mechanic_loggedin'] !== true) {
    header("Location: http://localhost/obva%20system/mechanic.html");
    exit;
}

$mechanic_username = $_SESSION['username'];


// Fetch mechanic's current data
$query = "SELECT * FROM mechanics_table WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $mechanic_username);
$stmt->execute();
$result = $stmt->get_result();
$mechanic = $result->fetch_assoc();

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];
    $expertise = $_POST['expertise'];
    $location = $_POST['location'];

    // Prepare update query
    $update_query = "UPDATE mechanics_table SET first_name = ?, last_name = ?, username = ?, phone_number = ?, expertise = ?, location = ? WHERE username = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssssss", $first_name, $last_name, $username, $phone_number, $expertise, $location, $mechanic_username);

    // Execute update
    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully!";
        // Refresh the mechanic's data
        $stmt->execute();
        $result = $stmt->get_result();
        $mechanic = $result->fetch_assoc();
    } else {
        $error_message = "Failed to update profile.";
    }
    $update_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Profile</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #4070f4;
    color: #fff;
    padding: 10px 0;
    position: relative;
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
    display: inline-block;
}

nav ul li a:hover {
    background-color: #575757;
    border-radius: 5px;
}

header .logout {
    position: absolute;
    top: 10px;
    right: 20px;
    background-color: #ff4d4d;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

header .logout:hover {
    background-color: #ff1a1a;
}

main {
    padding: 20px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

button {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
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

.form-container {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="text"],
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

button[type="submit"] {
    display: block;
    width: 19%;
    padding: 10px;
    background-color: #4070f4;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #218838;
}

.success {
    color: #28a745;
    text-align: center;
    margin-bottom: 20px;
}

.error {
    color: #dc3545;
    text-align: center;
    margin-bottom: 20px;
}

    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="mechanic_dashboard.php">Dashboard</a></li>
                <li><a href="list_service_requests.php">Service Requests</a></li>
                <li><a href="#" id="profileBtn">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Mechanic Dashboard</h1>
        
        <!-- Modal Trigger -->
        <button id="profileBtn">View Profile</button>

        <!-- The Modal -->
        <div id="profileModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Mechanic Profile</h2>
                <?php if (isset($success_message)): ?>
                    <p class="success"><?php echo htmlspecialchars($success_message); ?></p>
                <?php elseif (isset($error_message)): ?>
                    <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
                <?php endif; ?>
                <form action="mechanic_profile.php" method="post" class="form-container">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($mechanic['first_name']); ?>" required>

                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($mechanic['last_name']); ?>" required>

                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($mechanic['username']); ?>" required>

                    <label for="phone_number">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($mechanic['phone_number']); ?>" required>

                    <label for="expertise">Expertise:</label>
                    <input type="text" id="expertise" name="expertise" value="<?php echo htmlspecialchars($mechanic['expertise']); ?>" required>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($mechanic['location']); ?>" required>

                    <button type="submit">Update Profile</button>
                </form>
            </div>
        </div>
    </main>
    <script>
        // Get the modal
        var modal = document.getElementById("profileModal");

        // Get the button that opens the modal
        var btn = document.getElementById("profileBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>



