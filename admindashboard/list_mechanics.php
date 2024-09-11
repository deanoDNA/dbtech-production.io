<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mechanics</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>
        <h2 align="center">Here is the Number of registered Mechanic List</h2>
        
        <table id="mechanicsTable">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Username</th>
                <th>Expertise</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "obva_system");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Delete mechanic
            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $sql = "DELETE FROM mechanics_table WHERE mechanic_id = $delete_id";
                if ($conn->query($sql) === TRUE) {
                    echo "Mechanic deleted successfully";
                } else {
                    echo "Error deleting mechanic: " . $conn->error;
                }
            }
            // Fetch mechanics
            $sql = "SELECT * FROM mechanics_table";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['expertise']}</td>
                            <td>{$row['location']}</td>
                            <td class='action-buttons'>
                                <a href='edit_mechanic.php?id={$row['mechanic_id']}'><button class='edit'>Edit</button></a>
                                <a href='list_mechanics.php?delete_id={$row['mechanic_id']}'><button class='delete'>Delete</button></a>
                                <button class='print' onclick='printMechanic({$row['mechanic_id']})'>Print</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No mechanics found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <script>
        function printMechanic(mechanic_id) {
            // Open a new window with the mechanic information and trigger print
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print Mechanic</title></head><body>');
            printWindow.document.write('<h1>Mechanic Information</h1>');
            printWindow.document.write('<p>Fetching mechanic information...</p>');
            fetch('get_mechanic.php?id=' + mechanic_id)
                .then(response => response.text())
                .then(data => {
                    printWindow.document.write(data);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                });
        }

        function printAllMechanics() {
            // Open a new window with the whole mechanics list and trigger print
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print All Mechanics</title></head><body>');
            printWindow.document.write('<h1>All Mechanics</h1>');
            printWindow.document.write(document.getElementById('mechanicsTable').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
        </script>
</body>
</html>
