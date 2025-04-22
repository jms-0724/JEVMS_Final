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

if (isset($_POST['fiscalID'])) {
    try {
        $conn->beginTransaction();
        
        $current_fiscid = $_SESSION['fiscal_id'];
        $fiscID = $_POST['fiscalID'];

        // First, set the specified fiscal year to "Closed"
        // $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalclosed WHERE fiscal_id = :fiscal_id");
        $sql2 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_id = :fiscalID");
        $sql2->bindParam(':fiscalID', $fiscID);
        
        if ($sql2->execute()) {
            $dataFiscal = $sql2->fetch(PDO::FETCH_ASSOC);
            $_SESSION['fiscal_id'] = $dataFiscal['fiscal_id'];
            $_SESSION['fiscal_name'] = $dataFiscal['description'];
            $_SESSION['fiscal_status'] = $dataFiscal['fiscal_status'];
            $_SESSION['start_date'] = $dataFiscal['start_date'];
            $_SESSION['end_date'] = $dataFiscal['end_date'];
            $current_fiscStatus = $_SESSION['fiscal_status'];
            echo "Success";
           
        } else {
            $conn->rollBack();
            echo "Failed to set fiscal year to closed.";
        }
    } catch (Exception $e) {
        // Rollback in case of an error
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No data provided.";
}



?>
