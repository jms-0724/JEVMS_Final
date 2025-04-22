<?php
// Trial Balance Report
session_start();
require(__DIR__ . '/tcpdf/tcpdf.php');
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
$pdf->SetTitle('Trial Balance');
// Disable the default header and footer
$pdf->setPrintHeader(true);

$dateto = $_GET['date_to'];
$date = DateTime::createFromFormat('Y-m-d', $dateto);
$datetoValue = $date->format('F, d, Y');

$dateFrom = $_GET['date_from'];
$date2 = DateTime::createFromFormat('Y-m-d', $dateFrom);
$datefromValue = $date2->format('F, d, Y');

$pdf->AddPage('P', 'Letter');
$pdf->SetFont('arialbd', 'B', 12);



$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'L', false);
$pdf->Cell(0, 6, 'Trial Balance', '', 1, 'L', false);
$pdf->Cell(0, 6, 'As of ' . $datefromValue . '- '. $datetoValue, '', 1, 'L', false);

$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(125, 6, 'Account Titles', 'LRTB', 0, 'L', false);
$pdf->Cell(30, 6, 'DR', 'LRTB', 0, 'L', false);
$pdf->Cell(30, 6, 'CR', 'LRTB', 1, 'L', false);
// $pdf->Cell(0, 6, '', 'B', 1, 'L', false);


$fiscal_id = $_SESSION['fiscal_id']; 
$current_fiscal_year = $fiscal_id;
// if (isset($_GET['date_from']) && $_GET['date_to']){

// }
// else {

// }
if (isset($_GET['date_from']) && $_GET['date_to']){
    $sql2 = $conn->prepare("SELECT 
    tbl_account_title.account_code AS Acode, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included,
    SUM(tbl_trial_balance.total_debit) AS total_debit,
    SUM(tbl_trial_balance.total_credit) AS total_credit
FROM 
    tbl_account_title 
INNER JOIN 
    tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
INNER JOIN 
    tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
INNER JOIN 
    tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
WHERE 
    tbl_trial_balance.fiscal_id <= :fiscal_id
    AND (
        -- For balance sheet accounts, no date range is applied
        tbl_main_account_type.reports_included <> 'Income Statement'
        OR 
        -- For income statement accounts, apply the date range filter
        (tbl_main_account_type.reports_included = 'Income Statement' 
         AND tbl_trial_balance.trial_balance_date BETWEEN :fromdate2 AND :todate2)
    ) AND tbl_trial_balance.trial_balance_date <= :cutoff_date
GROUP BY 
    tbl_account_title.account_code, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included


");

// Bind parameters
$sql2->bindParam(':fiscal_id', $fiscal_id);
$sql2->bindParam(':fromdate2', $dateFrom);
$sql2->bindParam(':todate2', $dateto);
$sql2->bindParam(':cutoff_date', $dateto);



$sql2->execute();
$data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);


} else {
    $sql2 = $conn->prepare("
    SELECT 
    tbl_account_title.account_code AS Acode, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included,
    SUM(tbl_trial_balance.total_debit) AS total_debit,
    SUM(tbl_trial_balance.total_credit) AS total_credit,
    SUM(CASE 
            WHEN tbl_trial_balance.total_debit > tbl_trial_balance.total_credit 
            THEN tbl_trial_balance.total_debit - tbl_trial_balance.total_credit 
            ELSE 0 
        END) AS debit_balance,
    SUM(CASE 
            WHEN tbl_trial_balance.total_credit > tbl_trial_balance.total_debit 
            THEN tbl_trial_balance.total_credit - tbl_trial_balance.total_debit 
            ELSE 0 
        END) AS credit_balance
FROM 
    tbl_account_title 
INNER JOIN 
    tbl_trial_balance ON tbl_trial_balance.account_code = tbl_account_title.account_code 
INNER JOIN 
    tbl_account_type ON tbl_account_title.type_code = tbl_account_type.type_code 
INNER JOIN 
    tbl_main_account_type ON tbl_account_type.main_type_id = tbl_main_account_type.main_type_id 
WHERE 
    -- For balance sheet accounts, include past fiscal years' balances
    (tbl_main_account_type.reports_included <> 'Income Statement'
     OR (tbl_main_account_type.reports_included = 'Income Statement' 
         AND tbl_trial_balance.fiscal_id = :current_fiscal_year)) 
    AND tbl_trial_balance.fiscal_id <= :fiscal_id 
GROUP BY 
    tbl_account_title.account_code, 
    tbl_account_title.account_name, 
    tbl_main_account_type.reports_included
");

// Bind parameters
$sql2->bindParam(':fiscal_id', $fiscal_id);
$sql2->bindParam(':current_fiscal_year', $current_fiscal_year); 
$sql2->execute();
$data2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

}


    
$total_debit = 0;
$total_credit = 0;
$pdf->SetFont('arial', '', 12);

foreach ($data2 as $row2) {
    $pdf->Cell(125, 7, $row2['account_name'], 'LTRB', 0, 'L', false);

    // Get the debit and credit balances
    $debit_balance = $row2['total_debit'];
    $credit_balance = $row2['total_credit'];

    // Calculate the net balance
    $net_balance = $debit_balance - $credit_balance;

    // Display the net balance; if it's positive, show debit, else show credit
    if ($net_balance > 0) {
        $pdf->Cell(30, 7, number_format($net_balance, 2), 'LTRB', 0, 'R', false);
        $pdf->Cell(30, 7, '', 'LTRB', 1, 'L', false);
        // Add to the total debit
        $total_debit += $net_balance; // Only add the net positive balance to total_debit
    } else {
        $pdf->Cell(30, 7, '', 'LTRB', 0, 'L', false);
        $pdf->Cell(30, 7, number_format(abs($net_balance), 2), 'LTRB', 1, 'R', false); // Display as credit
        // Add to the total credit
        $total_credit += abs($net_balance); // Only add the absolute value to total_credit
    }
}


// Display the total debits and credits (larger amounts)
$pdf->SetFont('arialbd', 'B', 12);
$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(125, 6, 'Total', 'LTRB', 0, 'L', false);
$pdf->Cell(30, 6, number_format($total_debit, 2), 'LTRB', 0, 'L', false);
$pdf->Cell(30, 6, number_format($total_credit, 2), 'LTRB', 1, 'L', false);

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
      $sqlsignatory->bindParam(":start_time",$dateto);
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
$pdf->SetFont('arial', '', 12);
$pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);

$pdf->Cell(50, 6, "$position", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);
    

$pdf->Output();
?>