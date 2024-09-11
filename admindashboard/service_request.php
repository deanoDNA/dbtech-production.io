<?php
include 'db_config.php';

// Fetch services from the database
$query = $conn->query("SELECT * FROM services_table");
$services = $query->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Service</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Request a Service</h1>
        <form action="submit_request.php" method="POST">
            <div class="form-group">
                <label for="service">Select Service:</label>
                <select name="service_id" id="service" required>
                    <option value="">-- Select a Service </option>

                    <!-- <option value="service">Tyre change</option>
                    <option value="service">Oil Change</option>
                    <option value="service">Towing services</option>
                    <option value="service">Oil Deivery</option>
                    <option value="service">Gas filling services</option>
                    <option value="service">Quick Service</option>
                    <option value="service">Car electric service</option> -->
                    <?php foreach ($services as $service): ?>
                        <option value="<?php echo $service['service_id']; ?>">
                            <?php echo $service['service_name'] . " - " . number_format($service['service_price'], 2) . " TZS"; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="custom_problem">Or describe your problem:</label>
                <textarea name="custom_problem" id="custom_problem" rows="4"></textarea>
            </div>
            <button type="submit">Submit Request</button>
        </form>
    </div>
</body>
</html>
