<?php
// Start output buffering to prevent unexpected output
ob_start();

include('reportmodules/db.php');
include "header.php";
include('sidebar.php');

// Get staff ID from URL
$staff_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch current staff data
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $staff_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Fetch available roles for the dropdown
$sql = "SELECT id, role_name FROM roles";
$roles_result = $conn->query($sql);

// Handle form submission to update staff data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    $password = $_POST['password']; // New password field (optional)

    if (!empty($password)) {
        // If a new password is provided, hash it and update the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET name = ?, email = ?, role_id = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssisi', $name, $email, $role_id, $hashed_password, $staff_id);
    } else {
        // If no password is provided, just update name, email, and role
        $sql = "UPDATE user SET name = ?, email = ?, role_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssii', $name, $email, $role_id, $staff_id);
    }

    // Execute the query and close the statement
    $stmt->execute();
    $stmt->close();

    // Redirect to staff list after updating
    header('Location: user_list.php');
    exit(); // Ensure no further code is executed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <link rel="stylesheet" href="reportmodules/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h1>Edit Staff</h1>
            <form action="edit_staff.php?id=<?= htmlspecialchars($user['id']); ?>" method="POST">
                <label for="name">Staff Name:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']); ?>" required>

                <label for="email">Staff Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" required>

                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id" required>
                    <?php while ($role = $roles_result->fetch_assoc()): ?>
                        <option value="<?= $role['id']; ?>" <?= $role['id'] == $user['role_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($role['role_name']); ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="password">Password (Leave empty to keep current password):</label>
                <input type="password" id="password" name="password">

                <button type="submit">Update Staff</button>
            </form>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>

<?php
// End output buffering and flush output
ob_end_flush();
?>
