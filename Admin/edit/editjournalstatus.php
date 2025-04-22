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

if (isset($_POST['jevID'])) {
    try {
        $conn->beginTransaction();
        
        $jev_id = $_POST['jevID'];
        $jev_status = $_POST['jevStatus'];
    $add_journal_date2 =  $_POST['add_journal_date2']; // Ensure correct date
    $jev_rejected = 'Rejected';
    $jev_approved = 'Approved';
    $jev_pending = 'Pending';

    // JEV approved
    $sql2 = $conn->prepare("UPDATE tbl_journal_entry SET journal_status = :jev_status WHERE journal_voucher_id = :jevID");
    $sql2->bindParam(':jev_status', $jev_approved);
    $sql2->bindParam(':jevID', $jev_id);
    
    // Jev Not Approved
    $sql3 = $conn->prepare("UPDATE tbl_journal_entry SET journal_status = :jev_status WHERE journal_voucher_id = :jevID");
    $sql3->bindParam(':jev_status', $jev_rejected);
    $sql3->bindParam(':jevID', $jev_id);

    // Jev Pending
    $sql4 = $conn->prepare("UPDATE tbl_journal_entry SET journal_status = :jev_status WHERE journal_voucher_id = :jevID");
    $sql4->bindParam(':jev_status', $jev_pending);
    $sql4->bindParam(':jevID', $jev_id);
    // Check if SQL2 executed successfully
    if ($jev_status === $jev_approved) {
        $sql2->execute();
        $audit_description = "Updated Journal Status of $jev_id";
        logAuditTrail($conn, 'tbl_user', $jev_id, 'UPDATE', $audit_description, $_SESSION['userid']);
        // Jev Approved
        $sql4 = $conn->prepare("SELECT * FROM tbl_journal_items INNER JOIN tbl_journal_entry ON tbl_journal_entry.journal_voucher_id = tbl_journal_items.journal_voucher_id WHERE tbl_journal_entry.journal_voucher_id = :jevID");
        $sql4->bindParam(":jevID", $jev_id);
        $sql4->execute();
        $journal_items = $sql4->fetchAll(PDO::FETCH_ASSOC);

        foreach ($journal_items as $item) {
            $account_code = $item['account_code'];
            $journal_amount = $item['journal_amount'];
            $journal_placement = $item['journal_adjustment'];
            $fiscal_id = $_SESSION['fiscal_id'];
            
            $add_journal_description = $item['description'];
            // Insert for Debit or Credit in General Ledger
            if ($journal_placement === 'Debit') {
                $sql3 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, debit, description, journal_voucher_id, fiscal_id) 
                                        VALUES (:ledger_date, :account_code, :debit, :description, :journal_voucher_id, :fiscal_id)");
                $sql3->bindParam(":ledger_date", $add_journal_date2);
                $sql3->bindParam(":account_code", $account_code);
                $sql3->bindParam(":debit", $journal_amount);
                $sql3->bindParam(":description", $add_journal_description);
                $sql3->bindParam(":journal_voucher_id", $jev_id);
                $sql3->bindParam(":fiscal_id", $fiscal_id);
                $sql3->execute();
                
                $last_id2 = $conn->lastInsertId();
                $audit_description = "Added new general ledger debit entry with account $account_code for journal voucher ID $jev_id";
                logAuditTrail($conn, 'tbl_general_ledger', $last_id2, 'ADD', $audit_description, $_SESSION['userid']);

                // Insert into Trial Balance
                $sql5 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_debit, trial_balance_date, fiscal_id) 
                                        VALUES (:ledger_id, :account_code, :total_debit, :trial_balance_date, :fiscal_id)");
                $sql5->bindParam(":ledger_id", $last_id2);
                $sql5->bindParam(":account_code", $account_code);
                $sql5->bindParam(":total_debit", $journal_amount);
                $sql5->bindParam(":trial_balance_date", $add_journal_date2);
                $sql5->bindParam(":fiscal_id", $fiscal_id);
                $sql5->execute();
            } elseif ($journal_placement === 'Credit') {
                $sql4 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, credit, description, journal_voucher_id, fiscal_id) 
                                        VALUES (:ledger_date, :account_code, :credit, :description, :journal_voucher_id, :fiscal_id)");
                $sql4->bindParam(":ledger_date", $add_journal_date2);
                $sql4->bindParam(":account_code", $account_code);
                $sql4->bindParam(":credit", $journal_amount);
                $sql4->bindParam(":description", $add_journal_description);
                $sql4->bindParam(":journal_voucher_id", $jev_id);
                $sql4->bindParam(":fiscal_id", $fiscal_id);
                $sql4->execute();

                $last_id2 = $conn->lastInsertId();
                $audit_description = "Added new general ledger credit entry with account $account_code for journal voucher ID $jev_id";
                logAuditTrail($conn, 'tbl_general_ledger', $last_id2, 'ADD', $audit_description, $_SESSION['userid']);

                // Insert into Trial Balance
                $sql6 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_credit, trial_balance_date, fiscal_id) 
                                        VALUES (:ledger_id, :account_code, :total_credit, :trial_balance_date, :fiscal_id)");
                $sql6->bindParam(":ledger_id", $last_id2);
                $sql6->bindParam(":account_code", $account_code);
                $sql6->bindParam(":total_credit", $journal_amount);
                $sql6->bindParam(":trial_balance_date", $add_journal_date2);
                $sql6->bindParam(":fiscal_id", $fiscal_id);
                $sql6->execute();
            }
        }

        $sqlselect = $conn->prepare("SELECT * FROM tbl_journal_entry WHERE journal_voucher_id = :jev_ID");
        $sqlselect->bindParam(":jev_ID", $jev_id);
        $sqlselect->execute();
        $dataselect = $sqlselect->fetch();
        $uid = $dataselect['uid'];
        $jevNUM = $dataselect['journal_voucher_no'];


        $notification_text = "Journal Entry Number $jevNUM  has been approved";
        $notification_status = "Unread";
        $sql4 = $conn->prepare("INSERT INTO tbl_notifications (notification_text, notification_status, datetime, uid) VALUES (:notify_text, :notify_status, NOW(), :uid)");
        $sql4->bindParam(":notify_text", $notification_text);
        $sql4->bindParam(":notify_status", $notification_status);
        $sql4->bindParam(":uid", $uid);
        $sql4->execute();
        $lastID = $conn->lastInsertId();

        $audit_description2 = "Inserted Notification  for Rejection of Journal Entry of $jevNUM";
        logAuditTrail($conn, 'tbl_user', $lastID, 'UPDATE', $audit_description2, $_SESSION['userid']);
        
        $conn->commit();
        echo "Success";
    } else if ($jev_status === $jev_rejected){
        $sql3->execute();


        $sqlselect = $conn->prepare("SELECT * FROM tbl_journal_entry WHERE journal_voucher_id = :jev_ID");
        $sqlselect->bindParam(":jev_ID", $jev_id);
        $sqlselect->execute();
        $dataselect = $sqlselect->fetch();
        $uid = $dataselect['uid'];
        $jevNUM = $dataselect['journal_voucher_no'];
        $jevID = $dataselect['journal_voucher_id'];


        $notification_text = "Journal Entry Number $jevNUM  has been rejected";
        $notification_status = "Unread";
        $sql4 = $conn->prepare("INSERT INTO tbl_notifications (notification_text, notification_status, datetime, uid) VALUES (:notify_text, :notify_status, NOW(), :uid)");
        $sql4->bindParam(":notify_text", $notification_text);
        $sql4->bindParam(":notify_status", $notification_status);
        $sql4->bindParam(":uid", $uid);
        $sql4->execute();
        $lastID = $conn->lastInsertId();

        $audit_description = "Inserted Notification  for Rejection of Journal Entry of $jevNUM";
        logAuditTrail($conn, 'tbl_user', $lastID, 'UPDATE', $audit_description, $_SESSION['userid']);
        $conn->commit();
        echo "JEV Entry is Rejected";
    } else if ($jev_status === $jev_pending){
        $sql4->execute();
        $audit_description = "Updated Fiscal Status of $fiscal_id";
        logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
        $conn->commit();
        echo "JEV Entry is still pending";
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
