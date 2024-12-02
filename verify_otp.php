<?php
include 'config.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Get OTP input from the user
$otp = $_POST['otp'];
$email = $_SESSION['email'];

// Prepare the SQL query to fetch OTP and expiry time
$sql = "SELECT otp, otp_expiry FROM user WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email); // "s" for string parameter (email)
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the OTP and check if it has expired
    if ($user['otp'] === $otp && strtotime($user['otp_expiry']) > time()) {
        // Successful verification
        echo "<script>
            alert('Login successful!');
            window.location.href = 'dashboard.php'; // Redirect to dashboard
        </script>";
        session_destroy(); // End the session
    } else {
        // Invalid or expired OTP
        echo "<script>
            alert('Invalid or expired OTP.');
            window.location.href = 'verify.php'; // Redirect back to the OTP page
        </script>";
    }
} else {
    // User not found
    echo "<script>
        alert('Error: User not found.');
        window.location.href = 'login.php'; // Redirect to the login page
    </script>";
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
