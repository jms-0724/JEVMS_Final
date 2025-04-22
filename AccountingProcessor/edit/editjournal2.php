<?php
session_start();
require(__DIR__ . "/../../connections/connection.php");

$data = file_get_contents('php://input');

$jsondecoded = json_decode($data, true);
$datetoday = date('Y/m/d');
if (isset($jsondecoded['upd_journal_id'])) {

    try {
        $conn->beginTransaction();

        $upd_journal_number = $jsondecoded['upd_journal_id'];
        $fiscal_id = $_SESSION['fiscal_id'];
        // $upd_journal_id = $_POST['upd_journal_id'];
        $pending = "Pending";

        $sql1 = $conn->prepare('UPDATE tbl_journal_entry SET journal_status = :JStatus WHERE journal_voucher_id = :journal_voucher_id1');
        $sql1->bindParam(':JStatus', $pending);
        $sql1->bindParam(':journal_voucher_id1', $upd_journal_number);
        $sql1->execute();

        foreach ($jsondecoded['journal_array'] as $row) {
            $journal_item_id = $row['journal_item_id'];
            $account_code = $row['account_code'];
            $journal_amount = $row['journal_amount'];
            $journal_placement = $row['journal_placement'];

            // Update journal items
            $sql2 = $conn->prepare("UPDATE tbl_journal_items SET account_code = :account_code, journal_amount = :journal_amount, journal_adjustment = :journal_placement WHERE journal_item_id = :journal_voucher_id");
            // $sql2 = $conn->prepare("UPDATE tbl_journal_items SET account_code = :account_code, journal_amount = :journal_amount, journal_adjustment = :journal_placement WHERE journal_voucher_id = :journal_voucher_id AND account_code = :account_code");
            $sql2->bindParam(':journal_voucher_id', $journal_item_id);
            // $sql2->bindParam(':journal_voucher_id', $upd_journal_number);
            $sql2->bindParam(":account_code", $account_code);
            $sql2->bindParam(":journal_amount", $journal_amount);
            $sql2->bindParam(":journal_placement", $journal_placement);

            if ($sql2->execute()) {
                
            } else {
                // Rollback transaction if any update fails   
                $conn->rollBack();
                echo "Failed to update journal items.";
                exit();
            }
        }

        // Commit transaction if all updates succeed
        $conn->commit();
        echo "Success";

    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollBack();
        echo "Transaction Failed: " . $e->getMessage();
    }
} else {
    echo "Not Set";
}
