<?php
session_start();
require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['add_group'])) {

    // Function to log audit trail actions
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

    try {
        $conn->beginTransaction();
        
        $add_group = $_POST['add_group'];
        $add_description = $_POST['add_description'];
        $add_types = $_POST['add_types'];

        // Check if account class already exists
        $sql1 = $conn->prepare("SELECT * FROM tbl_account_class WHERE class_name = :class_name");
        $sql1->bindParam(":class_name", $add_group);
        $sql1->execute();
        $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            echo "Account Category Already Existing";
        } else {
            // Insert new account class
            $sql2 = $conn->prepare("INSERT INTO tbl_account_class (class_name, description, type_code) VALUES (:class_name, :description, :type_code)");
            $sql2->bindParam(":class_name", $add_group);
            $sql2->bindParam(":description", $add_description);
            $sql2->bindParam(":type_code", $add_types);

            if ($sql2->execute()) {
                echo "Success";
                $description = "Inserted new account group: $add_group";
                logAuditTrail($conn, 'tbl_account_group', $conn->lastInsertId(), 'INSERT', $description, $_SESSION['userid']);
                $conn->commit();
            } else {
                echo "Failed in Inserting Accounts";
                $conn->rollBack(); // Rollback in case of failure
            }
        }
    } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

?>
