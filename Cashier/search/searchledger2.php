<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

// Initialize the fiscal ID from session
$fiscal_id = $_SESSION['fiscal_id'];

// Initialize the statement variable
$stmt = null;

// Check for search parameter
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $stmt = $conn->prepare("
        SELECT ledger_date, tbl_general_ledger.description, tbl_journal_entry.journal_voucher_no AS journal_voucher_no, credit, debit 
        FROM tbl_general_ledger 
        INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
        INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
        WHERE account_name LIKE :search AND tbl_general_ledger.fiscal_id = :fiscal_id 
        ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC
    ");
    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
    $stmt->bindParam(':fiscal_id', $fiscal_id);
} 
// Check for fromFilter
else if (isset($_POST['fromFilter'])) {
    $filter = $_POST['fromFilter'];
    $stmt = $conn->prepare("
        SELECT ledger_date, tbl_general_ledger.description, tbl_journal_entry.journal_voucher_no AS journal_voucher_no, credit, debit 
        FROM tbl_general_ledger 
        INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
        INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
        WHERE tbl_account_title.account_code = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id 
        ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC
    ");
    $filter2 = 10101010;
    $stmt->bindParam(":filters", $filter);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} 
// Check for date range
else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3'])) {
    $fromDate = $_POST['fromDate3'];
    $toDate = $_POST['toDate3'];
    $stmt = $conn->prepare("
        SELECT ledger_date, tbl_general_ledger.description, tbl_journal_entry.journal_voucher_no AS journal_voucher_no, credit, debit 
        FROM tbl_general_ledger 
        INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
        INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
        WHERE ledger_date BETWEEN :fromDate AND :toDate AND tbl_general_ledger.fiscal_id = :fiscal_id 
        ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC
    ");
    $stmt->bindParam(":fromDate", $fromDate);
    $stmt->bindParam(":toDate", $toDate);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} 
// Check for date range with a filter
else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3']) && isset($_POST['fromFilter'])) {
    $filter = $_POST['fromFilter'];
    $fromDate = $_POST['fromDate3'];
    $toDate = $_POST['toDate3'];
    $stmt = $conn->prepare("
        SELECT ledger_date, tbl_general_ledger.description, tbl_journal_entry.journal_voucher_no AS journal_voucher_no, credit, debit 
        FROM tbl_general_ledger 
        INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
        INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
        WHERE ledger_date BETWEEN :fromDate AND :toDate AND account_code = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id 
        ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC
    ");
    $stmt->bindParam(":fromDate", $fromDate);
    $stmt->bindParam(":toDate", $toDate);
    $stmt->bindParam(":filters", $filter);
    $stmt->bindParam(":fiscal_id", $fiscal_id);
} 
// Default case: no filters applied
else {
    $stmt = $conn->prepare("SELECT ledger_date, tbl_general_ledger.description, tbl_journal_entry.journal_voucher_no AS journal_voucher_no, credit, debit FROM tbl_general_ledger WHERE fiscal_id = :fiscal_id");
    $stmt->bindParam(":fiscal_id", $fiscal_id);
}

// Execute the statement and handle potential errors
try {
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display results in a table
    if ($result) {
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['ledger_date']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['journal_voucher_no']}</td>";
            echo $row['debit'] > $row['credit'] ? "<td>{$row['debit']}</td><td></td>" : "<td></td><td>{$row['credit']}</td>";
            echo "</tr>";
        }
    } else {
        echo '<tr><td colspan="5">No Records Found</td></tr>';
    }
} catch (PDOException $e) {
    echo '<tr><td colspan="5">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
}

// // Debugging: Uncomment to see $_POST values
// echo '<pre>' . print_r($_POST, true) . '</pre>';
?>
