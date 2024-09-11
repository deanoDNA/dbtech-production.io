<?php
include 'config.php';
include 'header.php';

if (isset($_GET['mechanic_id'])) {
    $mechanic_id = $_GET['mechanic_id'];
    $user_id = $_SESSION['user_id'];
    
    // Logic to start service
    // This can include inserting a record into a service request table

    echo '<div class="alert">';
    echo 'Service started with mechanic ID: ' . htmlspecialchars($mechanic_id);
    echo '<span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>';
    echo '</div>';
}

echo '<a href="user_dashboard.php" class="back-button">Back to Dashboard</a>';

include 'footer.php';
?>
