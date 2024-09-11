<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST['request_id'];
    $response_message = $_POST['response_message'];

    $sql = "UPDATE service_requests SET response='$response_message' WHERE id='$request_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Response submitted successfully";
        // Redirect to the list_service_requests.php with a success message
        header("Location: list_service_requests.php?message=Response+submitted+successfully");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        // Redirect to the list_service_requests.php with an error message
        header("Location: list_service_requests.php?message=Error+submitting+response");
    }

    $conn->close();
}
?>
