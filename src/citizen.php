<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "electronic_voting";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT name, email FROM citizen";
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
                echo "<li>" . htmlspecialchars($citizen['name']) . " - " . htmlspecialchars($citizen['email']) . "</li>";
            }
        } else {
            echo "<li>No citizens registered.</li>";
        }
        ?>
    </ul>
</section>