<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
    $vID = $_POST['uid'];

    $stmt = $conn->prepare("SELECT tbl_journal_items.account_code AS account_code, tbl_account_title.account_name AS account_name, journal_adjustment, journal_amount FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code WHERE journal_voucher_id = :voucher_id");
    $stmt->bindParam(':voucher_id', $vID);
} else {
    $stmt = $conn->prepare("SELECT tbl_journal_items.account_code AS account_code, tbl_account_title.account_name AS account_name, journal_adjustment, journal_amount FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
            <div class="">
                <div class="form-group">
                    <label for="account_code">Account Code:</label>
                    <input type="text" name="" id="" value="<?=$row['account_code']?>">
                </div>
                <div class="form-group">
                    <label for="account_code">Select JS Code:</label>
                    <input type="text" name="" id="" value="<?=$row['account_name']?>">
                </div>
            </div>
        <?php
    }
} else {
    ?>
        <option style="display: none;"></option>
    <?php 
}

?>