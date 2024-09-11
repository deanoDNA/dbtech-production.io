<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


$message = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once 'db_connection.php';

    $username = $_POST['username'];
    $password = $_POST['password1'];


    $sql = "SELECT * FROM mechanics_table WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password1'])) {
            $_SESSION['mechanic_loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: http://localhost/obva%20system/mechanicdashboard/mechanic_dashboard.php");
            exit;
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No Mechanic found with that Username.";
    }

    $stmt->close();
    $conn->close();
}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST['username']) && isset($_POST['password1'])) {
//         $username = $_POST['username'];
//         $password = $_POST['password1'];

//         // Prepare SQL statement
//         $sql = "SELECT mechanic_id, password1 FROM mechanics_table WHERE username = ?";
//         $stmt = $conn->prepare($sql);

//         if ($stmt) {
//             $stmt->bind_param("s", $username);
//             $stmt->execute();
//             $stmt->store_result();

//             // Check if user exists
//             if ($stmt->num_rows > 0) {
//                 $stmt->bind_result($id, $hashed_password);
//                 $stmt->fetch();

//                 // Verify password
//                 if (password_verify($password, $hashed_password)) {
//                     $_SESSION['mechanic_id'] = $id;
//                     $_SESSION['username'] = $username;
//                     // echo "Login successful. Welcome!";
//                     // Redirect to a protected page or user dashboard
//                     header("Location: http://localhost/obva%20system/mechanicdashboard/mechanic_dashboard.php");
//                     exit();
//                 } else {
//                     $message = "Invalid password.";
//                 }
//             } else {
//                 $message = "No Mechanic found with that Username.";
//             }


//             $stmt->close();
//         } else {
//             echo "Error preparing statement: " . $conn->error;
//         }
//     } 
// }

// $conn->close();

if ($message) {
    echo "<script>
        window.onload = function() {
            const popup = document.getElementById('popup');
            const popupMessage = document.getElementById('popup-message');
            popupMessage.textContent = '$message';
            popup.classList.add('show');
            setTimeout(function() {
                popup.classList.remove('show');
            }, 3000);
        }
    </script>";
    include 'mechanic.html';
}

?>
