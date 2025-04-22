<?php
// Connection to the database
require_once(__DIR__ . "/../../../connections/connection.php");

if(isset($_GET['term'])){
    $search = $_GET['term'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_class WHERE class_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_class");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[]= [
        'id' => $row['class_id'],
        'text' => $row['class_name'],
    ];
}
echo json_encode($formattedOptions);
?>