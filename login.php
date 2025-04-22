<?php
session_start();
require("./connections/connection.php");

if(isset($_SESSION['userid'])){
    if($_SESSION['userlevel'] == 'admin' ){
        header("location: Admin/admin.php");
    } else if ($_SESSION['userlevel'] == 'cashier') {
        header("location: Cashier/cashier.php");
    } else {
        header("location: AccountingProcessor/accntprocessor.php");
    }
}  
// else {
//     header("Location: index.php");
// }
if(isset($_POST['username'])){

    $uname = $_POST['username'];
    $pword =  $_POST['password'];

    // Prepare Statement
    $sql = $conn->prepare("SELECT * FROM tbl_user INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id WHERE username = :username AND user_status = 'Active'");
    $sql2 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :f_status");
    $sql3 = $conn->prepare("SELECT * FROM tbl_signatories WHERE signatory_status = :sig_status");
    $f_status = "Active";
    $sig_status = "Active";
    if (!$sql){
        echo "Statement not prepared";
    } else {
        // Bind Parameters
        $sql->bindParam(":username",$uname,PDO::PARAM_STR);
        $sql2->bindParam(":f_status",$f_status,PDO::PARAM_STR);
        $sql3->bindParam(":sig_status",$sig_status,PDO::PARAM_STR);

        // Execute Sql Statement
        $sql->execute();
        $sql2->execute();
        $sql3->execute();

        if($sql->rowCount() > 0 ){
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $row2 = $sql2->fetch(PDO::FETCH_ASSOC);
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC);
            $hashed_password = $row['password'];

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
            if(password_verify($pword, $hashed_password)){
                $userlevel = $row['userlevel'];
                $_SESSION['userid'] = $row['uid'];
                $_SESSION['username'] = $row['username'];

                // Fetches fiscal period details
                $_SESSION['fiscal_id'] = $row2['fiscal_id'];
                $_SESSION['fiscal_name'] = $row2['description'];
                $_SESSION['fiscal_status'] = $row2['fiscal_status'];
                $_SESSION['start_date'] = $row2['start_date'];
                $_SESSION['end_date'] = $row2['end_date'];
                $_SESSION['sigID'] = $row3['signatory_id'];
                $_SESSION['sigDate'] = $row3['signatory_date'];
                if($userlevel === "Administrator"){
                    $_SESSION['userlevel'] = "admin";
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                    $_SESSION['mname'] = $row['user_mname'];
                    $_SESSION['lname'] = $row['user_lname'];
                    $_SESSION['position'] = $row['user_position'];

                       // Audit Trail for Admin
                    $description = "Administrator ". $_SESSION['username'] . " has logged in into the system";
                    logAuditTrail($conn, 'tbl_user', $row['uid'], 'LOGIN', $description, $_SESSION['userid']);

                    echo "admin";
                } else if($userlevel === "Cashier") {
                    $_SESSION['userlevel'] = "cashier";
                  
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                    $_SESSION['mname'] = $row['user_mname'];
                    $_SESSION['lname'] = $row['user_lname'];
                    $_SESSION['position'] = $row['user_position'];

                    // Audit Trail for Cashier
                    $description = "Cashier ". $_SESSION['username'] . " has logged in into the system";
                    logAuditTrail($conn, 'tbl_user', $row['uid'], 'LOGIN', $description, $_SESSION['userid']);

                    echo "cashier";
                } else if ($userlevel === "Accounting Processor"){
                    $_SESSION['userlevel'] = "accntprocessor";
                  
                    $_SESSION['ulvl'] = $row['userlevel'];
                    $_SESSION['fname'] = $row['user_fname'];
                    $_SESSION['mname'] = $row['user_mname'];
                    $_SESSION['lname'] = $row['user_lname'];
                    $_SESSION['position'] = $row['user_position'];

                    // Audit Trail for Cashier
                    $description = "Accounting Processor". $_SESSION['username'] . " has logged in into the system";
                    logAuditTrail($conn, 'tbl_user', $row['uid'], 'LOGIN', $description, $_SESSION['userid']);

                    echo "accntprocessor";
                }
            } else {
            echo "Incorrect Password";
            }

        } else {
        echo "No User is Found";
        }
    }
    
} else {
    echo "Invalid Request";
}

?>