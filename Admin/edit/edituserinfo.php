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

if (isset($_POST['upd_userfname'])){

    try {
        $conn->beginTransaction();
        
        $uid = $_POST['uID'];
    $upd_userfname = $_POST['upd_userfname'];
    $upd_usermname = $_POST['upd_usermname'];
    $upd_userlname = $_POST['upd_userlname'];
    $upd_position = $_POST['upd_position'];
    
    $sql1 = $conn->prepare("UPDATE tbl_user_info SET user_fname = :user_fname, user_mname = :user_mname, user_lname = :user_lname, user_position = :user_position WHERE user_info_id = :user_info_id");
    $sql1->bindParam(":user_fname",$upd_userfname);
    $sql1->bindParam(":user_mname", $upd_usermname);
    $sql1->bindParam(":user_lname", $upd_userlname);
    $sql1->bindParam(":user_position", $upd_position);
    $sql1->bindParam(":user_info_id",$uid);

    $sql2 = $conn->prepare("SELECT * FROM tbl_user_info WHERE uid = :uid");
    $sql2->bindParam(':uid', $uid);
    $sql2->execute();
    $row = $sql2->fetch();
    $last_id = $row['user_info_id'];

    if (!$sql1){
        echo "No Statement Prepared";
    }
    if($sql1->execute()){
        if($sql1->rowCount() > 0 ){

            $audit_description = "Updated User ID $uid";
            logAuditTrail($conn, 'tbl_user_info', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
            $conn->commit();
            echo "Success";
        } else {
            echo "No Rows Updated";
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