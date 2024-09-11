<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: https://localhost/obva%20system/login.html");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Welcome to our system Dashboard</title>
    <link rel="stylesheet" type="text/css" href="Styles.css">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="search/styles.css"> -->
    <link rel="stylesheet" href="searchstyles.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('carimage/carTOWING.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 600px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9); /* semi-transparent white background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        h2 {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type=text], 
        input[type=email], input[type=tel], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 90px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            /* display: block; */
            margin: auto;
        }
        button:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="navbar">
      <div class="navInfo">
        <a href="">
        <i class="fas fa-user"></i>
        </a>
      </div>
      <div class="sach">
        <div class="search-bar">
          <form method="POST" action="search.php">
              <input type="search" name="search_query" placeholder="Search mechanics..." required>
              <button type="submit">Search</button>
          </form>
      </div>
      </div>
    <ul class="nav-links">
        <li><a href="userboard.php">Home</a></li>
        <li><a href="#">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
        <div class="brand"><a href="login/admin.html"><i class="fas fa-user"></i></a></div>
        <div class="toggle" onclick="toggleSidebar()">
            <div class="toggle-bar"></div>
            <div class="toggle-bar"></div>
            <div class="toggle-bar"></div>
        </div>
    </div>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="userboard.php">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
    <div class="content">
    
    

<div class="body">

    <div class="container">
        <h2>Request Services Form</h2>
        <form action="submit_request.php" method="post">
            <label for="user_id">Your User ID</label>
            <input type="text" id="user_id" name="user_id" required>

            <label for="service_id">Service ID</label>
            <input type="text" id="service_id" name="service_id" required>

            <label for="description">Short Description about the Breakdown</label>
            <textarea id="description" name="custom_problem" required></textarea>

            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">Accept our terms and conditions.</label>
            <p>By requesting this service you agree to the terms and conditions of our services.</p>

            <input type="submit" value="Submit Request">
        </form>
    </div>
    </div>
        
        
    </div>
        


          <footer>
            <div class="text">
              <span>Created By <a href="#">db Tech-production</a> | &#169; 2024 All Rights Reserved</span>
            </div>
            <div class="socialmedia">
              <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-twitter"></i></a>
            </div>
          </footer>
      
          <script src="js/script.js"></script>


    </div>
    <script src="script.js"></script>
</body>
</html>
