<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_main_account_type WHERE main_type_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_main_account_type");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <option style="display: none;"></option>
            <option value="<?=$row['main_type_id']?>" data-account-code="<?=$row['main_type_id']?>" id="<?=$row['main_type_id']?>"><?=$row['main_type_name']?></option>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>