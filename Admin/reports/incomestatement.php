<?php
// Income Statement Report
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
$pdf->SetTitle('Income Statement');
// Disable the default header and footer
$pdf->setPrintHeader(true);

$pdf->AddPage('P', 'Legal');

// // Set transparency for the watermark
// $pdf->SetAlpha(0.3);

// // Add the watermark image (adjust the path and dimensions as needed)
// $pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// // Reset the alpha to full opacity
// $pdf->SetAlpha(1);
if (isset($_GET['date_to'])){

$getValue = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');

$dateFrom = $_GET['date_from'];
$date2 = DateTime::createFromFormat('Y-m-d', $dateFrom);
$datefromValue = $date2->format('F, d, Y');

$fiscal_id = $_SESSION['fiscal_id'];


} else {
    $valueDate = date('F, d, Y');
}
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'C', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Detailed Statement of Income and Expenses', '', 1, 'C', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Period:' . $datefromValue . '-' . $valueDate, '', 1, 'C', false);


// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Income', '', 1, 'L', false);

// // Expenses Titles
// $income = 'Income';
// $sqltitle = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
// $sqltitle->bindParam(':a_title', $income);
// $sqltitle->execute();
// $datatitle = $sqltitle->fetchAll(PDO::FETCH_ASSOC);

// foreach ($datatitle as $rowtitle){
//     $pdf->SetFont('Times', '', 12);
//     $pdf->Cell(25, 5, '', '', 0, 'l', false);
//     $pdf->Cell(0, 5, $rowtitle['account_name'], '', 1, 'l', false); 
    
// }

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(25, 6, '', '', 0, 'L', false);
// $pdf->Cell(0, 6, 'Total Income', '', 1, 'L', false);

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Less:Expenses', '', 1, 'L', false);


// $value1 = 'Personnel Services';
// $sql1 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
// $sql1->bindParam(':acc_type', $value1);
// $sql1->execute();
// $data = $sql1->fetchAll(PDO::FETCH_ASSOC);

// $pdf->Cell(10, 10, '', '', 0, 'l', false);
// $pdf->Cell(0, 10, 'Personnel Services', '', 1, 'l', false);

// foreach ($data as $row2) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row2['class_name'], '', 1, 'l', false);

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

    
// } //End of Loop

//     $pdf->Cell(10, 6, '', '', 0, 'L', false);
//     $pdf->SetFont('Times', 'B', 12);
//     $pdf->Cell(0, 6, 'Total Personnel Services', '', 1, 'L', false);

// // SQL for Maintenance and Other Operating Expenses

// $value2 = 'Maintenance and Other Operating Expenses';
// $sql2 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
// $sql2->bindParam(':acc_type', $value2);
// $sql2->execute();
// $data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

// foreach ($data2 as $row3) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row3['class_name'], '', 1, 'l', false);

//     $sqltitle2 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
//     $sqltitle2->bindParam(':class_id', $row3['class_id']);
//     $sqltitle2->execute();
//     $datatitle2 = $sqltitle2->fetchAll(PDO::FETCH_ASSOC);
//     foreach ($datatitle2 as $rowtitle2){
//         $pdf->SetFont('Times', '', 12);
//         if ($rowtitle['account_type'] === "Contra-Asset"){
//             $pdf->Cell(29, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
//         } else {
//             $pdf->Cell(25, 5, '', '', 0, 'l', false);
//             $pdf->Cell(0, 5, $rowtitle2['account_name'], '', 1, 'l', false); 
//         }
//     }
// }

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Non Cash Expenses', '', 1, 'L', false);

// $value3 = 'Non Cash Expense';
// $sql3 = $conn->prepare("SELECT * FROM tbl_account_class INNER JOIN tbl_account_type ON tbl_account_class.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :acc_type");
// $sql3->bindParam(':acc_type', $value3);
// $sql3->execute();
// $data3 = $sql3->fetchAll(PDO::FETCH_ASSOC);

// foreach ($data3 as $row4) {
//     $pdf->SetFont('Times', 'I', 12);
//     $pdf->Cell(15, 10, '', '', 0, 'l', false);
//     $pdf->Cell(0, 10, $row4['class_name'], '', 1, 'l', false);

//     $sqltitle3 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
//     $sqltitle3->bindParam(':class_id', $row4['class_id']);
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

// $pdf->Cell(10, 6, '', '', 0, 'L', false);
// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Total Maintenance and Other Operating Expense', '', 1, 'L', false);

// $pdf->Cell(10, 6, '', '', 0, 'L', false);
// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Financial Expense', '', 1, 'L', false);

// // Equity Titles
// $f_expense = 'Financial Expense';
// $sqltitle4 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_type = :a_title");
// $sqltitle4 ->bindParam(':a_title', $f_expense);
// $sqltitle4->execute();
// $datatitle4 = $sqltitle4->fetchAll(PDO::FETCH_ASSOC);

// foreach ($datatitle4 as $rowtitle4){
//     $pdf->SetFont('Times', '', 12);
//     $pdf->Cell(25, 5, '', '', 0, 'l', false);
//     $pdf->Cell(0, 5, $rowtitle4['account_name'], '', 1, 'l', false); 
    
// }

// $pdf->Cell(10, 6, '', '', 0, 'L', false);
// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 6, 'Total Financial Expense', '', 1, 'L', false);




// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 10, 'Total Expenses', '', 1, 'L', false);

// $pdf->SetFont('Times', 'B', 12);
// $pdf->Cell(0, 10, 'Net Income', '', 1, 'L', false);
$incomeTotal = 0;
$incomeAmount = 0;
$incomestatement = 'Income Statement';
$sqlfirst = $conn->prepare("SELECT * FROM tbl_main_account_type WHERE reports_included = :istatement");
$sqlfirst->bindParam(':istatement', $incomestatement);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultfirst as $rowfirst) {
    $pdf->SetFont('Times', 'B', 12);
    $account_type = $rowfirst['main_type_name'];
    $pdf->Cell(50, 10, $account_type, '', 1, 'l', false);

    $income = $rowfirst['main_type_name'];
    $sqlsecond = $conn->prepare("SELECT * FROM tbl_account_type INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_main_account_type.main_type_name = :a_title");
    $sqlsecond->bindParam(':a_title', $income);
    $sqlsecond->execute();
    $datasecond = $sqlsecond->fetchAll(PDO::FETCH_ASSOC);
    foreach($datasecond as $rowsecond){
        if ($rowfirst['main_type_name'] === "Income"){
            
            $rowIncome = $rowsecond['type_code'];
            $sqlthird = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code WHERE tbl_account_type.type_code = :type_code");
            $sqlthird->bindParam(':type_code', $rowIncome);
            $sqlthird->execute();
            $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);

            foreach ($datathird as $rowthird) {
                $pdf->SetFont('Times', '', 12);
                $pdf->Cell(10, 5, '', '', 0, 'l', false);
                $pdf->Cell(100, 6, $rowthird['account_name'], '', 0, 'L', false);
            
                $account_name = $rowthird['account_name'];
            
                // Prepare the SQL query
                $sqlfourth = $conn->prepare("
                    SELECT 
                        tbl_account_title.account_code AS Acode, 
                        tbl_account_title.account_name, 
                        SUM(CASE 
                            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit 
                                THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit 
                                THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            ELSE 0 
                        END) AS debit_balance, 
                        SUM(CASE 
                            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit 
                                THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit 
                                THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            ELSE 0 
                        END) AS credit_balance 
                    FROM tbl_account_title 
                    INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
                    INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
                    INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
                    WHERE tbl_account_title.account_name = :account_name 
                    AND fiscal_id = :fiscal_id 
                    GROUP BY tbl_account_title.account_code, tbl_account_title.account_name 
                    ORDER BY tbl_account_title.account_code
                ");


            
                // Bind parameters and execute the query
                $sqlfourth->bindParam(':account_name', $account_name);
                $sqlfourth->bindParam(':fiscal_id', $fiscal_id);
                $sqlfourth->execute();
                $datafourth = $sqlfourth->fetchAll(PDO::FETCH_ASSOC);
                $valueZero = 0;
                // Check if any data was fetched
                if ($datafourth) {
                    foreach ($datafourth as $rowfourth) {
                        $debitbalance = $rowfourth['debit_balance'];
                        $creditbalance = $rowfourth['credit_balance'];
            
                        // If both debit and credit balances are zero, display 0.00
                        if ($debitbalance == 0 && $creditbalance == 0) {
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                        } else {
                            // Display the higher balance (either debit or credit)
                            $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);
                            $incomeTotal += $balanceToShow;
                        }
                    }
                } else {
                    // If no data was found, still show 0.00 for the account
                    $pdf->Cell(55, 6, '', '', 0, 'L', false);
                    $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                    
                }
            }
            
               

                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(80, 6, 'Total Income', '', 0, 'L', false);
                $pdf->Cell(85, 6, '', '', 0, 'L', false);
                $pdf->Cell(0, 6, number_format($incomeTotal, 2), '', 1, 'R', false);
                $incomeAmount += $incomeTotal;
            
        } // End of Income Validation 
         else {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(10, 5, '', '', 0, 'l', false);
            $pdf->Cell(0, 6, $rowsecond['account_type'], '', 1, 'L', false);

            if ($rowsecond['account_type'] === "Financial Expense"){
                $fin_expense = "Financial Expense";
                $sqlthird = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code WHERE tbl_account_type.account_type = :type_code");
                $sqlthird->bindParam(':type_code', $fin_expense);
                $sqlthird->execute();
                $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datathird as $rowthird){
                    $pdf->SetFont('Times', '', 12);
                    $pdf->Cell(20, 5, '', '', 0, 'l', false);
                    $pdf->Cell(75, 6, $rowthird['account_name'], '', 0, 'L', false);
                    
                                        // Prepare the SQL query
                $sqlfifth = $conn->prepare("
                SELECT 
                    tbl_account_title.account_code AS Acode, 
                    tbl_account_title.account_name, 
                    SUM(CASE 
                        WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit 
                            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit 
                            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                    END) AS debit_balance, 
                    SUM(CASE 
                        WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit 
                            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit 
                            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                    END) AS credit_balance 
                FROM tbl_account_title 
                INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
                INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
                INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
                WHERE tbl_account_title.account_name = :account_name 
                AND fiscal_id = :fiscal_id 
                GROUP BY tbl_account_title.account_code, tbl_account_title.account_name 
                ORDER BY tbl_account_title.account_code
            ");
        
            // Bind parameters and execute the query
            $sqlfifth->bindParam(':account_name', $account_name);
            $sqlfifth->bindParam(':fiscal_id', $fiscal_id);
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
                                $pdf->Cell(70, 6, '', '', 0, 'L', false);
                                $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                            } else {
                                $pdf->SetFont('Times', '', 12);
                                // Display the higher balance (either debit or credit)
                                $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                $pdf->Cell(70, 6, '', '', 0, 'L', false);
                                $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);
                            }
                        }
                        } else {
                        $pdf->SetFont('Times', '', 12);
                        // If no data was found, still show 0.00 for the account
                        $pdf->Cell(70, 6, '', '', 0, 'L', false);
                        $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                
                        }
                    }
                
                    $pdf->Cell(10, 6, '', '', 0, 'L', false);
                    $pdf->SetFont('Times', 'B', 12);
                    $pdf->Cell(100, 6, 'Total Financial Expense', '', 0, 'L', false);

                    $sqltotalfinExpense = $conn->prepare("SELECT tbl_account_type.type_code AS type_code, tbl_account_type.account_type AS account_type,
                        SUM(CASE 
                        WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                            WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                        END) AS debit_balance, 
                        SUM(CASE 
                            WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                            WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                        END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_type.type_code = :type_code2 AND fiscal_id = :fiscal_id GROUP BY tbl_account_type.type_code, tbl_account_type.account_type ORDER BY tbl_account_title.account_code");
                        $sqltotalfinExpense->bindParam(":type_code2", $rowsecond['type_code']);
                        $sqltotalfinExpense->bindParam(":fiscal_id", $fiscal_id);
                        $sqltotalfinExpense->execute();
                        $datafinexpense = $sqltotalfinExpense->fetch(PDO::FETCH_ASSOC);

                        $debitbalanceTotal = $datafinexpense['debit_balance'] ?? 0;
                        $creditbalanceTotal = $datafinexpense['credit_balance'] ?? 0;

                        if ($debitbalanceTotal > $creditbalanceTotal){
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 10, $debitbalanceTotal , '', 1, 'R', false);
                        } else if ($creditbalanceTotal > $debitbalanceTotal) {
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 10, $creditbalanceTotal , '', 1, 'R', false);
                        } else {
                            $pdf->Cell(55, 6, '', '', 0, 'L', false);
                            $pdf->Cell(0, 10, '0.00' , '', 1, 'R', false);
                        }
                        
                       
            } else {
                
            // Account
            $type_code = $rowsecond['type_code'];
            $sqlthird = $conn->prepare("SELECT * FROM tbl_account_class WHERE type_code = :type_code");
            $sqlthird->bindParam(':type_code', $type_code);
            $sqlthird->execute();
            $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);
            
            
            // $rowIncome = $rowsecond['type_code'];
            // $sqlthird = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code WHERE tbl_account_type.type_code = :type_code");
            // $sqlthird->bindParam(':type_code', $rowIncome);
            // $sqlthird->execute();
            // $datathird = $sqlthird->fetchAll(PDO::FETCH_ASSOC);

            
            foreach ($datathird as $rowthird){
                $pdf->SetFont('Times', '', 12);
                $pdf->Cell(20, 5, '', '', 0, 'l', false);
                $pdf->Cell(0, 6, $rowthird['class_name'], '', 1, 'L', false);
                

                $sqlfourth = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_account_class ON tbl_account_class.class_id = tbl_account_title.class_id WHERE tbl_account_class.class_id = :class_id");
                $sqlfourth->bindParam(':class_id', $rowthird['class_id']);
                $sqlfourth->execute();
                $datafourth = $sqlfourth->fetchAll(PDO::FETCH_ASSOC);

                foreach ($datafourth as $rowfourth) {
                    $pdf->SetFont('Times', 'I', 12);
                    $pdf->Cell(25, 5, '', '', 0, 'l', false);
                    $pdf->Cell(100, 6, $rowfourth['account_name'], '', 0, 'L', false);


                // Prepare the SQL query
                $sqlfifth = $conn->prepare("
                SELECT 
                    tbl_account_title.account_code AS Acode, 
                    tbl_account_title.account_name, 
                    SUM(CASE 
                        WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit 
                            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        WHEN tbl_account_type.normal_balance = 'Debit' AND tbl_trial_balance.total_debit < tbl_trial_balance.total_credit 
                            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                        ELSE 0 
                    END) AS debit_balance, 
                    SUM(CASE 
                        WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit 
                            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        WHEN tbl_account_type.normal_balance = 'Credit' AND tbl_trial_balance.total_credit < tbl_trial_balance.total_debit 
                            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                        ELSE 0 
                    END) AS credit_balance 
                FROM tbl_account_title 
                INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
                INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
                INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
                WHERE tbl_account_title.account_name = :account_name 
                AND fiscal_id = :fiscal_id 
                GROUP BY tbl_account_title.account_code, tbl_account_title.account_name 
                ORDER BY tbl_account_title.account_code
            ");
        $totalNonCash= 0;
        $totalMaintenance = 0;
            // Bind parameters and execute the query
            $sqlfifth->bindParam(':account_name', $account_name);
            $sqlfifth->bindParam(':fiscal_id', $fiscal_id);
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
                                $pdf->Cell(50, 6, '', '', 0, 'L', false);
                                $pdf->Cell(0, 6, '0.00', '', 1, 'R', false);
                            } else {
                                $pdf->SetFont('Times', '', 12);
                                // Display the higher balance (either debit or credit)
                                $balanceToShow = ($debitbalance > $creditbalance) ? $debitbalance : $creditbalance;
                                $pdf->Cell(50, 6, '', '', 0, 'L', false);
                                $pdf->Cell(0, 6, number_format($balanceToShow, 2), '', 1, 'R', false);
                            }
                        }
                        } else {
                        $pdf->SetFont('Times', '', 12);
                        // If no data was found, still show 0.00 for the account
                        $pdf->Cell(40, 6, '', '', 0, 'L', false);
                        $pdf->Cell(0, 6, number_format($valueZero,2), '', 1, 'R', false);
                
                        }
                    }
                
                }
                // if ( $rowsecond['account_type'] === 'Non Cash Expense') {
                //     $pdf->Cell(10, 6, '', '', 0, 'L', false);
                //     $pdf->SetFont('Times', 'B', 12);
                //     $pdf->Cell(0, 6, 'Total ' . 'Maintenance and Other Operating Expenses', '', 1, 'L', false); 
                    
                //     $sqlsixth = $conn->prepare("SELECT tbl_account_type.type_code AS type_code, tbl_account_type.account_type AS account_type,
                //         SUM(CASE 
                //         WHEN tbl_trial_balance.total_debit >= tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                //             WHEN tbl_trial_balance.total_debit < tbl_trial_balance.total_credit THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit
                //         ELSE 0 
                //         END) AS debit_balance, 
                //         SUM(CASE 
                //             WHEN tbl_trial_balance.total_credit >= tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                //             WHEN tbl_trial_balance.total_credit < tbl_trial_balance.total_debit THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit
                //         ELSE 0 
                //         END) AS credit_balance FROM tbl_account_title INNER JOIN tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code INNER JOIN tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code INNER JOIN tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id WHERE tbl_account_type.type_code = :type_code2 AND fiscal_id <= :fiscal_id GROUP BY tbl_account_type.type_code, tbl_account_type.account_type ORDER BY tbl_account_title.account_code");
                        


                // } else if ($rowsecond['account_type'] === 'Maintenance and Other Operating Expenses'){
                //     $pdf->SetFont('Times', 'B', 12);
                //     $pdf->Cell(0, 6, '', '', 1, 'L', false); 
                // }
                    
                    $sqlsixth = $conn->prepare("SELECT tbl_account_type.type_code AS type_code, tbl_account_type.account_type AS account_type,
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

                         // Bind parameters and execute the query
                        $type_code = $rowsecond['type_code'];
                        $sqlsixth->bindParam(':type_code2', $type_code);
                        $sqlsixth->bindParam(':fiscal_id', $fiscal_id);
                        $sqlsixth->execute();
                        $datasixth = $sqlsixth->fetch(PDO::FETCH_ASSOC);

                    $pdf->Cell(10, 6, '', '', 0, 'L', false);
                    $pdf->SetFont('Times', 'B', 12);
                    $pdf->Cell(20, 6, 'Total ' . $rowsecond['account_type'], '', 0, 'L', false);
                    $pdf->Cell(80, 6, '', '', 0, 'L', false);

                    $debitbalanceTotal2 = $datasixth['debit_balance'] ?? 0;
                    $creditbalanceTotal2 = $datasixth['credit_balance'] ?? 0;
                        

                        $pdf->Cell(55, 10, ''  , '', 0, 'l', false);
                        if ($debitbalanceTotal2 > $creditbalanceTotal2){
                            $pdf->Cell(0, 10, number_format($debitbalanceTotal2,2) , '', 1, 'R', false);
                        } else if ($creditbalanceTotal2 > $debitbalanceTotal2) {
                            $pdf->Cell(0, 10, number_format($creditbalanceTotal2,2) , '', 1, 'R', false);
                        } else {
                            $pdf->Cell(0, 10, '0.00' , '', 1, 'R', false);
                        }
                        
                    
               



               
            }

            
               
            
           
        }
       
    }
        // $pdf->SetFont('Times', 'B', 12);
        // $pdf->Cell(0, 15, 'Total ' . 'Expenses', '', 1, 'L', false); 

        //     $pdf->SetFont('Times', 'B', 12);
        //     $pdf->Cell(0, 10, 'Net Income', '', 1, 'L', false);
$expenseAmount = 0;
if($rowfirst['main_type_name'] === "Less:Expenses"){
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(90, 15, 'Total ' . 'Expenses', '', 0, 'L', false); 
    
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
    
        $expense = 0;
        $pdf->Cell(75, 10, '','', 0, 'l', false);
        if ($debitbalanceTotal > $creditbalanceTotal){
            $pdf->Cell(10, 10, number_format($debitbalanceTotal,2) , 'B', 1, 'R', false);
            $expenseAmount += $debitbalanceTotal;

        } else if ($creditbalanceTotal > $debitbalanceTotal) {
            $pdf->Cell(0, 10, number_format($creditbalanceTotal,2) , 'B', 1, 'R', false);
            $expenseAmount += $creditbalanceTotal;
        } else {
            $pdf->Cell(0, 10, '0.00' , 'B', 1, 'R', false);
            $expenseAmount = 0;
        }

        $pdf->SetFont('Times', 'B', 12);
        if ($incomeAmount > $expenseAmount){
            $pdf->Cell(20, 10, 'Net Income', '', 0, 'L', false);
            $pdf->Cell(140, 10, '', '', 0, 'L', false);
            $pdf->Cell(0, 10, number_format($incomeAmount - $expenseAmount,2), '', 1, 'R', false);
        } else {
            $pdf->Cell(20, 10, 'Net Loss', '', 0, 'L', false);
            $pdf->Cell(140, 10, '', '', 0, 'L', false);
            $pdf->Cell(0, 10, number_format($incomeAmount - $expenseAmount,2), '', 1, 'R', false);
        }
        // $pdf->Cell(20, 10, 'Net Income', '', 0, 'L', false);
        // $pdf->Cell(80, 10, '', '', 0, 'L', false);

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

$pdf->Output()
?>