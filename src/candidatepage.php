<?php
include '../db/connection.php';


$sql = "SELECT c.CandidateID, c.Name, p.Name AS PartyName, e.Name AS ElectionName 
        FROM Candidate c 
        LEFT JOIN Parties p ON c.PartyID = p.PartyID 
        LEFT JOIN Elections e ON c.ConstituencyID = e.ConstituencyID 
        WHERE e.EndDate >= CURDATE()";
$result = $conn->query($sql);
?>

<section class="candidates">
    <h1>Candidates</h1>
    <?php
    if ($result->num_rows > 0) {
        while ($candidate = $result->fetch_assoc()) {
            echo "<h3>Election: " . $candidate['ElectionName'] . "</h3>";
            echo "<ul>";
            echo "<li>" . $candidate['Name'] . " - Party: " . $candidate['PartyName'] . "</li>";
            echo "</ul>";
        }
    } else {
        echo "<p>No candidates available.</p>";
    }
    ?>
</section>