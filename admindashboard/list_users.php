<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/header.php'; ?>
   
        <h2 align="center">Here is the number of Users</h2>
        
        <!-- Print All Button -->
        <button class="print" onclick="printAllUsers()">Print All Users</button>
        
        <!-- Display the list of users -->
        <table id="usersTable">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
            // Database connection
            $conn = new mysqli("localhost", "root", "", "obva_system");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Delete user
            if (isset($_GET['delete_id'])) {
                $delete_id = $_GET['delete_id'];
                $sql = "DELETE FROM users_table WHERE ID = $delete_id";
                if ($conn->query($sql) === TRUE) {
                    echo "User deleted successfully";
                } else {
                    echo "Error deleting user: " . $conn->error;
                }
            }
            // Fetch users
            $sql = "SELECT * FROM users_table";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['phone_number']}</td>
                            <td>{$row['username']}</td>
                            <td class='action-buttons'>
                                <a href='edit_user.php?id={$row['ID']}'><button class='edit'>Edit</button></a>
                                <a href='list_users.php?delete_id={$row['ID']}'><button class='delete'>Delete</button></a>
                                <button class='print' onclick='printUser({$row['ID']})'>Print</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <script>
        function printUser(user_id) {
            // Open a new window with the user information and trigger print
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print User</title></head><body>');
            printWindow.document.write('<h1>User Information</h1>');
            printWindow.document.write('<p>Fetching user information...</p>');
            fetch('get_user.php?id=' + user_id)
                .then(response => response.text())
                .then(data => {
                    printWindow.document.write(data);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.print();
                });
        }

        function printAllUsers() {
            // Open a new window with the whole users list and trigger print
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print All Users</title></head><body>');
            printWindow.document.write('<h1>All Users</h1>');
            printWindow.document.write(document.getElementById('usersTable').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
        </script>
    </div>
</body>
</html>
