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
    <style>
 

</style>

</head>
<body>

        
<div class="container">
     
        <div class="main-content">
            <h1>Sign-Up Trends</h1>
            <?php
            $sql = "SELECT date, count FROM signups ORDER BY date DESC";
            $result = $conn->query($sql);
            ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>Date</th>
                    <th>Sign-Ups</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['date']; ?></td>
                        <td><?= $row['count']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
