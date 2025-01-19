<?php
session_start();
include '../db/connection.php';


// if (!isset($_SESSION['authenticated']) || $_SESSION['role'] !== 'admin') {
//     header('Location: ../login.php');
//     exit;
// }


if (isset($_GET['auditID'])) {
    $auditID = intval($_GET['auditID']);


    $sql = "DELETE FROM AuditLog WHERE AuditID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $auditID);

    if ($stmt->execute()) {
        header('Location: audit.php?status=rejected');
    } else {
        header('Location: audit.php?status=error');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: audit.php?status=invalid');
}
exit;
