<?php
session_start();
include 'config.php';
include 'header.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch services
$service_query = "SELECT * FROM services_table";
$service_result = mysqli_query($conn, $service_query);

// Fetch mechanics
$mechanic_query = "SELECT * FROM mechanics_table";
$mechanic_result = mysqli_query($conn, $mechanic_query);
?>

<h1>Welcome to Your Dashboard</h1>
<h2>Available Services</h2>
<table>
    <tr>
        <th>Service Name</th>
        <th>Description</th>
        <th>Price</th>
    </tr>
    <?php while ($service = mysqli_fetch_assoc($service_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($service['service_name']); ?></td>
            <td><?php echo htmlspecialchars($service['description']); ?></td>
            <td><?php echo htmlspecialchars($service['price']); ?> TZS</td>
        </tr>
    <?php endwhile; ?>
</table>

<h2>Available Mechanics</h2>
<table>
    <tr>
        <th>Mechanic Name</th>
        <th>Phone Number</th>
        <th>Expertise</th>
        <th>Location</th>
        <th>Action</th>
    </tr>
    <?php while ($mechanic = mysqli_fetch_assoc($mechanic_result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($mechanic['last_name']); ?></td>
            <td><?php echo htmlspecialchars($mechanic['phone_number']); ?></td>
            <td><?php echo htmlspecialchars($mechanic['expertise']); ?></td>
            <td><?php echo htmlspecialchars($mechanic['location']); ?></td>
            <td><a href="start_service.php?mechanic_id=<?php echo $mechanic['mechanic_id']; ?>">Select Mechanic</a></td>
        </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>
