<?php include('reportmodules/db.php'); ?>
<?php include "header.php"; ?>
<?php include('sidebar.php'); ?>

<?php
// Fetch all staff data with their roles and lock status
$sql = "SELECT user.id, user.name, user.email, roles.role_name, user.is_locked 
        FROM user 
        INNER JOIN roles ON user.role_id = roles.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="reportmodules/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h1>User List</h1>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($staff = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $staff['id']; ?></td>
                            <td><?= htmlspecialchars($staff['name']); ?></td>
                            <td><?= htmlspecialchars($staff['email']); ?></td>
                            <td><?= htmlspecialchars($staff['role_name']); ?></td>
                            <td>
                                <?= $staff['is_locked'] ? '<span style="color: red;">Locked</span>' : '<span style="color: green;">Active</span>'; ?>
                            </td>
                            <td>
                                <a href="edit_staff.php?id=<?= $staff['id']; ?>">Edit</a> | 
                                <a href="delete_staff.php?id=<?= $staff['id']; ?>" onclick="return confirm('Are you sure you want to delete this staff member?');">Delete</a>
                                <?php if ($staff['is_locked']): ?>
                                    | <a href="unlock_staff.php?id=<?= $staff['id']; ?>" onclick="return confirm('Are you sure you want to unlock this account?');">Unlock</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
