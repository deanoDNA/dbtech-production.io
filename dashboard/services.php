<?php
include 'config.php';
include 'header.php';

$query = "SELECT * FROM services_table";
$result = mysqli_query($conn, $query);

echo '<h2>Services</h2>';
echo '<table>';
echo '<tr><th>Service Name</th><th>Description</th><th>Price</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['service_name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['description']) . '</td>';
    echo '<td>' . htmlspecialchars($row['price']) . ' TZS</td>';
    echo '</tr>';
}
echo '</table>';

include 'footer.php';
?>
