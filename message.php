<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=index.html"> <!-- Redirect to home page after 5 seconds -->
    <title>Message</title>
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
        // Retrieve the message from the URL parameter
        $message = isset($_GET['message']) ? $_GET['message'] : '';

        // Output the message
        echo $message;
        ?>
    </div>
</body>
</html>
