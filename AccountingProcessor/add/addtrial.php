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
if(isset($_POST['add_journal_title2'])) {

    
    try {

        $conn->beginTransaction();
        
        $datetoday = $datetoday = date('Y/m/d');
        $add_journal_title2 = $_POST['add_journal_title2'];
        $add_balance_type = $_POST['add_balance_type'];
        $add_start_balance = $_POST['add_start_balance'];
        $ledger_id = 0;
        $fiscal_id = $_SESSION['fiscal_id'];
        
        
            $sql3 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_debit, trial_balance_date, fiscal_id) VALUES (:a_code, :t_debit, :t_date, :fiscal_id)");
            
            $sql3->bindParam("a_code",$add_journal_title2);
            $sql3->bindParam("t_date",$datetoday);
            $sql3->bindParam("t_debit",$add_start_balance);
            $sql3->bindParam("fiscal_id",$fiscal_id);
    
    
    
            $sql2 = $conn->prepare("INSERT INTO tbl_trial_balance (account_code, total_credit, trial_balance_date, fiscal_id) VALUES (:a_code, :t_credit :t_date, :fiscal_id2)");
            $sql2->bindParam("a_code",$add_journal_title2);
            $sql2->bindParam("t_date",$datetoday);
            $sql2->bindParam("t_credit",$add_start_balance);
            $sql3->bindParam("fiscal_id2",$fiscal_id);
    
    
            if (!$sql2){
                echo "No Statement Prepared";
            } else {
                if ($add_balance_type = "Debit") {
                    $sql3->execute();
                    echo "Success";

                    $audit_description = "Added new trial balance entry with voucher number $add_journal_number";
                    logAuditTrail($conn, 'tbl_trial_balance', $conn->lastInsertId(), 'INSERT', $audit_description, $_SESSION['userid']);
                
                } elseif  ($add_balance_type = "Credit"){
                    $sql2->execute();
                    echo "Success";

                    $audit_description = "Added new trial balance entry with voucher number $add_journal_number";
                    logAuditTrail($conn, 'tbl_trial_balance', $conn->lastInsertId(), 'INSERT', $audit_description, $_SESSION['userid']);
                } else {
                    echo "Invalid Balance Type";
                }
                    
            }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

   
    

}

?>