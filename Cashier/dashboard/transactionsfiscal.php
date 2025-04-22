<?php
session_start();
require(__DIR__ . "/../../connections/conn.php");
$fiscal_id = $_SESSION['fiscal_id'];
$datetoday = date('Y/m/d');

// Modify the SQL query to group by month and year
$sql = "SELECT COUNT(journal_voucher_no) AS count, 
               tbl_fiscal_year.description as fiscal_desc
        FROM tbl_journal_entry 
        INNER JOIN tbl_fiscal_year ON tbl_fiscal_year.fiscal_id = tbl_journal_entry.fiscal_id
        GROUP BY fiscal_desc 
        ORDER BY fiscal_desc"; // Optional: order by month

$result = $conn->query($sql);

$data = [];
$labels = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['fiscal_desc']; // Store the month and year
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
