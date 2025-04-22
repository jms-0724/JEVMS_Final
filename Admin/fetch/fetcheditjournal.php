<?php
// Connection to the database
require_once(__DIR__ . "/../../connections/connection.php");

if(isset($_POST['uid'])){
    $vID = $_POST['uid'];

    $stmt = $conn->prepare("SELECT tbl_journal_items.journal_item_id AS journal_item_id, tbl_journal_items.account_code AS account_code, tbl_account_title.account_name AS account_name, journal_adjustment, journal_amount FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code WHERE journal_voucher_id = :voucher_id");
    $stmt->bindParam(':voucher_id', $vID);
} else {
    $stmt = $conn->prepare("SELECT tbl_journal_items.account_code AS account_code, tbl_account_title.account_name AS account_name, journal_adjustment, journal_amount FROM tbl_journal_items INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all account titles for the select options
$accountTitlesStmt = $conn->prepare("SELECT account_code, account_name FROM tbl_account_title");
$accountTitlesStmt->execute();
$accountTitles = $accountTitlesStmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row) {
        ?>
        <tr class="jItems2" >
            <td class="account-code" id="<?= $row['journal_item_id']?>"><?= $row['account_code'] ?></td>
            <td>
                <select name="upd_acct_titles[]" class="upd_acct_titles" style="width: 100%;">
                    <?php
                    // Loop through account titles to populate options
                    foreach ($accountTitles as $account) {
                        // Check if the current account code matches the row's account code
                        $selected = $row['account_code'] === $account['account_code'] ? 'selected' : '';
                        ?>
                        <option value="<?= $account['account_code'] ?>" <?= $selected ?>><?= $account['account_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            
            <?php
            if ($row['journal_adjustment'] === "Debit") {
                ?>
                <td><input type="number" name="" id="" class="<?= $row['journal_adjustment'] ?>" value="<?= $row['journal_amount'] ?>"></td>
                <td></td>
                <?php
            } elseif ($row['journal_adjustment'] === "Credit") {
                ?>
                <td></td>
                <td><input type="number" name="" id="" class="<?= $row['journal_adjustment'] ?>" value="<?= $row['journal_amount'] ?>"></td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
} else {
    ?>
    <option style="display: none;"></option>
    <?php 
}
?>
