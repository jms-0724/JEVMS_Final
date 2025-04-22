<?php
session_start();
header('Content-Type: application/json');

// Include the database connection file
require_once(__DIR__ . '/../../connections/connection.php'); // Adjust the path as needed

try {
    // Prepare the SQL query to count unread notifications
    $stmt = $conn->prepare("SELECT COUNT(*) AS unread_count FROM tbl_notifications WHERE notification_status = :status");
    $status = 'Unread'; // Define the status you want to check
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the result
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Initialize the count variable
    $unread_count = (int)$row['unread_count']; // Get the unread count

    // Return the count as JSON
    echo json_encode(['unread_count' => $unread_count]);
    
} catch (PDOException $e) {
    // Handle any errors
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Close the database connection
    $conn = null;
}
?>
