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
if (isset($_POST['typeCode'])){

    try {
        $conn->beginTransaction();
        
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

    $type_code = $_POST['typeCode'];
    $upd_account_type = $_POST['upd_type'];
    $upd_normal_balance = $_POST['upd_normal_balance'];
    $upd_type_description = $_POST['upd_description'];
    $sql1 = $conn->prepare("UPDATE tbl_account_type SET account_type = :account_type, normal_balance = :normal_balance, type_description = :type_description WHERE type_code = :type_code");
    $sql1->bindParam(':account_type', $upd_account_type);
    $sql1->bindParam(':normal_balance', $upd_normal_balance);
    $sql1->bindParam(':type_description', $upd_type_description);
    $sql1->bindParam(':type_code', $type_code);

    $sql2 = $conn->prepare("SELECT * FROM tbl_account_type WHERE type_code = :type_code");
    $sql2->bindParam(':type_code', $type_code);
    $sql2->execute();
    $row = $sql2->fetch(PDO::FETCH_ASSOC);
    $last_id = $row['type_code'];


    if($sql1->execute()){
        if($sql1->rowCount() > 0){
            $audit_description = "Updated Type ID $type_code";
            logAuditTrail($conn, 'tbl_account_type', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
            $conn->commit();
            echo "Success";
        } else {
            echo "No Rows Fetched";
        }
        
    } else {
        echo "Failed";
    }


}
?>