<?php
session_start();
include '../db/connection.php';



// if (!isset($_SESSION['authenticated']) || $_SESSION['role'] !== 'admin') {
//     header('Location: ../login.php');
//     exit;
// }

if (isset($_GET['userID'])) {
    $userID = intval($_GET['userID']);
    $verifiedStatus = 1;
    $verifiedMethod = "admin";

    $sql = "INSERT INTO VoterVerification (UserID, VerifiedStatus, VerificationMethod) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $userID, $verifiedStatus, $verifiedMethod);

    if ($stmt->execute()) {
        $deleteSql = "DELETE FROM auditlog WHERE UserID = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param('i', $userID);
        $deleteStmt->execute();

        header('Location: audit.php?status=success');
    } else {
        header('Location: audit.php?status=error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: audit.php?status=invalid');
}
exit;
