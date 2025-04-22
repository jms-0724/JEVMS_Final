<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

// Log incoming POST data for debugging
error_log("Incoming POST data: " . json_encode($_POST));

$fiscal_id = $_SESSION['fiscal_id'];

try {
    // Initialize statement variable
    $stmt = null;

    // Check for different filtering criteria
    if (isset($_POST['search'])) {
        
        $search = trim($_POST['search']); // Trim whitespace
        $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger 
            INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
            INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
            WHERE account_name LIKE :search AND tbl_general_ledger.fiscal_id = :fiscal_id 
            ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC");
        $searchParam = "%$search%"; // Prepare search parameter
        $stmt->bindParam(':search', $searchParam);
        $stmt->bindParam(':fiscal_id', $fiscal_id);
    }   else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3']) && isset($_POST['fromFilter'])) {
        $filter = trim($_POST['fromFilter']);
        $fromDate = $_POST['fromDate3'];
        $toDate = $_POST['toDate3'];
        $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger 
            INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
            INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
            WHERE ledger_date BETWEEN :fromDate AND :toDate AND account_code = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id 
            ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC");
        $stmt->bindParam(":fromDate", $fromDate);
        $stmt->bindParam(":toDate", $toDate);
        $stmt->bindParam(":filters", $filter);
        $stmt->bindParam(":fiscal_id", $fiscal_id);
    } else if (isset($_POST['fromDate3']) && isset($_POST['toDate3']) && !empty($_POST['fromDate3']) && !empty($_POST['toDate3'])) {
        error_log("Filter by date range triggered."); // Debug log
        $fromDate = $_POST['fromDate3'];
        $toDate = $_POST['toDate3'];
        $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger 
            INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
            INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
            WHERE ledger_date BETWEEN :fromDate AND :toDate AND tbl_general_ledger.fiscal_id = :fiscal_id 
            ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC");
        $stmt->bindParam(":fromDate", $fromDate);
        $stmt->bindParam(":toDate", $toDate);
        $stmt->bindParam(":fiscal_id", $fiscal_id);
    } else if (isset($_POST['fromFilter'])) {
        $filter = trim($_POST['fromFilter']);
        $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger 
            INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
            INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
            WHERE account_code = :filters AND tbl_general_ledger.fiscal_id = :fiscal_id 
            ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC");
        $stmt->bindParam(":filters", $filter);
        $stmt->bindParam(":fiscal_id", $fiscal_id);
    } else {

        $stmt = $conn->prepare("SELECT * FROM tbl_general_ledger 
            INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code 
            INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id WHERE  tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY ledger_date DESC, tbl_journal_entry.journal_voucher_no DESC");
        $stmt->bindParam(":fiscal_id", $fiscal_id);
    }

    // Execute the statement
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check and display results
    if ($result) {
        foreach ($result as $row) {
            ?>
            <tr>
                <td><?= htmlspecialchars($row['ledger_date']) ?></td>
                <td><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['journal_voucher_no']) ?></td>
                <?php
                if ($row['debit'] > $row['credit']) {
                    ?>
                    <td><?= htmlspecialchars($row['debit']) ?></td>
                    <td></td>
                    <?php
                } else {
                    ?>
                    <td></td>
                    <td><?= htmlspecialchars($row['credit']) ?></td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">No Records Found</td>
        </tr>
        <?php 
    }
} catch (PDOException $e) {
    // Handle any errors
    error_log("Database error: " . $e->getMessage());
    echo "<tr><td colspan='5'>An error occurred. Please try again later.</td></tr>";
}
?>
