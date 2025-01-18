<?php
session_start();
include '../../db/connection.php';

echo "<h3>Session Data:</h3>";
if (!empty($_SESSION)) {
    foreach ($_SESSION as $key => $value) {
        echo "Session [$key]: $value<br>";
    }
} else {
    echo "No session data available.<br>";
}

echo "<h3>POST Data:</h3>";
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            echo "POST [$key]: " . implode(", ", $value) . "<br>";
        } else {
            echo "POST [$key]: $value<br>";
        }
    }
} else {
    echo "No POST data available.<br>";
}

echo "<h3>Debugging Details:</h3>";
echo "Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set') . "<br>";
echo "POST electionId: " . (isset($_POST['electionId']) ? $_POST['electionId'] : 'not set') . "<br>";
echo "POST vote: " . (isset($_POST['vote']) ? $_POST['vote'] : 'not set') . "<br>";

if (isset($_SESSION['user_id']) && isset($_POST['candidateId']) && isset($_POST['electionId'])) {
    $userId = $_SESSION['user_id'];
    $candidateId = $_POST['candidateId'];
    $electionId = $_POST['electionId'];

    echo "User ID: $userId<br>";
    echo "Election ID: $electionId<br>";
    echo "Candidate ID: $candidateId<br>";

    $checkVoteSql = "SELECT * FROM Votes WHERE VoterID = '$userId' AND ElectionID = '$electionId' AND HasVoted = TRUE";
    $checkVoteResult = $conn->query($checkVoteSql);

    if ($checkVoteResult->num_rows > 0) {
        echo "You have already voted in this election.<br>";
    } else {
        $candidateSql = "SELECT ConstituencyID FROM Candidate WHERE CandidateID = '$candidateId'";
        $candidateResult = $conn->query($candidateSql);
        $candidateRow = $candidateResult->fetch_assoc();
        $constituencyId = $candidateRow['ConstituencyID'];

        $timestamp = date('Y-m-d H:i:s');

        $voteSql = "INSERT INTO Votes (VoterID, CandidateID, ElectionID, Timestamp, ConstituencyID, HasVoted) 
                    VALUES ('$userId', '$candidateId', '$electionId', '$timestamp', '$constituencyId', 1)";
        if ($conn->query($voteSql) === TRUE) {
            echo "Vote cast successfully!<br>";

            $updateVoteCountSql = "UPDATE Candidate SET TotalVotes = TotalVotes + 1 WHERE CandidateID = '$candidateId'";
            if ($conn->query($updateVoteCountSql) === TRUE) {
                echo "Total votes updated successfully for the candidate.<br>";
            } else {
                echo "Error updating the total votes: " . $conn->error . "<br>";
            }
        } else {
            echo "Error voting for candidate " . $candidateId . ": " . $conn->error . "<br>";
        }
    }
} else {
    echo "Error: User is not logged in or invalid input.<br>";
}
