<?php

include 'config.php';

// Get user input from the registration form
$email = $_POST['email'];
$password = $_POST['password'];

// Function to display pop-up messages and redirect the user
function showAlertAndRedirect($message, $redirect = "register.php") {
    echo "<script>
        alert('$message');
        window.location.href = '$redirect';
    </script>";
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showAlertAndRedirect("Invalid email format");
}

// Check password strength
if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
    showAlertAndRedirect("Password must be at least 8 characters long and include an uppercase letter and a number.");
}

// Check if the email already exists in the database
$sql_check = "SELECT id FROM users WHERE email = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    showAlertAndRedirect("This email is already registered. Please use a different email.");
}

// Hash the password for secure storage
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new user into the database
$sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    showAlertAndRedirect("Registration successful! Please log in.", "login.php");
} else {
    showAlertAndRedirect("Error: " . $conn->error);
}
?>
