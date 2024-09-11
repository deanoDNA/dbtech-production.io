<?php
// db_config.php should include your database connection details
include 'db_config.php';

// Fetch monthly statistics
function fetchMonthlyStatistics($conn) {
    $currentYear = date('Y');
    $stats = [];

    for ($month = 1; $month <= 12; $month++) {
        $startDate = "$currentYear-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        $query = $conn->prepare("SELECT COUNT(*) as total_requests FROM service_requests WHERE request_date BETWEEN ? AND ?");
        $query->bind_param("ss", $startDate, $endDate);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();

        $stats[] = [
            'month' => date("F", mktime(0, 0, 0, $month, 10)),
            'total_requests' => $row['total_requests']
        ];
    }

    return $stats;
}

$statistics = fetchMonthlyStatistics($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <canvas id="monthlyStatisticsChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('monthlyStatisticsChart').getContext('2d');
        const monthlyStatisticsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($statistics, 'month')); ?>,
                datasets: [{
                    label: 'Number of Requests',
                    data: <?php echo json_encode(array_column($statistics, 'total_requests')); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
