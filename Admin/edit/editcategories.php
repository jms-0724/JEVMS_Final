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
$fiscal_id = $_SESSION['fiscal_id'];

if (isset($_POST['cCode'])){

    try {
        $conn->beginTransaction();

        $cCode = $_POST['cCode'];
    $upd_category = $_POST['upd_category'];
    $upd_description2 = $_POST['upd_description2'];
    
    $sql1 = $conn->prepare("UPDATE tbl_journal_category SET category_name = :category_name, category_description = :category_description WHERE category_id = :category_id");
    $sql1->bindParam(':category_name', $upd_category);
    $sql1->bindParam(':category_description', $upd_description2);
    $sql1->bindParam(':category_id', $cCode);
    
   $sql2 = $conn->prepare("SELECT * FROM tbl_journal_category WHERE category_id = :category_id");
   $sql2->bindParam(':category_id', $cCode);
   $sql2->execute();
   $row = $sql2->fetch(PDO::FETCH_ASSOC);
   $last_id = $row['category_id'];


    if($sql1->execute()){
        if($sql1->rowCount() > 0){
            $audit_description = "Updated Category $last_id";
            logAuditTrail($conn, 'tbl_journal_category', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
            echo "Success";
            $conn->commit();
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

    


} else {
    echo "NOT SET";
}
?>