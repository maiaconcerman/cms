<?php
include 'config.php';
session_start();

// Initialize a message variable
$message = "";

// Get user input from login form
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user data from the database
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Check if the account is locked
    if ($user['is_locked']) {
        $message = "Account is locked due to multiple failed attempts.";
    } else {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Reset failed attempts on successful login
            $conn->query("UPDATE user SET failed_attempts = 0 WHERE email='$email'");

            // Set session variables for authenticated user
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $user['role'];
            header("Location: verify.php"); // Redirect to 2FA verification
            exit();
        } else {
            // Increment failed attempts on incorrect password
            $failed_attempts = $user['failed_attempts'] + 1;

            if ($failed_attempts >= 3) {
                // Lock the account if failed attempts reach 3
                $conn->query("UPDATE user SET is_locked = 1, failed_attempts = $failed_attempts WHERE email='$email'");
                $message = "Account locked due to 3 failed attempts. Please contact support.";
            } else {
                $conn->query("UPDATE user SET failed_attempts = $failed_attempts WHERE email='$email'");
                $message = "Invalid credentials. Attempt $failed_attempts of 3.";
            }
        }
    }
} else {
    $message = "User not found.";
}

// If there is a message, display it using JavaScript
if (!empty($message)) {
    echo "<script type='text/javascript'>
            alert('$message');
            window.location.href = 'login.php'; // Redirect back to login page
          </script>";
    exit();
}
?>
