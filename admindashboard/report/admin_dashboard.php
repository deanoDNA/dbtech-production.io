<?php
include 'db_config.php';

// Fetch daily statistics for a given month and year
function fetchDailyStatistics($conn, $year, $month) {
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $statistics = [];

    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = sprintf("%04d-%02d-%02d", $year, $month, $day);
        $query = $conn->prepare("SELECT COUNT(*) as total_requests FROM service_requests WHERE DATE(request_date) = ?");
        $query->bind_param("s", $date);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $statistics[] = [
            'date' => $date,
            'total_requests' => $row['total_requests']
        ];
    }

    return $statistics;
}

// Set default values for the current month and year
$selectedYear = date('Y');
$selectedMonth = date('m');

// Update the selected month and year based on form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selectedYear = $_POST['year'];
    $selectedMonth = $_POST['month'];
}

$statistics = fetchDailyStatistics($conn, $selectedYear, $selectedMonth);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="stylee.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>User request MOnthly Report</h1>
       
        </form>
        <canvas id="dailyStatisticsChart"></canvas>

        <form method="POST">
            <div class="form-group">
                <label for="year">Select Year:</label>
                <select name="year" id="year" required>
                    <?php
                    for ($i = 2020; $i <= date('Y'); $i++) {
                        echo "<option value=\"$i\" " . ($selectedYear == $i ? "selected" : "") . ">$i</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="month">Select Month:</label>
                <select name="month" id="month" required>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $monthName = date("F", mktime(0, 0, 0, $i, 10));
                        echo "<option value=\"$i\" " . ($selectedMonth == $i ? "selected" : "") . ">$monthName</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit">View Statistics</button>
    </div>

    <script>
        const ctx = document.getElementById('dailyStatisticsChart').getContext('2d');
        const dailyStatisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($statistics as $stat) echo '"' . date("d", strtotime($stat['date'])) . '", '; ?>],
                datasets: [{
                    label: 'Number of Requests',
                    data: [<?php foreach ($statistics as $stat) echo $stat['total_requests'] . ', '; ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'red',
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
