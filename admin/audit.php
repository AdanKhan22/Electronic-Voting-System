<?php
session_start();
include '../db/connection.php';


// if (!isset($_SESSION['authenticated']) || $_SESSION['role'] !== 'admin') {
//     header('Location: ../login.php');
//     exit;
// }


$sql = "
    SELECT a.AuditID, a.UserID, a.ActionType, a.Timestamp, a.Description, c.Name, c.Email 
    FROM auditlog a
    JOIN Citizen c ON a.UserID = c.UserID
    ORDER BY a.Timestamp DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Audit Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: green;
            border-radius: 5px;
        }

        .btn.reject {
            background-color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Audit Page</h1>
        <table>
            <tr>
                <th>Audit ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
                <th>Description</th>
                <th>Timestamp</th>
                <th>Actions</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['AuditID'] ?></td>
                        <td><?= htmlspecialchars($row['Name']) ?></td>
                        <td><?= htmlspecialchars($row['Email']) ?></td>
                        <td><?= $row['ActionType'] ?></td>
                        <td><?= htmlspecialchars($row['Description']) ?></td>
                        <td><?= date('Y-m-d H:i:s', $row['Timestamp']) ?></td>
                        <td>
                            <a href="verify_user.php?userID=<?= $row['UserID'] ?>" class="btn">Verify</a>
                            <a href="reject_request.php?auditID=<?= $row['AuditID'] ?>" class="btn reject">Reject</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No verification requests found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>