<?php
 session_start();
require(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['add_sigfname'])) {

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

    $add_sigfname = $_POST['add_sigfname'];
    $add_sigmname = $_POST['add_sigmname'];
    $add_siglname = $_POST['add_siglname'];
    $add_sigposition = $_POST['add_sigposition'];
    $add_sigdate = "0000-00-00";
    $add_status = "Inactive";
    $sql1 = $conn->prepare("SELECT * FROM tbl_signatories WHERE signatory_lname = :sig_lname");
    $sql1->bindParam(":sig_lname", $add_siglname);
    if (!$sql1) {
        echo "No Statement Prepared";
    }
    $sql1->execute();
    $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Account Signatory Already Existing";
    } else {
        $sql2 = $conn->prepare("INSERT INTO tbl_signatories (signatory_fname, signatory_mname, signatory_lname, signatory_position, signatory_status, signatory_date) VALUES (:signatory_fname, :signatory_mname, :signatory_lname, :signatory_position, :signatory_status, :signatory_date)");
        $sql2->bindParam(":signatory_fname", $add_sigfname);
        $sql2->bindParam(":signatory_mname", $add_sigmname);
        $sql2->bindParam(":signatory_lname", $add_siglname);
        $sql2->bindParam(":signatory_position", $add_sigposition);
        $sql2->bindParam(":signatory_status", $add_status);
        $sql2->bindParam(":signatory_date", $add_sigdate);
        if (!$sql2){
            echo "No Statement Prepared";
        } else {
            if ($sql2->execute()) {
                $description = "Inserted new signatory: $add_sigfname $add_sigmname $add_siglname";
                logAuditTrail($conn, 'tbl_journal_category', $conn->lastInsertId(), 'ADD', $description, $_SESSION['userid']);

                echo "Success";
                $conn->commit();
            } else {
                echo "Failed in Inserting Signatory";
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