<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM `tbl_signatories` WHERE signatory_fname LIKE '%$search%' OR signatory_lname LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM `tbl_signatories` WHERE signatory_status = 'Inactive'");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        $sig_fname = $row['signatory_fname'];
        $sig_mname = $row['signatory_mname'];
        $sig_lname = $row['signatory_lname'];

        ?>
            <option value="<?=$row['signatory_id']?>" id="signatoryID"><?=$row['signatory_fname'] . " " . $row['signatory_mname'] . " " .  $row['signatory_lname']?></option>
        <?php

    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>