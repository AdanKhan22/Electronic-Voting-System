<?php
session_start();
include '../db/connection.php';


$userId = $_SESSION['user_id'];


$sql = "SELECT c.userID, c.Name, c.Email, c.Role, c.PhoneNumber, c.Gender, v.VerifiedStatus, 
               a.Street, a.City, a.State, a.ZipCode 
        FROM citizen c 
        LEFT JOIN address a ON c.userID = a.AddressId
        LEFT JOIN voterverification v ON v.userID = c.userID
        WHERE c.userID = $userId";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
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

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .info-table th {
            background-color: #4CAF50;
            color: white;
        }

        .info-table td {
            background-color: #f9f9f9;
        }

        .info-table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .info-table td {
            font-size: 14px;
        }

        .info-table td,
        .info-table th {
            padding: 12px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Citizen Information</h1>

        <?php
        if ($result->num_rows > 0) {
            // Fetch the user data and display in the table
            $row = $result->fetch_assoc();
            echo "<table class='info-table'>
                    <tr>
                        <th>UserID</th>
                        <td>" . $row['userID'] . "</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>" . $row['Name'] . "</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>" . $row['Email'] . "</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>" . $row['Role'] . "</td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td>" . $row['PhoneNumber'] . "</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>" . $row['Gender'] . "</td>
                    </tr>
                    <tr>
                        <th>Verified Status</th>
                        <td>" . ($row['VerifiedStatus'] == 1 ? 'Yes' : 'No') . "</td>
                    </tr>
                    <tr>
                        <th>Street</th>
                        <td>" . $row['Street'] . "</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>" . $row['City'] . "</td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td>" . $row['State'] . "</td>
                    </tr>
                    <tr>
                        <th>Zip Code</th>
                        <td>" . $row['ZipCode'] . "</td>
                    </tr>
                </table>";
        } else {
            echo "<p>No data found for the current user.</p>";
        }
        ?>
    </div>

    <div class="footer">
        <p>&copy; 2025 Electronic Voting System</p>
    </div>

</body>

</html>