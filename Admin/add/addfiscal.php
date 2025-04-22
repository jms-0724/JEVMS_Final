<?php
 session_start();
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_fiscal'])) {

    
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
    $add_fiscal = $_POST['add_fiscal'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $fiscal_status = "Inactive";
    $sql1 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE description = :add_fiscal");
    $sql1->bindParam(":add_fiscal", $add_fiscal);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Category Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_fiscal_year (start_date, end_date, description, fiscal_status) VALUES (:start, :end, :describe, :fiscal_status)");
        $sql2->bindParam(":start", $startDate);
        $sql2->bindParam(":end", $endDate);
        $sql2->bindParam(":describe", $add_fiscal);
        $sql2->bindParam(":fiscal_status", $fiscal_status);

        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {
                $description = "Inserted new fiscal_year: $add_fiscal and it is currently $fiscal_status";
                logAuditTrail($conn, 'tbl_fiscal_year', $conn->lastInsertId(), 'ADD', $description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";
            } else {
                echo "Failed in Inserting Fiscal Year";
            }
                
        }
    }
   } catch (Exception $e) {
    // Rollback if an exception occurs
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}


}

?>