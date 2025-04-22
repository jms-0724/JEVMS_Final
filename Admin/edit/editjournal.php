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

        foreach ($jsondecoded['journal_array'] as $row) {
            $journal_item_id = $row['journal_item_id'];
            $account_code = $row['account_code'];
            $journal_amount = $row['journal_amount'];
            $journal_placement = $row['journal_placement'];

            // Update journal items
            $sql2 = $conn->prepare("UPDATE tbl_journal_items SET account_code = :account_code, journal_amount = :journal_amount, journal_adjustment = :journal_placement WHERE journal_voucher_id = :journal_voucher_id AND account_code = :account_code");
            $sql2->bindParam(':journal_voucher_id', $upd_journal_number);
            $sql2->bindParam(":account_code", $account_code);
            $sql2->bindParam(":journal_amount", $journal_amount);
            $sql2->bindParam(":journal_placement", $journal_placement);

            if ($sql2->execute()) {
                $dbt = "Debit";
                $crt = "Credit";

                // Fetch the updated ledger ID
                $sqlselect = $conn->prepare("SELECT ledger_id FROM tbl_general_ledger WHERE journal_voucher_id = :journal_voucher_id LIMIT 1");
                $sqlselect->bindParam(':journal_voucher_id', $upd_journal_number);
                $sqlselect->execute();
                $ledgerEntry = $sqlselect->fetch(PDO::FETCH_ASSOC);

                if ($ledgerEntry) {
                    $ledger_id = $ledgerEntry['ledger_id'];

                    // Execute the appropriate update based on journal placement
                    if ($journal_placement === $dbt) {
                        // Update Debit in General Ledger
                        $sql3 = $conn->prepare("UPDATE tbl_general_ledger SET ledger_date=:ledger_date, account_code=:account_code, debit=:debit WHERE ledger_id = :ledger_id AND account_code=:account_code");
                        $sql3->bindParam(":ledger_date", $datetoday);
                        $sql3->bindParam(":account_code", $account_code);
                        $sql3->bindParam(":debit", $journal_amount);
                        $sql3->bindParam(":ledger_id", $ledger_id);
                        $sql3->execute();

                        // Update Debit in Trial Balance
                        $sql5 = $conn->prepare("UPDATE tbl_trial_balance SET total_debit=:total_debit, trial_balance_date=:trial_balance_date WHERE ledger_id=:ledger_id AND account_code=:account_code");
                        $sql5->bindParam(":ledger_id", $ledger_id);
                        $sql5->bindParam(":total_debit", $journal_amount);
                        $sql5->bindParam(":trial_balance_date", $datetoday);
                        $sql5->bindParam(":account_code", $account_code);
                        $sql5->execute();

                    } elseif ($journal_placement === $crt) {
                        // Update Credit in General Ledger
                        $sql4 = $conn->prepare("UPDATE tbl_general_ledger SET ledger_date=:ledger_date, account_code=:account_code, credit=:credit WHERE ledger_id = :ledger_id AND account_code=:account_code");
                        $sql4->bindParam(":ledger_date", $datetoday);
                        $sql4->bindParam(":account_code", $account_code);
                        $sql4->bindParam(":credit", $journal_amount);
                        $sql4->bindParam(":ledger_id", $ledger_id);

                        $sql4->execute();

                        // Update Credit in Trial Balance
                        $sql6 = $conn->prepare("UPDATE tbl_trial_balance SET total_credit=:total_credit, trial_balance_date=:trial_balance_date WHERE ledger_id=:ledger_id AND account_code=:account_code");
                        $sql6->bindParam(":ledger_id", $ledger_id);
                        $sql6->bindParam(":total_credit", $journal_amount);
                        $sql6->bindParam(":trial_balance_date", $datetoday);
                        $sql6->bindParam(":account_code", $account_code);
                        $sql6->execute();
                    }
                } else {
                    error_log("Ledger entry not found for Voucher ID: $upd_journal_number");
                }
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
