<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_journal_category");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[]= [
        'id' => $row['category_id'],
        'text' => $row['category_name'],
    ];
}
echo json_encode($formattedOptions);


?>