<?php
// Connection to the database
require_once(__DIR__ . "/../../../connections/connection.php");

// Fetch data from query string
$term = isset($_GET['term']) ? $_GET['term'] : '';
$c_id = isset($_GET['c_id']) ? $_GET['c_id'] : null;

$query = "SELECT * FROM tbl_account_title 
          INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
          WHERE 1=1";

$params = [];

if ($term) {
    $query .= " AND account_name LIKE :term";
    $params[':term'] = "%$term%";
}

if ($c_id) {
    $query .= " AND tbl_account_title.category_id = :c_id";
    $params[':c_id'] = $c_id;
}

$stmt = $conn->prepare($query);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = array_map(function($row) {
    return [
        'id' => $row['account_code'],
        'text' => $row['account_name'],
        'account_code' => $row['account_code'],
        'account_type' => $row['account_type'],
        'normal_balance' => $row['normal_balance'],
    ];
}, $result);

echo json_encode(['results' => $formattedOptions]);
?>
