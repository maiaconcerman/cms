<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php'; // Include PHPMailer
require 'phpmailer/src/PHPMailer.php'; // Include PHPMailer
require 'phpmailer/src/SMTP.php'; // Include PHPMailer


include 'config.php';
session_start();

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the logged-in email
$email = $_SESSION['email'];

// Generate a random 6-digit OTP
$otp = rand(100000, 999999);
$expiry = date("Y-m-d H:i:s", strtotime("+5 minutes"));

// Store OTP and its expiry time in the database
$stmt = $conn->prepare("UPDATE user SET otp = ?, otp_expiry = ? WHERE email = ?");
$stmt->bind_param("sss", $otp, $expiry, $email);
$stmt->execute();

// Send OTP via email
$mail = new PHPMailer(true);

try {
    // Mail server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
    $mail->SMTPAuth = true;
    $mail->Username = 'sinagcms@gmail.com'; // Replace with your email
    $mail->Password = 'wzpsgjhgwiupxubg'; // Replace with your app password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    
    // Sender and recipient settings
    $mail->setFrom('your-email@example.com', 'Your Application');
    $mail->addAddress($email);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP Code';
    $mail->Body    = "<p>Your OTP code is <strong>$otp</strong>.</p><p>This code will expire in 5 minutes.</p>";
    
    $mail->send();
    
} catch (Exception $e) {
    echo "Error: Could not send OTP. Mailer Error: {$mail->ErrorInfo}";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div id="otp-container">
        <h2 id="otp-title">OTP Verification</h2>
        <p id="otp-display">An OTP has been sent to your email</p>
        <form action="verify_otp.php" method="POST">
            <input type="text" name="otp" placeholder="Enter OTP" required id="otp-input">
            <button type="submit" id="otp-button">Verify</button>
        </form>
    </div>
</body>
</html>