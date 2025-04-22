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
if (isset($_POST['grpID'])){

    try {
        $conn->beginTransaction();
        
    $grpID = $_POST['grpID'];
    $upd_group_name = $_POST['upd_category'];
    $upd_group_description = $_POST['upd_description2'];
    $upd_account_type2 = $_POST['upd_account_type2'];
    
    $sql1 = $conn->prepare("UPDATE tbl_account_class SET class_name = :class_name, description = :description, type_code = :type_code WHERE class_id = :class_id");
    $sql1->bindParam(':class_id', $grpID);
    $sql1->bindParam(':class_name', $upd_group_name);
    $sql1->bindParam(':description', $upd_group_description);
    $sql1->bindParam(':type_code', $upd_account_type2);
   
    $sql2 = $conn->prepare("SELECT * FROM tbl_account_class WHERE class_id = :class_id");
    $sql2->bindParam(':class_id', $grpID);
    $sql2->execute();
    $row = $sql2->fetch();
    $last_id = $row['class_id'];

    if($sql1->execute()){
        if($sql1->rowCount() > 0){
            $audit_description = "Updated Account Group ID $grpID";
            logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
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