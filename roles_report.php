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
            <h1>Roles Report</h1>
            <?php
            $sql = "SELECT id, role_name FROM roles";
            $result = $conn->query($sql);
            ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Role ID</th>
                    <th>Role Name</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['role_name']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</body>
    <?php include "footer.php"; ?>
</body>
</html>
