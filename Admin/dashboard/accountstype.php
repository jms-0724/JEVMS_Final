<?php
require(__DIR__ . "/../../connections/conn.php");

$datetoday = date('Y/m/d');
$sql = "SELECT COUNT(account_name) as count, account_type FROM tbl_account_title GROUP BY account_type";
$result = $conn->query($sql);

$data = [];
$labels = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['account_type'];
        $data[] = $row['count'];
    }
} else {
    echo "0 results";
}

$conn->close();
// Prepare data for JSON response
$response = [
    'labels' => $labels,
    'data' => $data
];

// Return the JSON response
header('Content-Type: application/json');
echo json_encode($response);


?> 