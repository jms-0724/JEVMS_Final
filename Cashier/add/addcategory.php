<?php
 session_start();
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_category'])) {

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
   try {
    $conn->beginTransaction();

    $category_name = $_POST['add_category'];
    $category_description = $_POST['add_category_description'];
    $sql1 = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_name = :category_name");
    $sql1->bindParam(":category_name", $category_name);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Category Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_journal_category (category_name, category_description) VALUES (:c_name, :c_description)");
        $sql2->bindParam("c_name", $category_name);
        $sql2->bindParam(":c_description", $category_description);
        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {
                $description = "Inserted new journal category: $category_name";
                logAuditTrail($conn, 'tbl_journal_category', $conn->lastInsertId(), 'INSERT', $description, $_SESSION['userid']);

                echo "Success";
                $conn->commit();
            } else {
                echo "Failed in Inserting Accounts";
            }
                
        }
    }

   }  catch (Exception $e) {
    // Rollback if an exception occurs
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}
    

}

?>