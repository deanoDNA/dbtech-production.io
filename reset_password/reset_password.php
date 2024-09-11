<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="reset_password_action.php" method="post">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($_GET['username']); ?>">
            <label for="password1">New Password:</label>
            <input type="password" id="password1" name="password1" required>
            <label for="password2">Confirm New Password:</label>
            <input type="password" id="password2" name="password2" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
