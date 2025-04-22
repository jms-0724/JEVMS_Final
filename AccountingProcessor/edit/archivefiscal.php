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
        
        $current_fiscid = $_SESSION['fiscal_id'];
        $fiscal_id = $_POST['fiscal_desc'];
        $fiscal_status = $_POST['upd_status'];
        
        $fiscal_closed = "Closed";
        $fiscal_active = "Active";
        $fiscal_inactive = "Inactive";

        // First, set the specified fiscal year to "Closed"
        $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalclosed WHERE fiscal_id = :fiscal_id");
        $sql2->bindParam(':fiscalclosed', $fiscal_closed);
        $sql2->bindParam(':fiscal_id', $current_fiscid);

        if ($sql2->execute()) {
            // Now, update the selected fiscal year to either "Active" or "Inactive"
            $new_status = ($fiscal_status === $fiscal_inactive) ? $fiscal_active : $fiscal_inactive;

            $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
            $sql1->bindParam(':fiscalstatus', $new_status);
            $sql1->bindParam(':fiscal_id', $fiscal_id);

            if ($sql1->execute()) {
                
                // Check for an active fiscal year to update the session
                $sql3 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :fisc_status");
                $sql3->bindParam(':fisc_status', $fiscal_active);
                $sql3->execute();
                $row3 = $sql3->fetch(PDO::FETCH_ASSOC);

                if ($row3) {
                    $_SESSION['fiscal_id'] = $row3['fiscal_id'];
                    $_SESSION['fiscal_name'] = $row3['description'];
                    $_SESSION['start_date'] = $row3['start_date'];

                    $audit_description = "Updated Fiscal Status of fiscal ID $fiscal_id to $new_status";
                    logAuditTrail($conn, 'tbl_fiscal_year', $fiscal_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                    
                    $conn->commit();
                    echo "Success";
                } else {
                    $conn->rollBack();
                    echo "No active fiscal year found.";
                }
                
            } else {
                $conn->rollBack();
                echo "Failed to update fiscal year status.";
            }
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
