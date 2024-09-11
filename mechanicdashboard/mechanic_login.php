<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db_connection.php'; // include your database connection file

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM mechanics_table WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password1'])) {
            $_SESSION['mechanic_loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: mechanic_dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="mechanic_login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <input type="submit" value="Login">
        
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </form>
</body>
</html>
