<?php
session_start();
require(__DIR__ . "/../../connections/conn.php");


$currentFiscal = $_SESSION['fiscal_id'];
$stmt = $conn->prepare("SELECT count(*) AS total_ledger FROM tbl_general_ledger WHERE fiscal_id = ?");
$stmt->bind_param("i", $currentFiscal);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
        <span><?=$row['total_ledger']?></span>
        <?php
    }
} else {
    ?>
    <span>Result Not Found</span>
    <?php
}
?> 