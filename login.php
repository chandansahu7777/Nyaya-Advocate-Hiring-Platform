<?php
// Include database connection file
include 'connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $selected_user_type = $_POST["user_type"];

    // Prepare and execute SQL statement to fetch user data from the database
    $sql = "SELECT id, username, password, user_type FROM registration WHERE username = ? AND password = ? AND user_type = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $selected_user_type);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // If a user with the provided username, password, and user type exists
                // Proceed with authentication
                mysqli_stmt_bind_result($stmt, $id, $db_username, $db_password, $db_user_type);
                mysqli_stmt_fetch($stmt);

                // Set session variables and redirect to the appropriate dashboard
                session_start();
                $_SESSION["user_id"] = $id;
                $_SESSION["username"] = $db_username;
                $_SESSION["user_type"] = $db_user_type;

                switch ($db_user_type) {
                    case 'User':
                        header("Location: user-dashboard.html");
                        exit;
                    case 'Advocate':
                        header("Location: advocate-dashboard.html");
                        exit;
                    case 'Employee':
                        header("Location: employee-dashboard.html");
                        exit;
                    default:
                        // Redirect to login-error-message.php with an error message including user type
                        $error_message = "Invalid user type: $db_user_type";
                        header("Location: login-error-message.php?error=" . urlencode($error_message));
                        exit;
                }
            } else {
                // No user found with the provided credentials
                $error_message = "Incorrect username or password for login as a $selected_user_type.";
                header("Location: login-error-message.php?error=" . urlencode($error_message));
                exit;
            }
        } else {
            // Error executing SQL statement
            $message = "Error executing SQL statement: " . mysqli_error($conn);
            error_log($message);
        }
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error preparing SQL statement
        $message = "Error preparing SQL statement: " . mysqli_error($conn);
        error_log($message);
    }
}
?>
