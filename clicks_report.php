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
            <h1>Clicks Report</h1>
            <?php
            $sql = "SELECT item_name, click_count FROM clicks ORDER BY click_count DESC";
            $result = $conn->query($sql);
            ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Item</th>
                    <th>Clicks</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['item_name']; ?></td>
                        <td><?= $row['click_count']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
