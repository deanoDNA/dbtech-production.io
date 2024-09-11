<!DOCTYPE html>
<html>
<head>
    <title>Login to continue</title>
    <link rel="stylesheet" type="text/css" href="assets/Styles.css">
    <link rel="stylesheet" href="assets/style.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="popup.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="fontawsome/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="navbar">
      <div class="navInfo">
        <a href="">
        <i class="fas fa-user"></i>
        </a>
      </div>
        <div class="brand"><a href="login/admin.html"><i class="fas fa-user"></i></a></div>
        <div class="toggle" onclick="toggleSidebar()">
            <div class="toggle-bar"></div>
            <div class="toggle-bar"></div>
            <div class="toggle-bar"></div>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Welcome to Our OBVA System</h1>
      
          <section class="home">
            <!-- <div class="form-page">
              <div class="myform">
                  <form action="login.php" method="post">
                      <h1>Please login to continue</h1>
                      
                      <div class="input">
                          <i class="fas fa-user"></i>
                          <input type="text" name="reg_number" placeholder="Enter username" required>
                      </div>
                      <div class="input">
                          <i class="fas fa-lock"></i>
                          <input type="password" name="password1" placeholder="Enter password" required>
                      </div>
                      <button>Login</button>
                      <div class="other">
                          <a href="register.html">Click here to register.</a><br>
                          <a href="admin.html">Login as admin.</a><br>
                          <a href="mechanic.html">Login as mechanic.</a><br>
                          <a href="#">Forget your passsword?</a>
                      </div>
                  </form> -->
                  
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Admin Dashboard</title>
                <link rel="stylesheet" href="admin/style.css">
                <script>
                    function printPage() {
                        window.print();
                    }

                    function confirmDelete(userId){
                        if (confirm("Are you sure you want to delete this user?")) {
                            window.location.href = 'admin/delete_user.php?id=' + userId;
                        }
                    }
                </script>
            </head>
            <body>
                <div class="container">
                    <h1>Admin Dashboard</h1>

                    <!-- Users Table -->
                    <h2 align="center">Users List</h2>
                    
                    
                    <table>
                    <h3 align="left"><button onclick="openForm('admin/add-user')">Add User</button></h3>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Reg Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'admin/db_connection.php';
                            $sql = "SELECT * FROM users_table";
                            $result = $conn->query($sql);

                            if ($result === FALSE) {
                                die("Error: " . $conn->error);
                            }

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["phone_number"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["reg_number"]) . "</td>";
                                    echo "<td>
                                    <a href='edit_user.php?id=" . htmlspecialchars($row["id"]) . "'><button class='action-btn'>Edit</button></a>
                                    <button class='action-btn delete-btn' onclick='confirmDelete(" . htmlspecialchars($row["id"]) . ")'>Delete</button>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No users found</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <div class="buttons">
                        <a href=".php"><button>Back to Home</button></a>
                        <button onclick="printPage()">Print</button>
                    </div>
                    <script src="failed/script.js"></script>
                </div>

          <!-- </section> -->


          <!-- <footer>
            <div class="text">
              <span>Created By <a href="#">db Tech-production</a> | &#169; 2024 All Rights Reserved</span>
            </div>
            <div class="socialmedia">
              <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
          </footer> -->
          <div id="popup" class="popup">
            <p id="popup-message"></p>
        </div>
      
          <script src="assets/js/script.js"></script>
          

    <!-- </div> -->
    <script src="assets/script.js"></script>
    <script src="popup.js"></script>

</body>
</html>
