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

if (isset($_POST['upd_username'])){

    try {
        $conn->beginTransaction();

        $uid = $_POST['uid'];
    $username = $_POST['upd_username'];
    $password = $_POST['upd_password'];
    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
    $userlevel = $_POST['upd_userlevel'];
    $sql1 = $conn->prepare("UPDATE tbl_user SET username = :username, password = :password, userlevel = :userlevel WHERE uid = :uid");
    $sql1->bindParam(':username', $username);
    $sql1->bindParam(':password', $hashedpassword);
    $sql1->bindParam(':userlevel', $userlevel);
    $sql1->bindParam(':uid', $uid);

    $sql2 = $conn->prepare("SELECT * FROM tbl_user WHERE uid = :uid");
    $sql2->bindParam(':uid', $uid);
    $sql2->execute();
    $row = $sql2->fetch(PDO::FETCH_ASSOC);
    $last_id = $row['class_id'];


    if($sql1->execute()){
        if($sql1->rowCount() > 0){
            $audit_description = "Updated User ID $uid";
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