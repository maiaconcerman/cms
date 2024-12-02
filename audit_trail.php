<?php include('reportmodules/db.php'); ?>
<?php
include "header.php";
?>
<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clicks Report</title>
  
    <link rel="stylesheet" href="reportmodules/css/styles.css">
   

</head>
<body>

        
<div class="container">
        
        <div class="main-content">
            <h1>Audit Trail</h1>
            <?php
            $sql = "SELECT user_id, action, timestamp FROM audit_trail ORDER BY timestamp DESC";
            $result = $conn->query($sql);
            ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Timestamp</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['user_id']; ?></td>
                        <td><?= $row['action']; ?></td>
                        <td><?= $row['timestamp']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
