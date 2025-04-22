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

if (isset($_POST['users'])){

    try {
        $conn->beginTransaction();
        
        $users = $_POST['users'];
        $archived = $_POST['archived'];
    
        $sql1 = $conn->prepare("UPDATE tbl_user SET user_status = :userstatus WHERE username = :username");
        $sql1->bindParam(':userstatus', $archived);
        $sql1->bindParam(':username', $users);
    
        if (!$sql1) {
            echo "No Statement Prepared";
        } else {
            if($sql1->execute()){
               
                $sql2 = $conn->prepare("SELECT * FROM tbl_user WHERE username = :username");
                $sql2->bindParam(':username', $users);
                $sql2->execute();
                $userid = $sql2->fetch(PDO::FETCH_ASSOC);
                $last_id = $userid['uid'];
                $audit_description = "Updated Status of $users";
                logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";

            } else {
                echo "Failed";
                
            }
        }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }

   
}
?>