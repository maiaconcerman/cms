<?php
include('reportmodules/db.php');
session_start();

// Check if the user is logged in and has admin privileges

// Check if staff ID is provided
if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    // Delete the staff record
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $staff_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the staff list page
    header('Location: user_list.php');
    exit();
} else {
    echo "userID not provided.";
}
?>
