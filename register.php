<?php
// Include database connection file
include 'connection.php';

// Initialize an empty message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $mobile = $_POST["mobile"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user_type = isset($_POST["user_type"]) ? $_POST["user_type"] : '';

    // Validate form data
    if (empty($username) || empty($mobile) || empty($email) || empty($password) || empty($user_type)) {
        // $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        // Prepare and execute SQL statement to insert user data into the database
        $sql = "INSERT INTO users (username, mobile, email, password, user_type) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $username, $mobile, $email, $password, $user_type);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful
            $message = "Registration successful! Redirecting to login page...";
            echo "<meta http-equiv='refresh' content='5;url=registration_complete.php'>"; // Redirect to login page after 5 seconds
        } else {
            // Handle registration failure
            $message = "Registration failed. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// If execution reaches here, registration failed or form not submitted
// Display error message if present
// if (!empty($message)) {
//     echo "<p>$message</p>";
// }
header("Location: registration_complete.php?username=$username&email=$email&user_type=$user_type");
exit;
?>
