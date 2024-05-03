<?php
// Retrieve the username and user type from the URL parameters
include 'login.php';
$username = isset($_GET['username']) ? $_GET['username'] : '';
$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : '';

// Retrieve the error message
$error_message = isset($_GET['error']) ? $_GET['error'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=login.html"> <!-- Redirect to login page after 5 seconds -->
    <title>Login Error</title>
    <style>
        /* Style for the popup message */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            border: 1px solid #cccccc;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="popup">
        <?php
        // Output the login error message
       
        echo "<p>Incorrect username $username  or password or user type</b>.</p>";
        ?>
    </div>
</body>
</html>
