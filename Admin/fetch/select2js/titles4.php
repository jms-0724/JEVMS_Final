<?php
// Connection to the database
require_once(__DIR__ . "/../../../connections/connection.php");

header('Content-Type: application/json'); // Ensure the correct response type

if (isset($_GET['term'])) {
    $search = "%" . $_GET['term'] . "%"; // Add wildcards for the LIKE query
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title 
                            INNER JOIN tbl_account_type 
                            ON tbl_account_title.type_code = tbl_account_type.type_code 
                            WHERE account_name LIKE ?");
    $stmt->bindParam(1, $search, PDO::PARAM_STR); // Bind the search term
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_title");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$formattedOptions = [];
foreach ($result as $row) {
    $formattedOptions[] = [
        'id' => $row['account_code'],
        'text' => $row['account_name'],
    ];
}

echo json_encode($formattedOptions);
?>
