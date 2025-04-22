<?php
// Balance Sheet Report
session_start();
require('tcpdf/tcpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');
class PDF extends TCPDF
{
    // Page footer
    public function Header()
    {
       // Set transparency for the watermark
    $this->SetAlpha(0.3);

    // Add the watermark image (adjust the path and dimensions as needed)
    $this->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

    // Reset the alpha to full opacity
    $this->SetAlpha(1);
    }
}
$pdf = new PDF();
$pdf->SetTitle('Balance Sheet');

// Disable the default header and footer
$pdf->setPrintHeader(true);

$getValue = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');

$dateFrom = $_GET['date_from'];
$date2 = DateTime::createFromFormat('Y-m-d', $dateFrom);
$datefromValue = $date2->format('F, d, Y');

$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times', 'B', 12);

// Set transparency for the watermark
$pdf->SetAlpha(0.3);

// Add the watermark image (adjust the path and dimensions as needed)
$pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Reset the alpha to full opacity
$pdf->SetAlpha(1);

$datetoday = date('Y/m/d');
$fiscal_id = $_SESSION['fiscal_id'];

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Balance Sheet', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'As of: '. $datefromValue. '- ' . $valueDate, '', 1, 'C', false);



// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(50, 10, 'ASSETS', '', 0, 'l', false);
// $pdf->Cell(100, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Balance Amount', '', 1, 'l', false);

// $value1 = 'Current Assets';
// $sql1 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
// $sql1->bindParam(':acc_type', $value1);
// $sql1->execute();
// $data = $sql1->fetchAll(PDO::FETCH_ASSOC); 
// $sql2 = $conn->prepare("SELECT * FROM tbl_account_class");
// $sql2->execute();
// $data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);


// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Current Asset', '', 1, 'l', false);
// // $pdf->Cell(0, 10, $data['account_type'], '', 1, 'l', false);

// // $balancesheet = 'Balance Sheet';
// // $stmt2 = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
// //     SUM(CASE 
// //             WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
// //             WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
// //             ELSE 0 
// //         END) AS debit_balance, 
// //     SUM(CASE 
// //             WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
// //             WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
// //             ELSE 0 
// //         END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code  INNER JOIN tbl_main_account_type ON tbl_main_account_type.main_type_id = tbl_account_type.main_type_id WHERE tbl_main_account_type.reports_included = :balancesheet AND fiscal_id = :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
// //         $stmt2->bindParam(':balancesheet', $balancesheet);
// //         $stmt->bindParam(':fiscal_id', $fiscal_id);

// foreach ($data as $row2) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row2['class_name'], '', 1, 'l', false);
//     // Account Titles
//     $sqltitle = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
//     $sqltitle->bindParam(':class_id', $row2['class_id']);
//     $sqltitle->execute();
//     $datatitle = $sqltitle->fetchAll(PDO::FETCH_ASSOC);

    
//     foreach ($datatitle as $rowtitle){
//         $pdf->SetFont('Times', '', 12);
//         if ($rowtitle['account_type'] === "Contra-Asset"){
//             $pdf->Cell(29, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
//         } else {
//             $pdf->Cell(25, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
//         }
        
//     }
    
// }

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Total Current Assets', '', 1, 'l', false);

// $pdf->Cell(5, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 20, 'Non-Current Assets', '', 1, 'l', false);

// $value2 = 'Non-Current Assets';
// $sql3 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type2");
// $sql3->bindParam(':acc_type2', $value2);
// $sql3->execute();
// $data3 = $sql3->fetchAll(PDO::FETCH_ASSOC); 
// foreach ($data3 as $row3) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row3['class_name'], '', 1, 'l', false);

//     // Account Titles
//     $sqltitle2 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id2");
//     $sqltitle2->bindParam(':class_id2', $row3['class_id']);
//     $sqltitle2->execute();
//     $datatitle2 = $sqltitle2->fetchAll(PDO::FETCH_ASSOC);
//     foreach ($datatitle2 as $rowtitle2){
//         $pdf->SetFont('Times', '', 12);
//         if ($rowtitle2['account_type'] === "Contra-Asset"){
//             $pdf->Cell(29, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
//         } else {
//             $pdf->Cell(25, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
//         }
        
//     }
// }

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(30, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 20, 'Total Property, Plant and Equipment', '', 1, 'l', false);

// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 20, 'Total Non-Current Assets', '', 1, 'l', false);


// $pdf->Cell(0, 20, 'TOTAL ASSETS', '', 1, 'l', false);

// $pdf->Cell(0, 10, 'LIABILITIES AND EQUITY', '', 1, 'l', false);

// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Liabilities', '', 1, 'l', false);

// $value3 = 'Liabilities';
// $sql4 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type3");
// $sql4->bindParam(':acc_type3', $value3);
// $sql4->execute();
// $data4 = $sql4->fetchAll(PDO::FETCH_ASSOC); 
// foreach ($data4 as $row4) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row4['class_name'], '', 1, 'l', false);

//     // Account Titles
//     $sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id2");
//     $sqltitle3->bindParam(':class_id2', $row4['class_id']);
//     $sqltitle3->execute();
//     $datatitle3 = $sqltitle3->fetchAll(PDO::FETCH_ASSOC);
//     foreach ($datatitle3 as $rowtitle3){
//         $pdf->SetFont('Times', '', 12);
//         if ($rowtitle3['account_type'] === "Contra-Asset"){
//             $pdf->Cell(29, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
//         } else {
//             $pdf->Cell(25, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
//         }
        
//     }
// }

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(30, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 20, 'Total', '', 1, 'l', false);

// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Total Liabilities', '', 1, 'l', false);

// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Equity', '', 1, 'l', false);

// // Equity Titles
// $equity = 'Equity';
// $sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
// $sqltitle3->bindParam(':a_title', $equity);
// $sqltitle3->execute();
// $datatitle3 = $sqltitle3->fetchAll(PDO::FETCH_ASSOC);

// foreach ($datatitle3 as $rowtitle3){
//     $pdf->SetFont('Times', '', 12);
//     $pdf->Cell(25, 5, '', '', 0, 'l', false);
//     $pdf->Cell(0, 5, $rowtitle3['account_name'], '', 1, 'l', false); 
    
// }
// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Total Equity', '', 1, 'l', false);


// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'TOTAL LIABILITIES AND EQUITY', '', 1, 'l', false);

$totalCurrentAsset = 0;
$totalNonCurrentAsset = 0;
$totalLiabilities = 0;
$totalLongTermLiabilities = 0;
$totalEquity = 0;
$balancesheet = 'Balance Sheet';
$sqlfirst = $conn->prepare("SELECT * FROM tbl_main_account_type WHERE reports_included = :reports");
$sqlfirst->bindParam(':reports', $balancesheet);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll();

// Extract Main Types
foreach ($resultfirst as $rowfirst) {
    $account_type = $rowfirst['main_type_name'];

    $pdf->SetFont('Times', 'B', 12);
    // Validate if Account Main Type is Assets
    if($account_type === "Assets"){
        $pdf->Cell(50, 10, strtoupper($account_type), '', 0, 'l', false);
        $pdf->Cell(100, 10, '', '', 0, 'l', false);
        $pdf->Cell(0, 10, 'Balance Amount', '', 1, 'l', false);

        // Query for account types connected to their main type
        $sqlsecond = $conn->prepare("SELECT * FROM tbl_account_type INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_main_account_type.main_type_name = :main_type_name AND tbl_account_type.account_type NOT IN  ('Contra-Asset')");
        $sqlsecond->bindParam(':main_type_name', $account_type);
        $sqlsecond->execute();
        $resultsecond = $sqlsecond->fetchAll();
        foreach($resultsecond as $rowsecond){
            $pdf->SetFont('Times', 'B', 12);
            $account_type_name = $rowsecond['account_type'];
            $pdf->Cell(10, 10, '', '', 0, 'l', false);
            $pdf->Cell(0, 10, $account_type_name, '', 1, 'l', false);

            // Account
            $type_code = $rowsecond['type_code'];
            $account_type = $rowsecond['account_type'];
            $sqlthird = $conn->prepare("SELECT * FROM tbl_account_class WHERE type_code = :type_code");
            $sqlthird->bindParam(':type_code', $type_code);
            $sqlthird->execute();
            $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datathird as $rowthird){
                
                $pdf->SetFont('Times', 'I', 12);
                $pdf->Cell(15, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, $rowthird['class_name'], '', 1, 'l', false);
                
                $sqlfourth = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
                $sqlfourth->bindParam(':class_id', $rowthird['class_id']);
                $sqlfourth->execute();
                $datafourth = $sqlfourth->fetchAll(PDO::FETCH_ASSOC);

                $totalPrinted = false;
                foreach ($datafourth as $rowfourth){
                    $pdf->SetFont('Times', '', 12);
                    
                       
                        if ($rowthird['class_name'] === "Other Property, Plant & Equipment"){
                            if ($rowfourth['account_type'] === "Contra-Asset"){
                                $pdf->Cell(30, 5, '', '', 0, 'l', false);
                                $pdf->Cell(70, 5, $rowfourth['account_name'], '', 0, 'l', false); 
                            } else {
                                // For other accounts
                                $pdf->Cell(25, 5, '', '', 0, 'l', false);
                                $pdf->Cell(75, 5, $rowfourth['account_name'], '', 0, 'l', false); 
                            }
                            
                            $account_name = $rowfourth['account_name'];
                            $sqlfifth = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                                WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                            END) AS debit_balance, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                                WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                            END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_name <= :account_name AND fiscal_id = :fiscal_id AND class_id = :class_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
                        
                            $ppe = $rowthird['class_id'];
                            $sqlfifth->bindParam("account_name", $account_name);
                            $sqlfifth->bindParam("fiscal_id", $fiscal_id);
                            $sqlfifth->bindParam("class_id", $ppe);
                            $sqlfifth->execute();
                            $datafifth = $sqlfifth->fetchAll(PDO::FETCH_ASSOC);
            

                            $valueZero = 0; 
                            // Check if any data was fetched
                            if ($datafifth) {
                                foreach ($datafifth as $rowfifth) {
                                $debitbalance = $rowfifth['debit_balance'];
                                $creditbalance = $rowfifth['credit_balance'];
            
                                    // If both debit and credit balances are zero, display 0.00
                                    if ($debitbalance == 0 && $creditbalance == 0) {
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                                    } else {
                                        // Display the higher balance (either debit or credit)
                                        $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);

                                        
                                    }
                                }
                            } else {
                                // If no data was found, still show 0.00 for the account
                                $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
    
                                }

                        } else {
                            
                            if ($rowfourth['account_type'] === "Contra-Asset"){
                                $pdf->Cell(30, 5, '', '', 0, 'l', false);
                                $pdf->Cell(70, 5, $rowfourth['account_name'], '', 0, 'l', false); 
                            } else {
                                $pdf->Cell(25, 5, '', '', 0, 'l', false);
                                $pdf->Cell(75, 5, $rowfourth['account_name'], '', 0, 'l', false); 
                            }
                            

                            $account_name = $rowfourth['account_name'];
                            $sqlfifth = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                                WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                            END) AS debit_balance, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                                WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                            END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_name = :account_name AND fiscal_id <= :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
                        
            
                            $sqlfifth->bindParam("account_name", $account_name);
                            $sqlfifth->bindParam("fiscal_id", $fiscal_id);
                            $sqlfifth->execute();
                            $datafifth = $sqlfifth->fetchAll(PDO::FETCH_ASSOC);
            


                            $valueZero = 0;
                            // Check if any data was fetched
                            if ($datafifth) {
                                foreach ($datafifth as $rowfifth) {
                                $debitbalance = $rowfifth['debit_balance'];
                                $creditbalance = $rowfifth['credit_balance'];
            
                                    // If both debit and credit balances are zero, display 0.00
                                    if ($debitbalance == 0 && $creditbalance == 0) {
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                                    } else {
                                        // Display the higher balance (either debit or credit)
                                        $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);

                                       
                                    }
                                }
                                        } else {
                            // If no data was found, still show 0.00 for the account
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                            
                    
                            }
                        }


                    
                } 

                    // // After exiting the loop, check if we need to print the total
                    // if ($rowthird['class_name'] === "Other Property, Plant & Equipment" && !$totalPrinted) {
                    //     $pdf->SetFont('Times', 'B', 12);
                    //     $pdf->Cell(30, 10, '', '', 0, 'l', false);
                    //     $pdf->Cell(0, 20, 'Total Property, Plant and Equipment', '', 1, 'l', false);
                    //     $totalPrinted = true; // Set flag to true after printing the total
                    // }
            } //End of Datathird Loop
                        $sql6 = $conn->prepare("SELECT tbl_account_type.type_code AS type_code, tbl_account_type.account_type AS account_type,
                        SUM(CASE 
                        WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                        END) AS debit_balance, 
                        SUM(CASE 
                            WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_type.type_code = :type_code2 AND fiscal_id <= :fiscal_id GROUP BY tbl_account_type.type_code, tbl_account_type.account_type ORDER BY tbl_account_title.account_code");
                        
                        $type_code2 = $rowsecond['type_code'];
                        

                        $sql6->bindParam("type_code2", $type_code2);
                        $sql6->bindParam("fiscal_id", $fiscal_id);
                        $sql6->execute();
                        $data6 = $sql6->fetch(PDO::FETCH_ASSOC);

                        $debitbalanceTotal = $data6['debit_balance'] ?? 0;
                        $creditbalanceTotal = $data6['credit_balance'] ?? 0;
                        
                        $pdf->SetFont('Times', 'B', 12);
                        $pdf->Cell(10, 10, '', '', 0, 'l', false);
                        $pdf->Cell(90, 10, 'Total '. $account_type_name  , '', 0, 'l', false);
                        $pdf->Cell(55, 10, ''  , '', 0, 'l', false);
                        if ($debitbalanceTotal > $creditbalanceTotal){
                            $pdf->Cell(0, 10, number_format($debitbalanceTotal,2) , '', 1, 'R', false);
                        } else if ($creditbalanceTotal > $debitbalanceTotal) {
                            $pdf->Cell(0, 10, number_format($creditbalanceTotal,2) , '', 1, 'R', false);
                        } else {
                            $pdf->Cell(0, 10, '0.00' , '', 1, 'l', false);
                        }
                       
        } // End of Data Second Loop

        
    } else if ($account_type === "Liabilities and Equity") {
        $pdf->Cell(50, 10, strtoupper($account_type), '', 1, 'l', false);

        $sqlsecond = $conn->prepare("SELECT * FROM tbl_account_type INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_main_account_type.main_type_name = :main_type_name ORDER BY CASE 
        WHEN account_type = 'Liabilities' THEN 1
        WHEN account_type = 'Long-term Liabilities' THEN 2
        WHEN account_type = 'Equity' THEN 3
        ELSE 4
    END ");
        $sqlsecond->bindParam(':main_type_name', $account_type);
        $sqlsecond->execute();
        $resultsecond = $sqlsecond->fetchAll();
        foreach($resultsecond as $rowsecond){
            $pdf->SetFont('Times', 'B', 12);
            $account_type_name = $rowsecond['account_type'];
            if($account_type_name === "Equity"){
                $pdf->Cell(10, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, $account_type_name, '', 1, 'l', false);

                // Equity Titles
                $equityVar = 'Equity';
                $sqlequity = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
                $sqlequity->bindParam(':a_title', $equityVar);
                $sqlequity->execute();
                $dataequity = $sqlequity->fetchAll(PDO::FETCH_ASSOC);
                foreach ($dataequity as $rowequity){
                    $pdf->SetFont('Times', '', 12);
                    $pdf->Cell(25, 5, '', '', 0, 'l', false);
                    $pdf->Cell(75, 5, $rowequity['account_name'], '', 0, 'l', false); 
                    $pdf->SetFont('Times', '', 12);
                   
                    $account_name = $rowequity['account_name'];
                            $sqlequity = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                                WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                            END) AS debit_balance, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                                WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                            END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_name = :account_name AND fiscal_id <= :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
                        
                        $sqlequity->bindParam("account_name", $account_name);
                        $sqlequity->bindParam("fiscal_id", $fiscal_id);
                        $sqlequity->execute();
                        $dataequity = $sqlequity->fetchAll(PDO::FETCH_ASSOC);

                        $valueZero = 0;
                            // Check if any data was fetched
                            if ($dataequity) {
                                foreach ($dataequity as $rowequity) {
                                $debitbalance = $rowequity['debit_balance'];
                                $creditbalance = $rowequity['credit_balance'];
            
                                    // If both debit and credit balances are zero, display 0.00
                                    if ($debitbalance == 0 && $creditbalance == 0) {
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                                    } else {
                                        $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);

                                       
                                    }
                                }
                                        } else {
                            // If no data was found, still show 0.00 for the account
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                            
                    
                            }


                }
                
            } else if ($account_type_name === "Long-Term Liabilities"){

                // For Long Term Liabilities
                $pdf->Cell(10, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, $account_type_name, '', 1, 'l', false);

                // Long term liab Titles
                $equityVar = 'Long-Term Liabilities';
                $sqlequity = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
                $sqlequity->bindParam(':a_title', $equityVar);
                $sqlequity->execute();
                $dataequity = $sqlequity->fetchAll(PDO::FETCH_ASSOC);
                foreach ($dataequity as $rowequity){
                    $pdf->SetFont('Times', '', 12);
                    $pdf->Cell(25, 5, '', '', 0, 'l', false);
                    $pdf->Cell(75, 5, $rowequity['account_name'], '', 0, 'l', false); 
                    $pdf->SetFont('Times', '', 12);
                   
                    $account_name = $rowequity['account_name'];
                            $sqlequity = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                                WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                            END) AS debit_balance, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                                WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                            END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_name = :account_name AND fiscal_id <= :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
                        
                        $sqlequity->bindParam("account_name", $account_name);
                        $sqlequity->bindParam("fiscal_id", $fiscal_id);
                        $sqlequity->execute();
                        $dataequity = $sqlequity->fetchAll(PDO::FETCH_ASSOC);

                        $valueZero = 0;
                            // Check if any data was fetched
                            if ($dataequity) {
                                foreach ($dataequity as $rowequity) {
                                $debitbalance = $rowequity['debit_balance'];
                                $creditbalance = $rowequity['credit_balance'];
            
                                    // If both debit and credit balances are zero, display 0.00
                                    if ($debitbalance == 0 && $creditbalance == 0) {
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                                    } else {
                                        if ($debitbalance > $creditbalance){
                                            $balanceToShow = $debitbalance - $creditbalance;
                                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                            $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);

                                        } else {
                                            $balanceToShow = $creditbalance - $debitbalance;
                                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                            $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);
                                        }

                                       
                                    }
                                }
                                        } else {
                            // If no data was found, still show 0.00 for the account
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                            
                    
                            }


                }
            } else {
                $pdf->Cell(10, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, $account_type_name, '', 1, 'l', false);

                $type_code = $rowsecond['type_code'];
                $sqlthird = $conn->prepare("SELECT * FROM tbl_account_class WHERE type_code = :type_code AND type_code NOT IN (3)");
                $sqlthird->bindParam(':type_code', $type_code);
                $sqlthird->execute();
                $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datathird as $rowthird){
                
                $pdf->SetFont('Times', 'I', 12);
                $pdf->Cell(15, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, $rowthird['class_name'], '', 1, 'l', false);
                
                $sqlfourth = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
                $sqlfourth->bindParam(':class_id', $rowthird['class_id']);
                $sqlfourth->execute();
                $datafourth = $sqlfourth->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datafourth as $rowfourth){
                    $pdf->SetFont('Times', '', 12);
                     
                        $pdf->Cell(25, 5, '', '', 0, 'l', false);
                        $pdf->Cell(75, 5, $rowfourth['account_name'], '', 0, 'l', false); 
                        $account_name = $rowfourth['account_name'];
                            $sqlfifth = $conn->prepare("SELECT tbl_account_title.account_code AS Acode, tbl_account_title.account_name, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                                WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                            END) AS debit_balance, 
                            SUM(CASE 
                                WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                                WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                            END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_title.account_name = :account_name AND fiscal_id <= :fiscal_id GROUP BY tbl_account_title.account_code, tbl_account_title.account_name ORDER BY tbl_account_title.account_code");
                        
            
                            $sqlfifth->bindParam("account_name", $account_name);
                            $sqlfifth->bindParam("fiscal_id", $fiscal_id);
                            $sqlfifth->execute();
                            $datafifth = $sqlfifth->fetchAll(PDO::FETCH_ASSOC);

                            $valueZero = 0;
                            // Check if any data was fetched
                            if ($datafifth) {
                                foreach ($datafifth as $rowfifth) {
                                $debitbalance = $rowfifth['debit_balance'];
                                $creditbalance = $rowfifth['credit_balance'];
            
                                    // If both debit and credit balances are zero, display 0.00
                                    if ($debitbalance == 0 && $creditbalance == 0) {
                                        $pdf->Cell(55, 6, '', '', 0, 'R', false);
                                        $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                                    } else {
                                        // Display the higher balance (either debit or credit)
                                        $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                        $pdf->Cell(55, 6, '', '', 0, 'L', false);
                                        $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);

                                       
                                    }
                                }
                                        } else {
                            // If no data was found, still show 0.00 for the account
                            $pdf->Cell(55, 6, '', '', 0, 'R', false);
                            $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                            
                    
                            }
                    
        
                     
                    }
                }
            }
           
            
            
        }
        $sql6 = $conn->prepare("SELECT tbl_account_type.type_code AS type_code, tbl_account_type.account_type AS account_type,
                        SUM(CASE 
                        WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                        END) AS debit_balance, 
                        SUM(CASE 
                            WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_type.type_code = :type_code2 AND fiscal_id <= :fiscal_id GROUP BY tbl_account_type.type_code, tbl_account_type.account_type ORDER BY tbl_account_title.account_code");
                        
                        $type_code2 = $rowsecond['type_code'];
                        

                        $sql6->bindParam("type_code2", $type_code2);
                        $sql6->bindParam("fiscal_id", $fiscal_id);
                        $sql6->execute();
                        $data6 = $sql6->fetch(PDO::FETCH_ASSOC);

                        $debitbalanceTotal = $data6['debit_balance'] ?? 0;
                        $creditbalanceTotal = $data6['credit_balance'] ?? 0;
                        
                        $pdf->SetFont('Times', 'B', 12);
                        $pdf->Cell(10, 10, '', '', 0, 'l', false);
                        $pdf->Cell(90, 10, 'Total '. $account_type_name  , '', 0, 'l', false);
                        $pdf->Cell(55, 10, ''  , '', 0, 'l', false);
                        if ($debitbalanceTotal > $creditbalanceTotal){
                            $pdf->Cell(0, 10, number_format($debitbalanceTotal,2) , '', 1, 'R', false);
                        } else if ($creditbalanceTotal > $debitbalanceTotal) {
                            $pdf->Cell(0, 10, number_format($creditbalanceTotal,2) , '', 1, 'R', false);
                        } else {
                            $pdf->Cell(0, 10, '0.00' , '', 1, 'R', false);
                        }
    }
    $sql7 = $conn->prepare("SELECT tbl_main_account_type.main_type_id AS main_type_code, tbl_main_account_type.main_type_name AS main_type_name,
                        SUM(CASE 
                        WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                        END) AS debit_balance, 
                        SUM(CASE 
                            WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_main_account_type.main_type_id = :main_type_code AND fiscal_id <= :fiscal_id GROUP BY tbl_main_account_type.main_type_id, tbl_main_account_type.main_type_name ORDER BY tbl_account_title.account_code"); 
                        $sql7->bindParam("main_type_code", $rowfirst['main_type_id']);
                        $sql7->bindParam("fiscal_id", $fiscal_id);
                        $sql7->execute();
                        $data7 = $sql7->fetch(PDO::FETCH_ASSOC);

                        $debitbalanceTotal = $data7['debit_balance'] ?? 0;
                        $creditbalanceTotal = $data7['credit_balance'] ?? 0;

    $pdf->Cell(90, 10, 'TOTAL ' . strtoupper($rowfirst['main_type_name']), '', 0, 'l', false);
    $pdf->Cell(65, 10, '','', 0, 'l', false);
    if ($debitbalanceTotal > $creditbalanceTotal){
        $pdf->Cell(0, 10, number_format($debitbalanceTotal,2) , 'B', 1, 'R', false);
    } else if ($creditbalanceTotal > $debitbalanceTotal) {
        $pdf->Cell(0, 10, number_format($creditbalanceTotal,2) , 'B', 1, 'R', false);
    } else {
        $pdf->Cell(0, 10, '0.00' , 'B', 1, 'R', false);
    }


}

// $sigactive = "Active";
// $sqlsignatory = $conn->prepare('SELECT * FROM tbl_signatories WHERE signatory_status = :sig_status');
// $sqlsignatory->bindParam(":sig_status",$sigactive);
// $sqlsignatory->execute();
// $signame = $sqlsignatory->fetch();
// $sig_fname = $signame['signatory_fname'];
// $sig_mname = $signame['signatory_mname'];
// $sig_lname = $signame['signatory_lname'];
// $sig_position = $signame['signatory_position'];


// $fname = $_SESSION['fname'];
// $lname = $_SESSION['lname'];
// $mname = $_SESSION['mname'];
// $position = $_SESSION['position'];
// // Manually adjust the position if needed
// $pdf->Ln(10); // Add some space before the signatories
// $pdf->Cell(50, 6, 'Prepared By:', '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);

// $pdf->Cell(50, 6, 'Noted By:', '', 1, 'l', false);
// $pdf->Ln(10); // Add some space before the signatories

// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);


// $pdf->Cell(50, 6, "$position", '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);

// 
$start_time = $_SESSION['sigDate']; 
$sigactive = "Active";

$sqlsignatory = $conn->prepare(
    'SELECT * FROM tbl_signatories 
    WHERE signatory_date <= :start_time
    ORDER BY signatory_date DESC 
     LIMIT 1');
      $sqlsignatory->bindParam(":start_time", $getValue);
      $sqlsignatory->execute();
    $signame = $sqlsignatory->fetch();



// Set variables for the signatory's information if found
$sig_fname = $signame['signatory_fname'] ?? '';
$sig_mname = $signame['signatory_mname'] ?? '';
$sig_lname = $signame['signatory_lname'] ?? '';
$sig_position = $signame['signatory_position'] ?? '';

// Get current session user details
$fname = $_SESSION['fname'];
$mname = $_SESSION['mname'];
$lname = $_SESSION['lname'];
$position = $_SESSION['position'];

// PDF Layout
$pdf->Ln(10); // Add some space before the signatories
$pdf->Cell(50, 6, 'Prepared By:', '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, 'Noted By:', '', 1, 'l', false);

$pdf->Ln(10); // Add more space
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);

$pdf->Cell(50, 6, "$position", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);


$pdf->Output();

?>