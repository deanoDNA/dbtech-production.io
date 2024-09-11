<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "obva_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $security_answer = $_POST['security_answer'];

    if ($password1 !== $password2) {
        echo "Passwords do not match.";
        exit();
    }
    $sql = "SELECT * FROM users_table WHERE phone_number='$phone_number'";
    $result = $conn->query($sql);

    $hashed_password1 = password_hash($password1, PASSWORD_BCRYPT);
    $hashed_password2 = password_hash($password2, PASSWORD_BCRYPT);

    if ($result->num_rows > 0) {
        echo "<script>
                document.getElementById('message').innerHTML = 'Your Phone number or Email already registered!';
                document.getElementById('message').style.color = 'red';
              </script>";
    } else{
                $sql = "INSERT INTO users_table (first_name, last_name, phone_number, username, password1, password2, security_answer) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("sssssss", $first_name, $last_name, $phone_number, $username, $hashed_password1, $hashed_password2, $security_answer);

                    if ($stmt->execute()) {
                        // echo "New user registered successfully.";
                        header("Location: \OBVA system\index.html");
                        exit();
                    } else {
                        echo "Error: " . $stmt->error;
                    }
        
                }$stmt->close();
                
   
            }
    // if ($result->num_rows > 0) {
    //     echo "<script>
    //             document.getElementById('message').innerHTML = 'Email already registered!';
    //             document.getElementById('message').style.color = 'red';
    //           </script>";
    // } else {
    //             $sql = "INSERT INTO users_table (username, email, password) VALUES ('$username', '$email', '$password')";

    //             if ($conn->query($sql) === TRUE) {
    //                 echo "<script>
    //                 document.getElementById('message').innerHTML = 'Registration successful!';
    //                 document.getElementById('message').style.color = 'green';
    //               </script>";
    //     } else {
    //         echo "Error: " . $sql . "<br>" . $conn->error;
    //     }

}

$conn->close();
?>