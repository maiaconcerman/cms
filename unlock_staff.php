<?php
include('reportmodules/db.php');
session_start();


// Get the staff ID from the URL
$staff_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($staff_id) {
    // Unlock the account by resetting `is_locked` and `failed_attempts`
    $sql = "UPDATE user SET is_locked = 0, failed_attempts = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $staff_id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Account successfully unlocked.";
    } else {
        $_SESSION['message'] = "Failed to unlock the account.";
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Invalid staff ID.";
}

// Redirect back to the user list
header('Location: user_list.php');
exit();
?>
