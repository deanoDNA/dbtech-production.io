<?php include 'includes/header.php'; ?>

<h2 align="center">Add Mechanic Here</h2>

<!-- Form to add a new mechanic -->
<form method="POST">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="phone_number" placeholder="Phone Number" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password1" placeholder="Password" required>
    <input type="password" name="password2" placeholder="Confirm Password" required>
    <input type="text" name="security_answer" placeholder="Security Answer" required>
    <input type="text" name="expertise" placeholder="Expertise" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit" name="add_mechanic">Add Mechanic</button>
</form>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "obva_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new mechanic
if (isset($_POST['add_mechanic'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password1 = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $password2 = password_hash($_POST['password2'], PASSWORD_DEFAULT);
    $security_answer = $_POST['security_answer'];
    $expertise = $_POST['expertise'];
    $location = $_POST['location'];

    $sql = "INSERT INTO mechanics_table (first_name, last_name, phone_number, username, password1, password2, security_answer, expertise, location)
            VALUES ('$first_name', '$last_name', '$phone_number', '$username', '$password1', '$password2', '$security_answer', '$expertise', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "New mechanic added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<?php include 'includes/footer.php'; ?>
