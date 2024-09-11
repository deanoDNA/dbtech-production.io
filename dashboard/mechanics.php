<?php
include 'config.php';
include 'header.php';

$query = "SELECT * FROM mechanics_table";
$result = mysqli_query($conn, $query);

echo '<h2>Mechanics</h2>';
echo '<table>';
echo '<tr><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Expertise</th><th>Location</th><th>Action</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['first_name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['last_name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['phone_number']) . '</td>';
    echo '<td>' . htmlspecialchars($row['expertise']) . '</td>';
    echo '<td>' . htmlspecialchars($row['location']) . '</td>';
    echo '<td><a href="start_service.php?mechanic_id=' . $row['mechanic_id'] . '">Select Mechanic</a></td>';
    echo '</tr>';
}
echo '</table>';

include 'footer.php';
?>
