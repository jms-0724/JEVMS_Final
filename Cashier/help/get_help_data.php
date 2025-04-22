<?php
require_once(__DIR__ . "/../../connections/connection.php");

if (isset($_GET['help_topic_id'])) {
    $help_topic_id = $_GET['help_topic_id'];

    // Fetch the help topic
    $sql1 = $conn->prepare("SELECT * FROM tbl_help WHERE help_id = :help_id");
    $sql1->bindParam(':help_id', $help_topic_id);
    $sql1->execute();
    $help_topic = $sql1->fetch();

    // Fetch the help items
    $sql2 = $conn->prepare("SELECT * FROM tbl_help INNER JOIN tbl_help_items ON tbl_help.help_id = tbl_help_items.help_id WHERE tbl_help.help_id = :help_id2");
    $sql2->bindParam(':help_id2', $help_topic_id);
    $sql2->execute();
    $help_items = $sql2->fetchAll();

    // Return data as JSON
    echo json_encode([
        'topic' => $help_topic['topic'],
        'items' => $help_items
    ]);
} else {
    echo json_encode([
        'error' => 'No help topic ID provided.'
    ]);
}

