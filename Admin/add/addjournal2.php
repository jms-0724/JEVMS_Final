<?php
session_start();
require(__DIR__ . "/../../connections/connection.php");

$data = file_get_contents('php://input');

$jsondecoded = json_decode($data, true);
$datetoday = date('Y/m/d');

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

if (isset($jsondecoded['add_journal_number'])) {

    $conn->beginTransaction();

    try {

        $sigID = $_SESSION['sigID'];
        $uid = $_SESSION['userid'];
        $add_journal_date = $datetoday;
        $add_journal_date2 = $jsondecoded['add_journal_date'];
        $add_journal_number = $jsondecoded['add_journal_number'];
        $add_journal_description = $jsondecoded['add_journal_description'];
        $add_journal_category = $jsondecoded['add_journal_category'];
        $fiscal_id = $_SESSION['fiscal_id'];
        $journal_status = "Pending";

        $sql1 = $conn->prepare("INSERT INTO tbl_journal_entry (journal_voucher_no, journal_date, description, category_id, uid, fiscal_id, journal_status) VALUES (:journal_voucher_no, :journal_date, :description, :category_id, :uid, :fiscal_id, :journal_status)");
        $sql1->bindParam(':journal_voucher_no', $add_journal_number);
        $sql1->bindParam(':journal_date', $add_journal_date2);
        $sql1->bindParam(':description', $add_journal_description);
        $sql1->bindParam(':category_id', $add_journal_category);
        $sql1->bindParam(':uid', $uid);
        $sql1->bindParam(':fiscal_id', $fiscal_id);
        $sql1->bindParam(':journal_status', $journal_status);
        
        
        if ($sql1->execute()) {
            $last_id = $conn->lastInsertId();
            $_SESSION['jevNumber'] = $last_id;  // Store the last inserted ID in session

            $audit_description = "Added new journal entry with voucher number $add_journal_number";
            logAuditTrail($conn, 'tbl_journal_entry', $last_id, 'INSERT', $audit_description, $_SESSION['userid']);
            

            // $descSQL = $conn->prepare("INSERT INTO tbl_description (desc_text) VALUES(:desc_text)");
            // $descSQL->bindParam(':desc_text', $add_journal_description);
            // $descSQL->execute();
            foreach ($jsondecoded['journal_array'] as $row) {
                $account_code = $row['account_code'];
                $journal_amount = $row['journal_amount'];
                $journal_placement = $row['journal_placement'];
                $sql2 = $conn->prepare("INSERT INTO tbl_journal_items (journal_voucher_id, account_code, journal_amount, journal_adjustment) VALUES (:last_id, :account_code, :journal_amount, :journal_placement)");
                $sql2->bindParam(":last_id", $last_id);
                $sql2->bindParam(":account_code", $account_code);
                $sql2->bindParam(":journal_amount", $journal_amount);
                $sql2->bindParam(":journal_placement", $journal_placement);

                if ($sql2->execute()) {
                    $last_id3 = $conn->lastInsertId(); //last ID for $sql2
                    $audit_description = "Added new journal items with $account_code";
                    logAuditTrail($conn, 'tbl_journal_items', $last_id3, 'INSERT', $audit_description, $_SESSION['userid']);

                    // // Do nothing here, just continue to the next iteration
                    // $dbt = "Debit";
                    // $crt = "Credit";

                    // // Insert for Debit
                    // $sql3 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, debit, description, journal_voucher_id, fiscal_id) VALUES(:ledger_date, :account_code, :debit, :description, :journal_voucher_id, :fiscal_id2)");
                    // $sql3->bindParam(":ledger_date", $add_journal_date2);
                    // $sql3->bindParam(":account_code", $account_code);
                    // $sql3->bindParam(":debit", $journal_amount);
                    // $sql3->bindParam(":description", $add_journal_description);
                    // $sql3->bindParam(":journal_voucher_id", $last_id);
                    // $sql3->bindParam(":fiscal_id2", $fiscal_id);

                   

                    // // Insert for Credit Legder
                    // $sql4 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, credit, description, journal_voucher_id, fiscal_id) VALUES(:ledger_date, :account_code, :credit, :description, :journal_voucher_id, :fiscal_id3)");
                    // $sql4->bindParam(":ledger_date", $add_journal_date2);
                    // $sql4->bindParam(":account_code", $account_code);
                    // $sql4->bindParam(":credit", $journal_amount);
                    // $sql4->bindParam(":description", $add_journal_description);
                    // $sql4->bindParam(":journal_voucher_id", $last_id);
                    // $sql4->bindParam(":fiscal_id3", $fiscal_id);
                                       
                    // if ($journal_placement === $dbt) {
                    //     $sql3->execute();
                    //     $last_id2 = $conn->lastInsertId();

                    //     $audit_description = "Added new general ledger items with $account_code with journal voucher ID $last_id";
                    //     logAuditTrail($conn, 'tbl_general_ledger', $last_id2, 'INSERT', $audit_description, $_SESSION['userid']);
                    //     // Insert for Debit Balance
                    // $sql5 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_debit, trial_balance_date, fiscal_id) VALUES(:ledger_id, :account_code, :total_debit, :trial_balance_date, :fiscal_id4)");
                    // $sql5->bindParam(":ledger_id", $last_id2);
                    // $sql5->bindParam(":account_code", $account_code);
                    // $sql5->bindParam(":total_debit", $journal_amount);
                    // $sql5->bindParam(":trial_balance_date", $add_journal_date2);
                    // $sql5->bindParam(":fiscal_id4", $fiscal_id);
                    // $sql5->execute();
                    // $last_id4 = $conn->lastInsertId(); //Last Inserted ID
                    // $audit_description = "Added new trial balance items with $account_code with journal voucher ID $last_id";
                    // logAuditTrail($conn, 'tbl_trial_balance', $last_id4, 'INSERT', $audit_description, $_SESSION['userid']);

                    // } elseif ($journal_placement  === $crt){
                    //     $sql4->execute();
                    //     $last_id2 = $conn->lastInsertId();

                    //     $audit_description = "Added new general ledger items with $account_code with journal voucher ID $last_id";
                    //     logAuditTrail($conn, 'tbl_general_ledger', $last_id2, 'INSERT', $audit_description, $_SESSION['userid']);
                    //      // Insert for credit balance
                    // $sql6 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_credit, trial_balance_date, fiscal_id) VALUES(:ledger_id, :account_code, :total_credit, :trial_balance_date, :fiscal_id5)");
                    // $sql6->bindParam(":ledger_id", $last_id2);
                    // $sql6->bindParam(":account_code", $account_code);
                    // $sql6->bindParam(":total_credit", $journal_amount);
                    // $sql6->bindParam(":trial_balance_date", $add_journal_date2);
                    // $sql6->bindParam(":fiscal_id5", $fiscal_id);
                    // $sql6->execute();
                        
                    // $last_id4 = $conn->lastInsertId(); //TRIAL BALANCE LAST INSERT ID
                    // $audit_description = "Added new trial balance items with $account_code with journal voucher ID $last_id";
                    // logAuditTrail($conn, 'tbl_trial_balance', $last_id4, 'INSERT', $audit_description, $_SESSION['userid']);
                        
                    // }

                } else {
                    // If any of the second query executions fail, roll back the transaction
                    $conn->rollBack();
                    echo "Failed";
                    exit(); // Terminate script execution
                }
            }

            // If all queries are successful, commit the transaction
            $conn->commit();
            echo "Success";
           
        } else {
            // If the first query execution fails, roll back the transaction
            $conn->rollBack();
            echo "Failed";
        }
    } catch (Exception $e) {
        // Catch any exceptions and roll back the transaction
        $conn->rollBack();
        echo "Transaction Failed" . $e->getMessage();
    }
} else {
    echo "Not Set";
}

?>
