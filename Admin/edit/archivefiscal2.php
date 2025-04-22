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

if (isset($_POST['fiscal_desc'])) {
    try {
        $conn->beginTransaction();
        
        $fiscal_id = $_POST['fiscal_desc'];
    $fiscal_status = $_POST['upd_status'];
    $fiscal_inactive = 'Inactive';
    $fiscal_active = 'Active';

    // First, set all records to inactive
    $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalinactive");
    $sql2->bindParam(':fiscalinactive', $fiscal_inactive);

    // Check if SQL2 executed successfully
    if ($sql2->execute()) {
        
        if ($fiscal_status === $fiscal_inactive){
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
            $sql1->bindParam(':fiscalstatus', $fiscal_active);
            $sql1->bindParam(':fiscal_id', $fiscal_id);
            $last_id = $conn->lastInsertId();
        } else if ($fiscal_status === $fiscal_active) {
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
            $sql1->bindParam(':fiscalstatus', $fiscal_inactive);
            $sql1->bindParam(':fiscal_id', $fiscal_id);
            $last_id = $conn->lastInsertId();
        }

        if ($sql1->execute()) {
            
            // If the update was successful, check for an active fiscal year
            $sql3 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :fisc_status");
            $sql3->bindParam(':fisc_status', $fiscal_active);
            $sql3->execute();
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC);

            if ($row3) {
                $_SESSION['fiscal_id'] = $row3['fiscal_id'];
                $_SESSION['fiscal_name'] = $row3['description'];
                $_SESSION['start_date'] = $row3['start_date'];

                $audit_description = "Updated Fiscal Status of $fiscal_id";
                logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";
            } else {
                echo "No active fiscal year found.";
            }
            
        } else {
            echo "Failed to update fiscal year.";
        }

    } else {
        echo "Failed to set fiscal years to inactive.";
    }
       } catch (Exception $e) {
        // Rollback if an exception occurs
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    
    
} else {
    echo "No data provided.";
}

?>
