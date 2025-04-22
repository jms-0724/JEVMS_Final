<?php
 session_start();
require(__DIR__ . "/../../connections/connection.php");

 // Function to log audit trail actions
 function logAuditTrail($conn, $tableModified, $idModified, $action, $description, $uid){
    $sqlaudit = $conn->prepare("INSERT INTO tbl_audit_log (table_modified, id_modified, audit_action, audit_description, uid, audit_timestamp) 
                        VALUES(:table_modified, :id_modified, :audit_action, :audit_description, :uid, NOW())");
    $sqlaudit->bindParam(':table_modified', $tableModified, PDO::PARAM_STR);
    $sqlaudit->bindParam(':id_modified', $idModified, PDO::PARAM_INT);
    $sqlaudit->bindParam(':audit_action', $action, PDO::PARAM_STR);
    $sqlaudit->bindParam(':audit_description', $description, PDO::PARAM_STR);
    $sqlaudit->bindParam(':uid', $uid, PDO::PARAM_INT);
    $sqlaudit->execute();
    }

if(isset($_POST['account_code'])) {

    $account_code = $_POST['account_code'];
    $account_name = $_POST['account_name'];
    $account_type = $_POST['account_type'];
    $account_group = $_POST['accountGroup'];
    // $journal_category = $_POST['journal_category2'];

    try {

        $conn->beginTransaction();

        $sql1 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_code = :account_code AND account_name = :account_name");
    $sql1->bindParam(":account_code", $account_code);
    $sql1->bindParam(":account_name", $account_name);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Title Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_account_title (account_code, account_name, account_type, type_code) VALUES (:accnt_code, :accnt_name, :account_type, :type_code)");
        $sql2->bindParam("accnt_code", $account_code);
        $sql2->bindParam("accnt_name", $account_name);
        $sql2->bindParam(":account_type", $account_type);
        $sql2->bindParam(":type_code",$account_group);
        
        
        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {

                $description = "Inserted new account title: $account_name with $account_code";
                logAuditTrail($conn, 'tbl_account_title', $conn->lastInsertId(), 'INSERT', $description, $_SESSION['userid']);
                
                $conn->commit();
                echo "Success";
            } else {
                echo "Failed in Inserting Accounts";
            }
                
        }

    }

    } catch (Exception $e){
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    

}

?>