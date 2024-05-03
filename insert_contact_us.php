<?php
// Include the database connection file
include 'connection.php';

// Initialize a variable to hold the message
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $message = $_POST["Message"];

    // Prepare and execute the SQL statement to insert data into the contact_us_table
    $sql = "INSERT INTO contact_us_table (name, email, message) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Data inserted successfully
            $message = "Your message has been sent successfully!";
        } else {
            // Failed to execute the statement
            $message = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($conn);

// Redirect the user to the message page after form submission
header("Location: message.php?message=" . urlencode($message));
exit;
?>
