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

if(isset($_POST['account_type'])) {

    try {
        $conn->beginTransaction();
        $account_type = $_POST['account_type'];
        $normal_balance = $_POST['normal_balance'];
        $description = $_POST['description'];
        $sql1 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_name = :account_name");
        
        $sql1->bindParam(":account_name", $account_type);
        if (!$sql1) {
            echo "No Statement Prepared";
        }
        $sql1->execute();
        $result = $sql1->fetchAll(PDO::FETCH_ASSOC);
    
        if ($result) {
            echo "Account Type Already Existing";
        } else {
            $sql2 = $conn->prepare("INSERT INTO tbl_account_type (account_type, normal_balance, type_description) VALUES (:account_type, :normal_balance, :t_description)");
           
            $sql2->bindParam("account_type", $account_type);
            $sql2->bindParam(":normal_balance", $normal_balance);
            $sql2->bindParam(":t_description", $description);
            if (!$sql2){
                echo "No Statement Prepared";
            } else {
                if ($sql2->execute()) {
                    echo "Success";
                    $last_id = $conn->lastInsertId();
                    $audit_description = "Added new account type: $account_type";
                    logAuditTrail($conn, 'tbl_account_type', $last_id, 'INSERT', $audit_description, $_SESSION['userid']);
                } else {
                    echo "Failed in Inserting Accounts";
                }
                    
            }
        }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

    
    

} else {
    echo "Values Not Set";
}

?>