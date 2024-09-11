<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Mechanics</title>
    <link rel="stylesheet" href="searchstyles.css">
</head>
<body class="body">
<div class="search-results">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search_query = $_POST['search_query'];

            // Database connection
            $conn = new mysqli("localhost", "root", "", "obva_system");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query the mechanics table
            $sql = "SELECT * FROM mechanics_table WHERE first_name LIKE '%$search_query%' OR location LIKE '%$search_query%'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Search Results:</h2>";
                while($row = $result->fetch_assoc()) {
                    echo "<div class='mechanic-card'>";
                    echo "<h3>" . $row["first_name"] . "</h3>";
                    echo "<p>Phone number or email: " . $row["phone_number"] . "</p>";
                    echo "<p>Specialize Expert: " . $row["expertise"] . "</p>";
                    echo "<p>Location: " . $row["location"] . "</p>";
                    echo "<button class='select-button'>Select</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No results found</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>