<?php
include 'config.php';

if (isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ($password1 === $password2) {
        // Hash the new password
        $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $query = "UPDATE admin_table SET password1='$hashed_password', password2='$hashed_password' WHERE username='$username'";
        if (mysqli_query($conn, $query)) {
            echo '<script>
                alert("Password has been reset successfully.");
                // header("Location: \OBVA system\admin\user list.php");
                //window.location.href = "\\obva system/index.html";
                window.location.href = "http://localhost/obva%20system/admin.html";
                </script>';
        } else {
            echo "Failed to reset password.";
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>
