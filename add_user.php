<?php
// Start output buffering to prevent unexpected output
ob_start();

include('reportmodules/db.php');
include('sidebar.php');
include "header.php";

$error_message = ''; // Variable to store error messages

// Insert or update user based on the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];
    $password = $_POST['password']; // New password field
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0; // For updates, exclude current user ID

    // Check for duplicate email
    $sql = "SELECT id FROM user WHERE email = ? AND id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $email, $user_id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $error_message = "Email already exists!";
    } else {
        if (!empty($password)) {
            // Hash the password before saving to the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($user_id) {
            // Update existing user
            $sql = empty($password) 
                ? "UPDATE user SET name = ?, email = ?, role_id = ? WHERE id = ?" 
                : "UPDATE user SET name = ?, email = ?, role_id = ?, password = ? WHERE id = ?";
            
            $stmt = $conn->prepare($sql);
            if (empty($password)) {
                $stmt->bind_param('ssii', $name, $email, $role_id, $user_id);
            } else {
                $stmt->bind_param('ssisi', $name, $email, $role_id, $hashed_password, $user_id);
            }
            $stmt->execute();
            $stmt->close();
            header('Location: user_list.php');
            exit();
        } else {
            // Insert new user
            $sql = "INSERT INTO user (name, email, role_id, password) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssis', $name, $email, $role_id, $hashed_password);
            $stmt->execute();
            $stmt->close();
            header('Location: user_list.php');
            exit();
        }
    }
    $stmt->close();
}

// Fetch available roles for the dropdown
$sql = "SELECT id, role_name FROM roles";
$result = $conn->query($sql);

// Check if this is an edit (update) operation
$user = null;
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $user ? 'Edit User' : 'Add User' ?></title>
    <link rel="stylesheet" href="reportmodules/css/addstaff.css">
</head>
<body>
    <div class="container">
        <div class="main-content">
            <h1><?= $user ? 'Edit User' : 'Add New User' ?></h1>
            <?php if ($error_message): ?>
                <script>
                    alert("<?= $error_message; ?>");
                </script>
            <?php endif; ?>
            <form action="add_user.php" method="POST">
                <?php if ($user): ?>
                    <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                <?php endif; ?>

                <label for="name">User Name</label>
                <input type="text" id="name" name="name" value="<?= $user ? htmlspecialchars($user['name']) : ''; ?>" required>

                <label for="email">User Email</label>
                <input type="email" id="email" name="email" value="<?= $user ? htmlspecialchars($user['email']) : ''; ?>" required>

                <label for="role_id">Role</label>
                <select id="role_id" name="role_id" required>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?= $row['id']; ?>" <?= $user && $row['id'] == $user['role_id'] ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row['role_name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <label for="password">User Password</label>
                <input type="password" id="password" name="password" <?= !$user ? 'required' : ''; ?>>

                <button type="submit"><?= $user ? 'Update User' : 'Add User' ?></button>
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
