<?php

include '../db/connection.php';


$sql = "SELECT r.ElectionID, c.Name AS CandidateName, c.PartyID, e.Name AS ElectionName, r.TotalVotes, 
        e.StartDate , e.EndDate
        FROM Results r
        JOIN Elections e ON r.ElectionID = e.ElectionID
        JOIN Candidate c ON r.CandidateID = c.CandidateID
        ORDER BY e.StartDate DESC, r.TotalVotes DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
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

        .results {
            margin-top: 20px;
        }

        .results ul {
            list-style-type: none;
            padding: 0;
        }

        .results li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .results li:nth-child(even) {
            background-color: #f2f2f2;
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
        <h1>Election Results</h1>

        <section class="results">
            <ul>
                <?php



                if ($result->num_rows > 0) {
                    // Loop through each result and display it
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row['ElectionName'] . " - Candidate: " . $row['CandidateName'] . " - Party ID: " . $row['PartyID'] .
                            " - Total Votes: " . number_format($row['TotalVotes']) . " - Start Date: " . $row['StartDate'] . " - End Date: " . $row['EndDate'] . "</li>";
                    }
                } else {
                    echo "<li>No election results found.</li>";
                }
                ?>
            </ul>
        </section>

    </div>

    <div class="footer">
        <p>&copy; 2025 Electronic Voting System</p>
    </div>

</body>

</html>