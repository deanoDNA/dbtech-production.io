<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $security_answer = $_POST['security_answer'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    

    if ($password1 !== $password2) {
        echo "Passwords do not match.";
        exit();
    }

    $hashed_password1 = password_hash($password1, PASSWORD_BCRYPT);
    $hashed_password2 = password_hash($password2, PASSWORD_BCRYPT);

    $sql = "INSERT INTO admin_table (first_name, last_name, password1, password2, security_answer, username, email) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssss", $first_name, $last_name, $hashed_password1, $hashed_password2, $security_answer, $username, $email);

        if ($stmt->execute()) {
            // echo "New user registered successfully.";
            header("Location: \OBVA system\admin.html");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
