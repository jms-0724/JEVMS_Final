<?php
// Connection to the database
require_once(__DIR__ . "/../connections/connection.php");

if(isset($_GET['term'])){
    $search = $_GET['term'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type WHERE account_type LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_type");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[]= [
        'id' => $row['type_code'],
        'text' => $row['account_type'],
    ];
}
echo json_encode($formattedOptions);
?>