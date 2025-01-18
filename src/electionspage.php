<?php
include '../db/connection.php';
?>
<section class="elections">
    <h1>Elections</h1>

    <div class="tabs">
        <button onclick="showTab('ongoing')">Ongoing Elections</button>
        <button onclick="showTab('past')">Past Elections</button>
    </div>

    <!-- Ongoing Elections -->
    <div id="ongoing" class="tab-content">
        <h2>Ongoing Elections</h2>
        <?php
        $sql = "SELECT * FROM Elections WHERE EndDate >= CURDATE()";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($election = $result->fetch_assoc()) {
                echo "<h3>" . $election['Name'] . " (Election ID: " . $election['ElectionID'] . ")</h3>";

                $electionId = $election['ElectionID'];
                $candidateSql = "SELECT c.CandidateID, c.Name, p.Name AS PartyName 
                                 FROM Candidate c 
                                 LEFT JOIN Parties p ON c.PartyID = p.PartyID 
                                 WHERE c.ConstituencyID = " . $election['ConstituencyID'];

                $candidateResult = $conn->query($candidateSql);

                if ($candidateResult->num_rows > 0) {
                    echo "<ul>";
                    while ($candidate = $candidateResult->fetch_assoc()) {
                        echo "<li>
                                Candidate ID: <strong>" . $candidate['CandidateID'] . "</strong> - 
                                " . $candidate['Name'] . " - Party: " . $candidate['PartyName'] . "
                            <form method='POST' action='../src/utils/vote.php'>
                                 <input type='hidden' name='candidateId' value='" . $candidate['CandidateID'] . "'>
                                 <input type='hidden' name='electionId' value='" . $electionId . "'>
                                 <button type='submit' name='vote'>Vote</button>
                                </form>
                              </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No candidates available for this election.</p>";
                }
            }
        } else {
            echo "<p>No ongoing elections.</p>";
        }
        ?>
    </div>

    <!-- Past Elections -->
    <div id="past" class="tab-content" style="display:none;">
        <h2>Past Elections</h2>
        <?php
        $sql = "SELECT * FROM Elections WHERE EndDate < CURDATE()";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($election = $result->fetch_assoc()) {
                echo "<h3>" . $election['Name'] . " (Election ID: " . $election['ElectionID'] . ")</h3>";

                $electionId = $election['ElectionID'];
                $candidateSql = "SELECT c.CandidateID, c.Name, p.Name AS PartyName 
                                 FROM Candidate c 
                                 LEFT JOIN Parties p ON c.PartyID = p.PartyID 
                                 WHERE c.ConstituencyID = " . $election['ConstituencyID'];

                $candidateResult = $conn->query($candidateSql);

                if ($candidateResult->num_rows > 0) {
                    echo "<ul>";
                    while ($candidate = $candidateResult->fetch_assoc()) {
                        echo "<li>Candidate ID: <strong>" . $candidate['CandidateID'] . "</strong> - " . $candidate['Name'] . " - Party: " . $candidate['PartyName'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No candidates available for this election.</p>";
                }
            }
        } else {
            echo "<p>No past elections.</p>";
        }
        ?>
    </div>
</section>


<script>
    function showTab(tabName) {
        var ongoingTab = document.getElementById('ongoing');
        var pastTab = document.getElementById('past');

        if (tabName === 'ongoing') {
            ongoingTab.style.display = 'block';
            pastTab.style.display = 'none';
        } else {
            ongoingTab.style.display = 'none';
            pastTab.style.display = 'block';
        }

    }
</script>