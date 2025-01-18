<?php

include '../db/connection.php';


$sql = "SELECT u.UserID, u.Name , v.VerifiedStatus FROM voterverification v RIGHT JOIN Citizen u ON v.UserID = u.UserID;";  // Assuming a Users table with a Verified column
$result = $conn->query($sql);
?>

<section class="voters">
    <h1>Voter Information</h1>


    <form action="../src/utils/verfication.php" method="POST">
        <button type="submit" name="verify_all" style="background-color: red; color: white;">Verify Yourself</button>
    </form>

    <ul>
        <?php
        if ($result->num_rows > 0) {
            // Loop through all voters
            while ($row = $result->fetch_assoc()) {
                $userId = $row['UserID'];
                $name = $row['Name'];
                $isVerified = $row['VerifiedStatus'] == 1 ? 'Yes' : 'No';
                echo "<li>$name -- $userId - Verified: $isVerified</li>";
            }
        } else {
            echo "<p>No voters found.</p>";
        }
        ?>
    </ul>
</section>