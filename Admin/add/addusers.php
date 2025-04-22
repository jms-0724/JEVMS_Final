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

if (!empty(trim($_POST['add_username'])) && !empty(trim($_POST['add_password'])) && !empty(trim($_POST['add_userlevel'])) &&
    !empty(trim($_POST['add_userfname'])) && !empty(trim($_POST['add_userlname'])) && !empty(trim($_POST['add_position']))) {

    try {
        $conn->beginTransaction();
        
        // Variable Declaration
        $add_username = trim($_POST['add_username']);
        $add_password = trim($_POST['add_password']);
        $add_userlevel = trim($_POST['add_userlevel']);
        $add_userfname = trim($_POST['add_userfname']);
        $add_usermname = trim($_POST['add_usermname']);
        $add_userlname = trim($_POST['add_userlname']);
        $add_position = trim($_POST['add_position']);

        $user_status = "Active";

        // SQL for SELECTING Existing User
        $sql1 = $conn->prepare("SELECT * FROM tbl_user WHERE username=?");
        $sql1->bindParam(1, $add_username, PDO::PARAM_STR);
        $sql1->execute();
        $result = $sql1->fetch();

        // Validates if Username is already existing 
        if ($result) {
            echo "Username already exists";
        } else {
            $sql3 = $conn->prepare("INSERT INTO tbl_user_info (user_fname, user_mname, user_lname, user_position) VALUES(?,?,?,?)");
            $sql3->bindParam(1, $add_userfname, PDO::PARAM_STR);
            $sql3->bindParam(2, $add_usermname, PDO::PARAM_STR);
            $sql3->bindParam(3, $add_userlname, PDO::PARAM_STR);
            $sql3->bindParam(4, $add_position, PDO::PARAM_STR);

            if ($sql3->execute()) {
                $add_user_info_id = $conn->lastInsertId();
                $audit_description = "Added new user named: $add_userfname on ID $add_user_info_id";
                logAuditTrail($conn, 'tbl_user_info', $add_user_info_id, 'ADD', $audit_description, $_SESSION['userid']);

                $sql2 = $conn->prepare("INSERT INTO tbl_user (username, password, userlevel, user_status, user_info_id) VALUES(?,?,?,?,?)");
                $hashedpassword = password_hash($add_password, PASSWORD_BCRYPT);
                $sql2->bindParam(1, $add_username, PDO::PARAM_STR);
                $sql2->bindParam(2, $hashedpassword, PDO::PARAM_STR);
                $sql2->bindParam(3, $add_userlevel, PDO::PARAM_STR);
                $sql2->bindParam(4, $user_status, PDO::PARAM_STR);
                $sql2->bindParam(5, $add_user_info_id, PDO::PARAM_INT);

                if ($sql2->execute()) {
                    $last_id = $conn->lastInsertId();
                    $audit_description = "Added new user with username $add_username";
                    logAuditTrail($conn, 'tbl_user', $last_id, 'ADD', $audit_description, $_SESSION['userid']);
                    echo "Success";
                    $conn->commit();
                } else {
                    echo "Failed in Inserting User";
                }
            } else {
                echo "Failed in Inserting User Info";
            }
        }
    } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    
} else {
    echo "All fields are required.";
}
?>
