<?php
include 'config.php';

if (isset($_POST['username']) && isset($_POST['security_answer'])) {
    $username = $_POST['username'];
    $security_answer = $_POST['security_answer'];

    // Check if the user exists and the security answer is correct
    $query = "SELECT * FROM mechanics_table WHERE username='$username' AND security_answer='$security_answer'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        // Redirect to reset password page with the registration number
        header("Location: reset_password_mechanics.php?username=$username");
        exit();
    } else {
        echo "Invalid registration number or security answer.";
    }
}
?>
