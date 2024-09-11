<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search_result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];
    $sql = "SELECT * FROM mechanics_table WHERE name LIKE '%$search_query%' OR location LIKE '%$search_query%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $search_result .= "<div class='card mt-2'><div class='card-body'>";
            $search_result .= "<h5 class='card-title'>" . $row['name'] . "</h5>";
            $search_result .= "<p class='card-text'>Location: " . $row['location'] . "</p>";
            $search_result .= "<p class='card-text'>Contact: " . $row['contact'] . "</p>";
            $search_result .= "</div></div>";
        }
    } else {
        $search_result = "<p class='mt-2'>No mechanics found.</p>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Mechanics</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Vehicle Breakdown Assistance</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search_mechanics.php">Search Mechanics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Search Mechanics</h1>
        <form method="post" action="search_mechanics.php">
            <div class="form-group">
                <input type="text" class="form-control" name="search_query" placeholder="Enter mechanic name or location">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="mt-4">
            <?php echo $search_result; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
