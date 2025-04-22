<?php
session_start();
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE description LIKE '%$search%'");
} else {
    $closed = "Closed";
    $active = "Active";
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_status = :closed OR fiscal_status = :active");
    $stmt->bindParam(":closed", $closed);
    $stmt->bindParam(":active", $active);
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option style="display: none;">Please Select an Option</option>
            <option value="<?=$row['fiscal_id']?>" data-account-code="<?=$row['fiscal_id']?>"><?=$row['description']?></option>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>