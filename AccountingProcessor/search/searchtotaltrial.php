<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');
// Handle search logic
$fiscal_id = $_SESSION['fiscal_id'];
$current_fiscal_year = $fiscal_id; // Adjust this if your fiscal year is determined differently\
if (isset($_POST['search'])) {
    $fiscal_id = $_SESSION['fiscal_id'];
$search = $_POST['search'] ?? ''; // Ensure $search is set to an empty string if not present

// Prepare the SQL statement
$stmt = $conn->prepare("
    SELECT tbl_account_title.account_code AS Acode, 
           tbl_account_title.account_name, 
           tbl_main_account_type.reports_included,
           SUM(CASE 
                   WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                   ELSE 0 
               END) AS debit_balance, 
           SUM(CASE 
                   WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                   ELSE 0 
               END) AS credit_balance 
    FROM tbl_account_title 
    INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
    INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
    INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
    WHERE tbl_trial_balance.fiscal_id <= :fiscal_id 
    AND (tbl_account_title.account_code LIKE :search OR tbl_account_title.account_name LIKE :search) 
    GROUP BY tbl_account_title.account_code, tbl_account_title.account_name, tbl_main_account_type.reports_included 
    ORDER BY tbl_account_title.account_code
");

// Prepare the search parameter
$search = "%$search%";
$stmt->bindParam(':search', $search);
$stmt->bindParam(':fiscal_id', $fiscal_id);
}  elseif (isset($_POST['fromDate2']) && !empty($_POST['fromDate2']) && isset($_POST['toDate2']) && !empty($_POST['toDate2'])) {
    $fromDate2 = $_POST['fromDate2'];
    $toDate2 = $_POST['toDate2'];
    $stmt = $conn->prepare(" SELECT tbl_account_title.account_code AS Acode, 
           tbl_account_title.account_name, 
           tbl_main_account_type.reports_included,
           SUM(CASE 
                   WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                   ELSE 0 
               END) AS debit_balance, 
           SUM(CASE 
                   WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                   ELSE 0 
               END) AS credit_balance 
    FROM tbl_account_title 
    INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
    INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
    INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
   WHERE tbl_trial_balance.fiscal_id <= :fiscal_id
    AND (
        -- For balance sheet accounts, no date range is applied
        tbl_main_account_type.reports_included <> 'Income Statement'
        OR 
        -- For income statement accounts, apply the date range filter
        (tbl_main_account_type.reports_included = 'Income Statement' 
         AND tbl_trial_balance.trial_balance_date BETWEEN :fromdate2 AND :todate2)
    ) AND tbl_trial_balance.trial_balance_date <= :cutoff_date 
     GROUP BY tbl_account_title.account_code, tbl_account_title.account_name, tbl_main_account_type.reports_included 
          ORDER BY tbl_account_title.account_code");

      $stmt->bindParam(':fromdate2', $fromDate2);
      $stmt->bindParam(':todate2', $toDate2);
      $stmt->bindParam(':cutoff_date', $toDate2);   
      $stmt->bindParam(':fiscal_id', $fiscal_id); 
} else {
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, 
           tbl_account_title.account_name, 
           tbl_main_account_type.reports_included,
           SUM(CASE 
                   WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                   ELSE 0 
               END) AS debit_balance, 
           SUM(CASE 
                   WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                   ELSE 0 
               END) AS credit_balance 
    FROM tbl_account_title 
    INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
    INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
    INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
    WHERE fiscal_id <= :fiscal_id  GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
        $stmt->bindParam(':fiscal_id', $fiscal_id);
}


// Execute and fetch results
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalDebit = 0;
$totalCredit = 0;

// Display results
if ($result) {
    foreach ($result as $row) {

         // Calculate debit and credit amounts for each row
         $debitAmount = ($row['debit_balance'] > $row['credit_balance']) ? $row['debit_balance'] - $row['credit_balance'] : 0;
         $creditAmount = ($row['credit_balance'] > $row['debit_balance']) ? $row['credit_balance'] - $row['debit_balance'] : 0;
 
         // Accumulate totals
         $totalDebit += $debitAmount;
         $totalCredit += $creditAmount;
        ?>
        <?php
    }
    ?>
        <tr>
            <td>Total</td>
            <td></td>
            <td><strong><?= number_format($totalDebit, 2) ?></strong></td>
            <td><strong><?= number_format($totalCredit, 2) ?></strong></td>
        </tr>
    <?php 
} else {
    ?>
    <tr>
        <td colspan="4">No Records Found</td>
    </tr>
    <?php
} 
?>

<?php


?>
