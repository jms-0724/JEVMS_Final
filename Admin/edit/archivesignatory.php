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

if (isset($_POST['signatoryID'])) {
    try {
        $conn->beginTransaction();
    
    $add_sigdate = $_POST['add_sigdate'];
    $sigID = $_POST['signatoryID'];
    $sig_status = $_POST['signatoryStatus'];
    $sig_inactive = 'Inactive';
    $sig_active = 'Active';

    // First, set all records to inactive
    $sql2 = $conn->prepare("UPDATE tbl_signatories SET signatory_status = :signatory_status");
    $sql2->bindParam(':signatory_status', $sig_inactive);

    // Check if SQL2 executed successfully
    if ($sql2->execute()) {
        
        if ($sig_status === $sig_inactive){
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1 = $conn->prepare("UPDATE tbl_signatories SET signatory_status = :sig_status, signatory_date = :sig_date WHERE signatory_id = :sign_id");
            $sql1->bindParam(':sig_status', $sig_inactive);
            $sql1->bindParam(':sig_date', $add_sigdate);
            $sql1->bindParam(':sign_id', $sigID);
            $last_id = $conn->lastInsertId();
        } else if ($sig_status === $sig_active) {
            $sql1 = $conn->prepare("UPDATE tbl_signatories SET signatory_status = :sig_status, signatory_date = :sig_date WHERE signatory_id = :sign_id");
            
            // Now, update the selected fiscal year to the new status (Active or Inactive)
            $sql1->bindParam(':sig_status', $sig_active);
            $sql1->bindParam(':sig_date', $add_sigdate);
            $sql1->bindParam(':sign_id', $sigID);
            $last_id = $conn->lastInsertId();
        }

        if ($sql1->execute()) {
            
            // If the update was successful, check for an active fiscal year
            $sql3 = $conn->prepare("SELECT * FROM tbl_signatories WHERE signatory_status = :sign_Status2");
            $sql3->bindParam(':sign_Status2', $sig_active);
            $sql3->execute();
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC);
            $signatory_id = $row3['signatory_id'];

            if ($row3) {
                $audit_description = "Updated Signatory Status of $signatory_id";
                logAuditTrail($conn, 'tbl_user', $last_id, 'UPDATE', $audit_description, $_SESSION['userid']);
                $conn->commit();
                echo "Success";
            } else {
                echo "No active signatory found.";
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
