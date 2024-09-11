<!DOCTYPE html>
<html>
<head>
    <title>Logout Example</title>
</head>
<body>
    <!-- Logout link -->
    <a href="logout.php">Logout</a>

<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: \\obva system\login.html");
exit();
?>


</body>
</html>
