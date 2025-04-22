<?php

// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");


    $stmt = $conn->prepare("SELECT * FROM tbl_journal_entry ORDER BY CAST(SUBSTRING(journal_voucher_no, 4) AS UNSIGNED) DESC LIMIT 1");


$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        $jev_number = $row["journal_voucher_no"];
        echo $jev_number;
    }
} else {
    ?>
        
    <?php 
    echo "No Number";
}

