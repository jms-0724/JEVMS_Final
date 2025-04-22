<?php
session_start();
require('tcpdf/tcpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

class PDF extends TCPDF
{
    // Page footer
    function Footer()
    {
        // Implement footer if needed
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$pdf->SetTitle('GENERAL LEDGER');
// Disable the default header and footer
$pdf->setPrintHeader(false);


// Adding page and setting font
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('arialbd', 'B', 12);


// Set transparency for the watermark
$pdf->SetAlpha(0.3);

// Add the watermark image (adjust the path and dimensions as needed)
$pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Reset the alpha to full opacity
$pdf->SetAlpha(1);

$account_code = $_GET['account_code'];
$date_to = $_GET['date_to'];
$date_from = $_GET['date_from'];

$dateTo = DateTime::createFromFormat('Y-m-d', $date_to);
$datetoValue = $dateTo->format('F, d, Y');

$dateFrom = DateTime::createFromFormat('Y-m-d', $date_from);
$datefromValue= $dateFrom->format('F, d, Y');

$sql0 = $conn->prepare("SELECT * FROM tbl_account_title WHERE account_code = :account_code");
$sql0->bindParam(':account_code', $account_code);
$sql0->execute();
$result0 = $sql0->fetch(PDO::FETCH_ASSOC);

// Texts
$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->Cell(0, 6, 'General Ledger', '', 1, 'C', false);
$pdf->Cell(0, 6, $result0['account_name'], '', 1, 'C', false);
$pdf->Cell(0, 6, $datefromValue . ' to ' . $datetoValue, '', 1, 'C', false);


$pdf->Cell(0, 6, '', '', 1, 'L', false);
$pdf->Cell(40, 6, 'Date', 'LTRB', 0, 'L', false);
$pdf->Cell(50, 6, 'Particulars', 'LTRB', 0, 'L', false);

$pdf->Cell(40, 6, 'Posting Reference', 'LTRB', 0, 'L', false);
$pdf->Cell(30, 6, 'DR', 'LTRB', 0, 'L', false);
$pdf->Cell(30, 6, 'CR', 'LTRB', 1, 'L', false); // Added a new line here

$fiscal_id = $_SESSION['fiscal_id'];

$sql1 = $conn->prepare("SELECT * FROM tbl_general_ledger INNER JOIN tbl_journal_entry ON tbl_general_ledger.journal_voucher_id = tbl_journal_entry.journal_voucher_id INNER JOIN tbl_account_title ON tbl_general_ledger.account_code = tbl_account_title.account_code WHERE tbl_general_ledger.ledger_date BETWEEN :fromDate AND :toDate AND tbl_account_title.account_code = :account_code2 AND tbl_general_ledger.fiscal_id = :fiscal_id ORDER BY journal_date ASC, journal_voucher_no ASC");
$sql1->bindParam("fiscal_id", $fiscal_id, PDO::PARAM_INT);
$sql1->bindParam(':account_code2', $account_code);
$sql1->bindParam("fromDate", $date_from);
$sql1->bindParam(':toDate', $date_to);
$sql1->execute();
$result1 = $sql1->fetchAll(PDO::FETCH_ASSOC);

$total_debit = 0;
$total_credit = 0;
foreach ($result1 as $row1) {
    $pdf->SetFont('arial', '', 11);

      // Determine the max height by first checking all the contents
      $description = $row1['description'];
      $pdf->SetXY(10, $pdf->GetY()); // Reset X position for each row
      $maxHeight = max($pdf->getStringHeight(50, $description), 6); // Assuming 6 is the minimum cell height
    
    // Save the current Y position for the multi-cell height calculation
    $yBefore = $pdf->GetY();

    // Output the date first
    $pdf->Cell(40, $maxHeight, $row1['ledger_date'], 'LRB', 0, 'L', false);
    
    // Create a MultiCell for the description (50 width)
    $pdf->MultiCell(50, $maxHeight, $row1['description'], 'LRB', 'L', false);
    
    // Calculate the height of the MultiCell
    $yAfter = $pdf->GetY();
    $cellHeight = $yAfter - $yBefore;

    // Set X position for the journal voucher number and debit/credit cells
    $pdf->SetXY(100, $yBefore); // Adjust X position accordingly

    // Output the journal voucher number
    $pdf->Cell(40, $cellHeight, $row1['journal_voucher_no'], 'LRB', 0, 'L', false);

    // Check if the debit or credit is greater and display accordingly
    if ($row1['debit'] > 0) {
        $pdf->Cell(30, $cellHeight, number_format($row1['debit'], 2), 'LRB', 0, 'R', false);
        $pdf->Cell(30, $cellHeight, '', 'LRB', 1, 'L', false);
        $total_debit += $row1['debit'];
    } else {
        $pdf->Cell(30, $cellHeight, '', 'LRB', 0, 'L', false);
        $pdf->Cell(30, $cellHeight, number_format($row1['credit'], 2), 'LRB', 1, 'R', false);
        $total_credit += $row1['credit'];
    }
}



// Totals and Balance Calculation
$pdf->SetFont('helvetica', 'B', 12); 
$pdf->Cell(40, 6, 'Total Balance', 'TBLR', 0, 'L', false);
$pdf->Cell(50, 6, '', 'TBR', 0, 'L', false);
$pdf->Cell(40, 6, '', 'TBLR', 0, 'L', false);

$balance = $total_debit - $total_credit;

if ($balance > 0) {
    // Display the balance in the debit column if debit is higher
    $pdf->Cell(30, 6, number_format($balance, 2), 'TRLB', 0, 'R', false); // Show balance in debit
    $pdf->Cell(30, 6, '', 'TRLB', 1, 'L', false); // Leave credit empty
} elseif ($balance < 0) {
    // Display the balance in the credit column if credit is higher
    $pdf->Cell(30, 6, '', 'TRLB', 0, 'L', false); // Leave debit empty
    $pdf->Cell(30, 6, number_format(abs($balance), 2), 'TRLB', 1, 'R', false); // Show absolute value of balance in credit
} else {
    // If the debit and credit are equal, show zeros in both
    $pdf->Cell(30, 6, '', 'TRLB', 0, 'L', false); 
    $pdf->Cell(30, 6, '', 'TRLB', 1, 'L', false); 
}

//  $pdf->Cell(30, 6, number_format($total_debit, 2), 'T', 0, 'L', false);
//  $pdf->Cell(30, 6, number_format($total_credit, 2), 'T', 1, 'L', false);
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

// $pdf->SetFont('arial', '', 12);
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
      $sqlsignatory->bindParam(":start_time", $date_to);
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
