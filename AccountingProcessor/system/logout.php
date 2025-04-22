    <?php
    session_start();
    require_once(__DIR__ . "/../../connections/connection.php");
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
    if (isset($_POST['logout'])) {

        $description =  $_SESSION['ulvl'] . " " . $_SESSION['username'] . " has logged out into the system";
        if ($conn){
            logAuditTrail($conn, 'tbl_user', $_SESSION['userid'], 'LOGOUT', $description, $_SESSION['userid']);
        }
        
        // Unset all session variables
        $_SESSION = array();

        // Finally, destroy the session
        session_destroy();
        
    }


    header("location:./../../index.php");
    exit(); // Add exit() to stop further execution
    ?>