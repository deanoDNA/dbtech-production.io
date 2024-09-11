<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request a Service</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Available Services</h1>
        <div id="servicesList" class="row">
            <?php include 'fetch_services.php'; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function requestService(serviceId) {
            $.post("request_service.php", { service_id: serviceId })
                .done(function(response) {
                    alert(response);
                })
                .fail(function() {
                    alert("Failed to request service.");
                });
        }
    </script>
</body>
</html>
