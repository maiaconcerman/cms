<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']); // Client's email
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'sinag');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL query to insert data
    $sql = "INSERT INTO contact_form (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>console.log('Message saved successfully in the database!');</script>";

        // Send Email to Client and Sinag Email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail's SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'sinagcms@gmail.com'; // Your Gmail address
            $mail->Password = 'wzpsgjhgwiupxubg';  // Your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients: Sending to the Client
            $mail->setFrom('sinagcms@gmail.com', 'SINAG'); // Sender's email
            $mail->addAddress($email, $name); // Client's email and name

            // Email Content for Client
            $mail->isHTML(true);
            $mail->Subject = "Thank you for your inquiry: $subject";
            $mail->Body = "
                <p>Hi $name,</p>
                <p>Thank you for reaching out. Here is a copy of your message:</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
                <p>We'll get back to you as soon as possible.</p>
                <p>Best regards,<br>Your Company</p>
            ";

            // Send email to the client
            $mail->send();

            // Notify Sinag Email
            $mail->clearAddresses(); // Clear previous recipient
            $mail->addAddress('sinagcms@gmail.com'); // Sinag's email address
            $mail->Subject = "New Inquiries Form Submission from $name";
            $mail->Body = "
                <p>You received a new contact form submission:</p>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong></p>
                <p>$message</p>
            ";

            // Send email to Sinag
            $mail->send();

            // Pop-up Success Message
            echo "<script>
            alert('Emails were sent successfully!');
            window.location.href = 'landingpage.php'; // Redirect to landing page
        </script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    } else {
        echo "<script>alert('Error saving data: " . $stmt->error . "');</script>";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>