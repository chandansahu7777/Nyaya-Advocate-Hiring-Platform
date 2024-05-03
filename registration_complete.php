<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=login.html"> <!-- Redirect to home page after 5 seconds -->
    <title>Registration Complete</title>
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
        // Retrieve the username, email, and user type from the URL parameters
        $username = isset($_GET['username']) ? $_GET['username'] : '';
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : '';

        // Output the registration complete message
        echo "<p>Registration complete! Thank you,  <b>$username ($email)</b>, for registering as a <b>$user_type</b>.</p>";
        ?>
    </div>
</body>
</html>
