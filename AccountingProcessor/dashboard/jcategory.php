<?php
session_start();
require(__DIR__ . "/../../connections/conn.php");
$fiscal_id = $_SESSION['fiscal_id'];
$datetoday = date('Y/m/d');

// Modify the SQL query to group by month and year
$sql = "SELECT COUNT(journal_voucher_no) AS count, 
               tbl_journal_category.category_name as category_name
        FROM tbl_journal_entry 
        INNER JOIN tbl_journal_category ON tbl_journal_category.category_id = tbl_journal_entry.category_id
        GROUP BY category_name 
        ORDER BY category_name"; // Optional: order by month

$result = $conn->query($sql);

$data = [];
$labels = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['category_name']; // Store the month and year
        $data[] = $row['count'];         // Store the count
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
