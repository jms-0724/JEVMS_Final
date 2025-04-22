<?php
// Connection to the database
require_once(__DIR__ . "/../../../connections/connection.php");    

if(isset($_GET['term'])){
    $search = $_GET['term'];
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE description LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[]= [
        'id' => $row['fiscal_id'],
        'text' => $row['description'],
    ];
}
echo json_encode($formattedOptions);


?>