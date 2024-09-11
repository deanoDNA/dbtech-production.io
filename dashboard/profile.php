<?php
include 'config.php';
include 'header.php';

session_start();
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $query = "UPDATE users_table SET first_name='$first_name', last_name='$last_name', phone_number='$phone_number' WHERE ID='$user_id'";
    mysqli_query($conn, $query);
    echo '<div class="alert">';
    echo 'Profile updated successfully.';
    echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
    echo '</div>';
}

$query = "SELECT * FROM users_table WHERE ID='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<h2>User Profile</h2>
<form action="profile.php" method="post">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
    
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
    
    <label for="phone_number">Phone Number:</label>
    <input type="text" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
    
    <button type="submit">Update Profile</button>
</form>

<a href="user_dashboard.php" class="back-button">Back to Dashboard</a>

<?php include 'footer.php'; ?>
