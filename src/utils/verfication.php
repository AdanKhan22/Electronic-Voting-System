<?php
session_start();
include '../../db/connection.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];


    $checkSql = "SELECT * FROM auditlog WHERE UserID = '$userId' AND ActionType = 'Verify User Request' LIMIT 1";
    $checkResult = $conn->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {

        echo "Verification sent.<br>";
    } else {

        $actionType = 'Verify User Request';
        $timestamp = date('Y-m-d H:i:s');
        $description = "Request from $userId to verify";


        $auditLogSql = "INSERT INTO auditlog (UserID, ActionType, Timestamp, Description) 
                        VALUES ('$userId', '$actionType', '$timestamp', '$description')";

        if ($conn->query($auditLogSql) === TRUE) {
            echo "Verification request logged successfully.<br>";
        } else {

            echo "Error logging the action: " . $conn->error . "<br>";
        }
    }
} else {
    echo "User not logged in.<br>";
}
