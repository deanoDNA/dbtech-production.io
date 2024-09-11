<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$query = "SELECT * FROM users_table WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Update user information
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];

    $update_query = "UPDATE users_table SET first_name = ?, last_name = ?, username = ?, phone_number = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssi", $first_name, $last_name, $username, $phone_number, $user_id);

    if ($update_stmt->execute()) {
        header('Location: profile.php');
        exit;
    } else {
        $error_message = "Failed to update profile. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="stailii.css">
</head>
<body>
    <nav class="navbar">
        <a href="https://localhost/OBVA%20system/userboard/userboard.php">Dashboard</a>
        <a href="profile.php">Back to Profile</a>
        
    </nav>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>
        <form action="" method="POST">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            <label for="name">Last Name:</label>
            <input type="text" id="name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            
            <label for="Username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
