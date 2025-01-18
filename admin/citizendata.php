<?php
session_start();
include '../db/connection.php';


$sql = "SELECT c.userID, c.Name, c.Email, c.Role, c.PhoneNumber, c.Gender, v.VerifiedStatus, 
               a.Street, a.City, a.State, a.ZipCode 
        FROM citizen c 
        LEFT JOIN address a ON c.userID = a.AddressID
        LEFT JOIN voterverification v ON v.userID = c.userID";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>

    <h1>Citizen Information</h1>

    <table>
        <tr>
            <th>UserID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Phone Number</th>
            <th>Gender</th>
            <th>Verified Status</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $row['userID'] . "</td>
                    <td>" . $row['Name'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['Role'] . "</td>
                    <td>" . $row['PhoneNumber'] . "</td>
                    <td>" . $row['Gender'] . "</td>
                    <td>" . ($row['VerifiedStatus'] == 1 ? 'Yes' : 'No') . "</td>
                    <td>" . $row['Street'] . "</td>
                    <td>" . $row['City'] . "</td>
                    <td>" . $row['State'] . "</td>
                    <td>" . $row['ZipCode'] . "</td>
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='11'>No citizens found.</td></tr>";
        }
        ?>
    </table>

</body>

</html>