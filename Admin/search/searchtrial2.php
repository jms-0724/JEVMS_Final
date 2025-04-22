<?php
session_start();
require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $fiscal_id = $_SESSION['fiscal_id'];
    $stmt = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
            ELSE 0 
        END) AS debit_balance, 
    SUM(CASE 
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
            ELSE 0 
        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_code LIKE '%$search%' OR account_name LIKE '%$search%' AND fiscal_id = :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
        $stmt->bindParam(':fiscal_id', $fiscal_id);
} else if (isset($_POST['fromDate2']) && isset($_POST['toDate2']) && !empty($_POST['fromDate2']) && !empty($_POST['toDate2'])){
    $fromDate2 = $_POST['fromDate2'];
    $toDate2 = $_POST['toDate2'];
    $fiscal_id = $_SESSION['fiscal_id'];
   $stmt = $conn->prepare("
    SELECT 
    tbl_account_title.account_code AS Acode, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included,
    SUM(tbl_trial_balance.total_debit) AS total_debit,
    SUM(tbl_trial_balance.total_credit) AS total_credit,
    SUM(CASE 
            WHEN tbl_trial_balance.total_debit > tbl_trial_balance.total_credit 
            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit 
            ELSE 0 
        END) AS debit_balance,
    SUM(CASE 
            WHEN tbl_trial_balance.total_credit > tbl_trial_balance.total_debit 
            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit 
            ELSE 0 
        END) AS credit_balance
FROM 
    tbl_account_title 
INNER JOIN 
    tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
INNER JOIN 
    tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
INNER JOIN 
    tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
WHERE 
    tbl_trial_balance.fiscal_id <= :fiscal_id
    AND (
        -- For balance sheet accounts, no date range is applied
        tbl_main_account_type.reports_included <> 'Income Statement'
        OR 
        -- For income statement accounts, apply the date range filter
        (tbl_main_account_type.reports_included = 'Income Statement' 
         AND tbl_trial_balance.trial_balance_date BETWEEN :fromdate2 AND :todate2)
    ) AND tbl_trial_balance.trial_balance_date <= :cutoff_date

GROUP BY 
    tbl_account_title.account_code, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included
");
        
        $stmt->bindParam(':fromdate2', $fromDate2);
        $stmt->bindParam(':todate2', $toDate2);
        $stmt->bindParam(':fiscal_id', $fiscal_id);
        $stmt->bindParam(':cutoff_date', $toDate2);

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

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $balancesheet = 'Balance Sheet';
// $stmt2 = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
//     SUM(CASE 
//             WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
//             WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
//             ELSE 0 
//         END) AS debit_balance, 
//     SUM(CASE 
//             WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
//             WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
//             ELSE 0 
//         END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code  INNER JOIN tbl_main_account_type ON tbl_main_account_type.main_type_id = tbl_account_type.main_type_id WHERE tbl_main_account_type.reports_included = :balancesheet AND fiscal_id = :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
//         $stmt2->bindParam(':balancesheet', $balancesheet);
//         $stmt->bindParam(':fiscal_id', $fiscal_id);


$stmt3 = $conn->prepare("SELECT MIN(start_date) AS min_date FROM tbl_fiscal_year");
$stmt3->execute();
$result3 = $stmt3->fetchColumn();
if ($result) {
    foreach ($result as $row){
        
        ?>
        <tr>
            <td><?=$row['Acode']?></td>
            <td><?=$row['account_name']?></td>
        
            <?php
                if($row['debit_balance']> $row['credit_balance']){
                ?>
                <td><?=$row['debit_balance']?></td>
                <td></td>

                <?php
                } else {
                    ?>
                    <td></td>
                    <td><?=$row['credit_balance']?></td>
                <?php    
                }
                
                ?>
                
            
        </tr>
        <?php
        
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>