<?php

session_start();
require(__DIR__ . "/../../connections/connection.php");

function logAuditTrail($conn, $tableModified, $idModified, $action, $description, $uid) {
    $sqlaudit = $conn->prepare("INSERT INTO tbl_audit_log (table_modified, id_modified, audit_action, audit_description, uid, audit_timestamp) 
                    VALUES(:table_modified, :id_modified, :audit_action, :audit_description, :uid, NOW())");
    $sqlaudit->bindParam(':table_modified', $tableModified, PDO::PARAM_STR);
    $sqlaudit->bindParam(':id_modified', $idModified, PDO::PARAM_INT);
    $sqlaudit->bindParam(':audit_action', $action, PDO::PARAM_STR);
    $sqlaudit->bindParam(':audit_description', $description, PDO::PARAM_STR);
    $sqlaudit->bindParam(':uid', $uid, PDO::PARAM_INT);
    $sqlaudit->execute();
}

if (isset($_POST['fiscal_desc'])) {
    try {
        $conn->beginTransaction();
        
        $stmtTrial = $conn->prepare("SELECT 
        tbl_account_title.account_code AS Acode, 
        tbl_account_title.account_name, 
        tbl_main_account_type.reports_included,
        SUM(tbl_trial_balance.total_debit) AS total_debit,
        SUM(tbl_trial_balance.total_credit) AS total_credit,
        -- Calculate the net balance (credit minus debit for revenues, debit minus credit for expenses)
        CASE 
            WHEN tbl_main_account_type.reports_included = 'Income Statement' AND tbl_main_account_type.account_type = 'Income' THEN 
                SUM(tbl_trial_balance.total_credit) - SUM(tbl_trial_balance.total_debit)
            WHEN tbl_main_account_type.reports_included = 'Income Statement' AND tbl_main_account_type.account_type = 'Less:Expenses' THEN 
                SUM(tbl_trial_balance.total_debit) - SUM(tbl_trial_balance.total_credit)
            ELSE 0 
        END AS net_balance
    FROM 
        tbl_account_title 
    INNER JOIN 
        tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
    INNER JOIN 
        tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
    INNER JOIN 
        tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
    WHERE 
        tbl_trial_balance.fiscal_id = :fiscal_id
        AND tbl_main_account_type.reports_included = 'Income Statement' OR tbl_account_title.account_code = '30701010'
    GROUP BY 
        tbl_account_title.account_code, 
        tbl_account_title.account_name,     
        tbl_main_account_type.reports_included,
        tbl_account_type.type
");

$stmtTrial->bindParam(':fiscal_id', $fiscal_id);

$stmtTrial->bindParam(':fiscal_id', $fiscal_id);
$stmtTrial->execute();
$dataTrial = $stmtTrial->fetchAll(PDO::FETCH_ASSOC);

$sqllast = $conn->prepare("SELECT journal_voucher_no
FROM tbl_journal_entry
ORDER BY CAST(SUBSTRING(journal_voucher_no, 1, 2) AS UNSIGNED) DESC, 
         CAST(SUBSTRING(journal_voucher_no, INSTR(journal_voucher_no, '-') + 1) AS UNSIGNED) DESC
LIMIT 1;
");
$sqllast->execute();
$datalast = $sqllast->fetch(PDO::FETCH_ASSOC);

$journal_voucher_no = $datalast['journal_voucher_no'];
$uid = $_SESSION['userid'];
$description = "Closing entries for the current year";
$category_id = 6;
$journal_date = date('Y/m/d');
$fiscal_id = $_SESSION['fiscal_id'];

// Insert the journal entry header
$sql1 = $conn->prepare("INSERT INTO tbl_journal_entry (journal_voucher_no, journal_date, description, category_id, uid, fiscal_id) 
VALUES (:journal_voucher_no, :journal_date, :description, :category_id, :uid, :fiscal_id)");
$sql1->bindParam(':journal_voucher_no', $journal_voucher_no);
$sql1->bindParam(':journal_date', $journal_date);
$sql1->bindParam(':description', $description);
$sql1->bindParam(':category_id', $category_id);
$sql1->bindParam(':uid', $uid);
$sql1->bindParam(':fiscal_id', $fiscal_id);
$sql1->execute();
$last_id = $conn->lastInsertId(); // Get the journal entry ID


     foreach ($dataTrial as $rowtrial) {
        $account_code = $row['Acode'];
        $net_balance = $row['net_balance'];


         // Insert journal item to close income/expense accounts
        $sql2 = $conn->prepare("INSERT INTO tbl_journal_items (journal_voucher_id, account_code, journal_amount, journal_adjustment) 
        VALUES (:journal_voucher_id, :account_code, :journal_amount, :journal_placement)");

        $sql2->bindParam(':journal_voucher_id', $last_id);
        $sql2->bindParam(':account_code', $account_code);
        $sql2->bindParam(':journal_amount', abs($net_balance));

        if ($rowtrial['account_type'] == 'Income') {
            // Credit income accounts, Debit retained earnings
            $journal_placement = 'Credit';
            $retained_earnings_placement = 'Debit';
        } else {
            // Debit expense accounts, Credit retained earnings
            $journal_placement = 'Debit';
            $retained_earnings_placement = 'Credit';
        }
    
        $sql2->bindParam(':journal_placement', $journal_placement);
        $sql2->execute();
    
        // Insert the opposite entry for Retained Earnings
        $retained_earnings_account = '30701010'; // Example retained earnings account
        $sql3 = $conn->prepare("INSERT INTO tbl_journal_items (journal_voucher_id, account_code, journal_amount, journal_adjustment) 
        VALUES (:journal_voucher_id, :account_code, :journal_amount, :journal_placement)");
        
        $sql3->bindParam(':journal_voucher_id', $last_id);
        $sql3->bindParam(':account_code', $retained_earnings_account);
        $sql3->bindParam(':journal_amount', abs($net_balance));
        $sql3->bindParam(':journal_placement', $retained_earnings_placement);
        $sql3->execute();


     }


        $current_fiscid = $_SESSION['fiscal_id'];
        $fiscal_id = $_POST['fiscal_desc'];
        $fiscal_status = $_POST['upd_status'];
        
        $fiscal_closed = "Closed";
        $fiscal_active = "Active";
        $fiscal_inactive = "Inactive";

        // First, set the specified fiscal year to "Closed"
        $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalclosed WHERE fiscal_id = :fiscal_id");
        $sql2->bindParam(':fiscalclosed', $fiscal_closed);
        $sql2->bindParam(':fiscal_id', $current_fiscid);

    // Check if SQL2 executed successfully
    if ($sql2->execute()) {
        
        if ($fiscal_status === $fiscal_inactive){
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
            $sql1->bindParam(':fiscalstatus', $fiscal_active);
            $sql1->bindParam(':fiscal_id', $fiscal_id);
            $last_id = $conn->lastInsertId();
        } else if ($fiscal_status === $fiscal_active) {
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
            $sql1->bindParam(':fiscalstatus', $fiscal_inactive);
            $sql1->bindParam(':fiscal_id', $fiscal_id);
            $last_id = $conn->lastInsertId();
        }

        if ($sql1->execute()) {
            
            // If the update was successful, check for an active fiscal year
            $sql3 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :fisc_status");
            $sql3->bindParam(':fisc_status', $fiscal_active);
            $sql3->execute();
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC);

            if ($row3) {
                $_SESSION['fiscal_id'] = $row3['fiscal_id'];
                $_SESSION['fiscal_name'] = $row3['description'];
                $_SESSION['start_date'] = $row3['start_date'];

                $audit_description = "Updated Fiscal Status of $fiscal_id";
                logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";
            } else {
                echo "No active fiscal year found.";
            }
            
        } else {
            echo "Failed to update fiscal year.";
        }

    } else {
        echo "Failed to set fiscal years to inactive.";
    }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    
    
} else {
    echo "No data provided.";
}

?>
