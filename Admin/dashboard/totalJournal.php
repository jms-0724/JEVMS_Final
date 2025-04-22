<?php
session_start();
require(__DIR__ . "/../../connections/conn.php");


$currentFiscal = $_SESSION['fiscal_id'];
$stmt = $conn->prepare("SELECT count(*) AS total_journal FROM tbl_journal_entry WHERE fiscal_id = ?");
$stmt->bind_param("i", $currentFiscal);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        ?>
        <span><?=$row['total_journal']?></span>
        <?php
    }
} else {
    ?>
    <span>Result Not Found</span>
    <?php
}
?> 