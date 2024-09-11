<?php
include 'config.php';
include 'functions.php'; // Include this if you have any common functions

if (isset($_POST['reg_number'])) {
    $reg_number = $_POST['reg_number'];

    // Check if the user exists
    $query = "SELECT * FROM users_table WHERE reg_number='$reg_number'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $email = $user['email']; // Assuming you have an email field

        // Generate a unique token
        $token = bin2hex(random_bytes(50));

        // Store the token in the database
        $query = "UPDATE users_table SET reset_token='$token' WHERE reg_number='$reg_number'";
        mysqli_query($conn, $query);

        // Send the reset link via email
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $reset_link";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Reset link has been sent to your email.";
        } else {
            echo "Failed to send reset link.";
        }
    } else {
        echo "No account found with that registration number.";
    }
}
?>
