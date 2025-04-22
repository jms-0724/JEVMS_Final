<?php
// Balance Sheet Report
session_start();
require('tcpdf/tcpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new TCPDF();
$pdf->SetTitle('Balance Sheet');

// Disable the default header and footer
$pdf->setPrintHeader(false);

$getValue = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');

$dateFrom = $_GET['date_from'];
$date2 = DateTime::createFromFormat('Y-m-d', $dateFrom);
$datefromValue = $date2->format('F, d, Y');

$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times', 'B', 12);

$datetoday = date('Y/m/d');
$fiscal_id = $_SESSION['fiscal_id'];

$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Balance Sheet', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, $datefromValue. '- ' . $valueDate, '', 1, 'C', false);


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


$balancesheet = 'Balance Sheet';
$sqlfirst = $conn->prepare("SELECT * FROM tbl_main_account_type WHERE reports_included = :reports");
$sqlfirst->bindParam(':reports', $balancesheet);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll();

// Extract Main Types
foreach ($resultfirst as $rowfirst) {
    $account_type = $rowfirst['main_type_name'];

    $pdf->SetFont('Times', 'B', 12);
    if($account_type === "Assets"){
        $pdf->Cell(50, 10, strtoupper($account_type), '', 0, 'l', false);
        $pdf->Cell(100, 10, '', '', 0, 'l', false);
        $pdf->Cell(0, 10, 'Balance Amount', '', 1, 'l', false);

        $sqlsecond = $conn->prepare("SELECT * FROM tbl_account_type INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_main_account_type.main_type_name = :main_type_name AND tbl_account_type.account_type NOT IN  ('Contra-Asset')");
        $sqlsecond->bindParam(':main_type_name', $account_type);
        $sqlsecond->execute();
        $resultsecond = $sqlsecond->fetchAll();
        foreach($resultsecond as $rowsecond){
            $pdf->SetFont('Times', 'B', 12);
            $account_type_name = $rowsecond['account_type'];
            $pdf->Cell(10, 10, '', '', 0, 'l', false);
            $pdf->Cell(0, 10, $account_type_name, '', 1, 'l', false);

            $type_code = $rowsecond['type_code'];
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
                    if ($rowfourth['account_type'] === "Equity"){
                        $pdf->Cell(25, 5, '', '', 0, 'l', false);
                        $pdf->Cell(0, 5, $rowfourth['account_name'], '', 1, 'l', false); 
                    } else {
                       
                        if ($rowthird['class_name'] === "Other Property, Plant & Equipment"){
                            $pdf->Cell(25, 5, '', '', 0, 'l', false);
                            $pdf->Cell(0, 5, $rowfourth['account_name'], '', 1, 'l', false); 
                             // Print the total only once
                        
                             
                        }  
                         else {
                            $pdf->Cell(25, 5, '', '', 0, 'l', false);
                            $pdf->Cell(0, 5, $rowfourth['account_name'], '', 1, 'l', false); 
                        }

                        $sqlfifth = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code WHERE tbl_account_title.account_code = :class_id");
                        $sqlfifth->bindParam(':class_id', $rowfourth['account_name']);
                        $sqlfifth->execute();
                        $datafifth = $sqlfifth->fetchAll(PDO::FETCH_ASSOC);

                        
                    }
                      
                    
                } 

                    // After exiting the loop, check if we need to print the total
                    if ($rowthird['class_name'] === "Other Property, Plant & Equipment" && !$totalPrinted) {
                        $pdf->SetFont('Times', 'B', 12);
                        $pdf->Cell(30, 10, '', '', 0, 'l', false);
                        $pdf->Cell(0, 20, 'Total Property, Plant and Equipment', '', 1, 'l', false);
                        $totalPrinted = true; // Set flag to true after printing the total
                    }
               
            }
                        
                        $pdf->SetFont('Times', 'B', 12);
                        $pdf->Cell(10, 10, '', '', 0, 'l', false);
                        $pdf->Cell(0, 10, 'Total '. $account_type_name , '', 1, 'l', false);
        }

        
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
                    $pdf->Cell(0, 5, $rowequity['account_name'], '', 1, 'l', false); 
                    $pdf->SetFont('Times', 'B', 12);
                   
                    
                }
                $pdf->Cell(10, 10, '', '', 0, 'l', false);
                $pdf->Cell(0, 10, 'Total Equity', '', 1, 'l', false);
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
                        $pdf->Cell(0, 5, $rowfourth['account_name'], '', 1, 'l', false); 
                     
                    }
                }
            }
           
            
            
        }
    }
}


$pdf->Output();

?>