<?php

session_start();
require(__DIR__ . "/../../connections/connection.php");

if (isset($_POST['fiscal_desc'])) {
    $fiscal_id = $_POST['fiscal_desc'];
    $fiscal_status = $_POST['upd_status'];
    $fiscal_inactive = 'Inactive';
    $fiscal_active = 'Active';

    // First, set all records to inactive
    $sql2 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalinactive");
    $sql2->bindParam(':fiscalinactive', $fiscal_inactive);

    // Check if SQL2 executed successfully
    if ($sql2->execute()) {
        
        // Now, update the selected fiscal year to the new status (Active or Inactive)
        $sql1 = $conn->prepare("UPDATE tbl_fiscal_year SET fiscal_status = :fiscalstatus WHERE fiscal_id = :fiscal_id");
        $sql1->bindParam(':fiscalstatus', $fiscal_status);
        $sql1->bindParam(':fiscal_id', $fiscal_id);

        if ($sql1->execute()) {
            
            // If the update was successful, check for an active fiscal year
            $sql3 = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :fisc_status");
            $sql3->bindParam(':fisc_status', $fiscal_active);
            $sql3->execute();
            $row3 = $sql3->fetch(PDO::FETCH_ASSOC);

            if ($row3) {
                $_SESSION['fiscal_id'] = $row3['fiscal_id'];
                $_SESSION['fiscal_name'] = $row3['description'];
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
    
} else {
    echo "No data provided.";
}

?>
