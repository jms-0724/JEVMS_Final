<?php
session_start();
require(__DIR__ . "/../../connections/conn.php");
$fiscal_id = $_SESSION['fiscal_id'];
$datetoday = date('Y/m/d');

// Modify the SQL query to group by month and year
$sql = "SELECT COUNT(journal_voucher_no) AS count, 
               DATE_FORMAT(journal_date, '%Y-%m') AS month_year 
        FROM tbl_journal_entry 
        WHERE fiscal_id = $fiscal_id
        GROUP BY month_year 
        ORDER BY month_year"; // Optional: order by month

$result = $conn->query($sql);

$data = [];
$labels = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = $row['month_year']; // Store the month and year
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
