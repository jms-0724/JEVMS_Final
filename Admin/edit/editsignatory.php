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

if (isset($_POST['sigID'])){

    try {
        $conn->beginTransaction();
        
        $sigID = $_POST['sigID'];
    $upd_sigfname = $_POST['upd_sigfname'];
    $upd_sigmname = $_POST['upd_sigmname'];
    $upd_siglname = $_POST['upd_siglname'];
    $upd_sigposition = $_POST['upd_sigposition'];
    
    $sql1 = $conn->prepare("UPDATE tbl_signatories SET signatory_fname = :user_fname, signatory_mname = :user_mname, signatory_lname = :user_lname, signatory_position = :user_position WHERE signatory_id = :sigID");
    $sql1->bindParam(":user_fname",$upd_sigfname);
    $sql1->bindParam(":user_mname", $upd_sigmname);
    $sql1->bindParam(":user_lname", $upd_siglname);
    $sql1->bindParam(":user_position", $upd_sigposition);
    $sql1->bindParam(":sigID",$sigID);

    $sql2 = $conn->prepare("SELECT * FROM tbl_signatories WHERE signatory_id = :uid");
    $sql2->bindParam(':uid', $sigID);
    $sql2->execute();
    $row = $sql2->fetch();
    $last_id = $row['signatory_id'];

    if (!$sql1){
        echo "No Statement Prepared";
    }
    if($sql1->execute()){
        if($sql1->rowCount() > 0 ){

            $audit_description = "Updated User ID $sigID";
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