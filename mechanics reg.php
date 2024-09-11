<?php

session_start();

// Check if the user is logged in
// if (!isset($_SESSION['loggedin'])) {
//     header("Location: login.php");
//     exit();
// }

// Disable caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.


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
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $security_answer = $_POST['security_answer'];
    $expertise = $_POST['expertise'];
    
    $available = $_POST['available'];


    if ($password1 !== $password2) {
        echo "Passwords do not match.";
        exit();
    }

    $hashed_password1 = password_hash($password1, PASSWORD_BCRYPT);
    $hashed_password2 = password_hash($password2, PASSWORD_BCRYPT);

    $sql = "INSERT INTO mechanics_table (first_name, last_name, phone_number, username, password1, password2, security_answer, expertise, available) VALUES ( ?, ?, ?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssssss", $first_name, $last_name, $phone_number, $username, $hashed_password1, $hashed_password2, $security_answer, $expertise,  $available);

        if ($stmt->execute()) {
            // echo "New user registered successfully.";
            header("Location: \OBVA system\mechanic.html");
            exit();
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
