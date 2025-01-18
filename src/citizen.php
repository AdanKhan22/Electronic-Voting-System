<?php

include '../db/connection.php';


$sql = "SELECT userID , name, email FROM citizen";
$result = $conn->query($sql);


if ($result->num_rows > 0) {

    $citizens = [];
    while ($row = $result->fetch_assoc()) {
        $citizens[] = $row;
    }
} else {
    $citizens = [];
}

$conn->close();
?>

<section class="citizens">
    <h1>Citizens</h1>
    <ul>
        <?php
        if (count($citizens) > 0) {
            foreach ($citizens as $citizen) {
                echo "<li>" . htmlspecialchars($citizen['userID']) . " - " . htmlspecialchars($citizen['name']) . " - " . htmlspecialchars($citizen['email']) . "</li>";
            }
        } else {
            echo "<li>No citizens registered.</li>";
        }
        ?>
    </ul>
</section>