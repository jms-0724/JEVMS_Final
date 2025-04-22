<?php

session_start();
header('Content-Type: application/json');
require_once(__DIR__ . '/../../connections/connection.php');


$data = json_decode(file_get_contents("php://input"), true);
$notification_id = $data['notification_id'];


try {
    // Update the notification status to 'read'
    $stmt = $conn->prepare("UPDATE tbl_notifications SET notification_status = 'Read' WHERE notification_id = :id");
    $stmt->execute(['id' => $notification_id]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Failed to mark notification as read']);
}

?>
