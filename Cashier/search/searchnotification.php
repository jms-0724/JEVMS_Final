<?php
session_start();
header('Content-Type: application/json');
require_once(__DIR__ . '/../../connections/connection.php');


try {
    // Fetch unread notifications
    $stmt = $conn->prepare("SELECT notification_id, notification_text, notification_status, datetime 
                            FROM tbl_notifications 
                            WHERE notification_status = 'Unread' 
                            ORDER BY datetime DESC");
    $stmt->execute();
    $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['notifications' => $notifications]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch notifications']);
}


