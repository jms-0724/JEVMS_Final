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
if (isset($_POST['upd_code'])){

    try {
        $conn->beginTransaction();
        
        $upd_code = $_POST['upd_code'];
        $upd_name = $_POST['upd_name'];
        $upd_account_type = $_POST['upd_account_type'];
        $type_code = $_POST['account_group'];
        $upd_account_group = $_POST['account_class'];
        $upd_journal_category = $_POST['journal_category'];
        $sql1 = $conn->prepare("UPDATE tbl_account_title SET account_name = :account_name, account_type = :account_type, type_code = :type_code, class_id = :class_id, category_id = :category_id WHERE account_code = :account_code");
        $sql1->bindParam(':account_name', $upd_name);
        $sql1->bindParam(':account_type', $upd_account_type);
        $sql1->bindParam(':type_code', $type_code);
        $sql1->bindParam(':class_id', $upd_account_group);
        $sql1->bindParam(':account_code', $upd_code);
        $sql1->bindParam(':category_id', $upd_journal_category);

        $sql2 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_code = :account_code");
        $sql2->bindParam(':account_code', $upd_code);
        $sql2->execute();
        $rowcode = $sql2->fetch();
        $last_id = $rowcode['account_code'];

    
        if($sql1->execute()){
            if($sql1->rowCount() > 0){
                $audit_description = "Updated Account Title with code $upd_code";
                logAuditTrail($conn, 'tbl_account_title', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";
            } else {
                echo "No Rows Fetched";
            }
            
        } else {
            echo "Failed";
        }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
   


}
?>