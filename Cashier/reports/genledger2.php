<?php
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

// Instantiation of inherited class
$pdf = new PDF();
$pdf->SetTitle('GENERAL LEDGER');
// Disable the default header and footer
$pdf->setPrintHeader(true);

// Adding page and setting font
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('arialbd', 'B', 11);



$date_to = $_GET['date_to'];
$date_from = $_GET['date_from'];
$fiscal_id = $_SESSION['fiscal_id'];

$dateTo = DateTime::createFromFormat('Y-m-d', $date_to);
$datetoValue = $dateTo->format('F, d, Y');

$dateFrom = DateTime::createFromFormat('Y-m-d', $date_from);
$datefromValue = $dateFrom->format('F, d, Y');

$sql0 = $conn->prepare("SELECT * FROM tbl_account_title INNER JOIN tbl_general_ledger ON tbl_account_title.account_code = tbl_general_ledger.account_code WHERE fiscal_id = :fiscal_id GROUP BY tbl_account_title.account_code");
$sql0->bindParam(':fiscal_id', $fiscal_id);
$sql0->execute();
$result0 = $sql0->fetchAll(PDO::FETCH_ASSOC);

// Texts
$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'C', false);
$pdf->Cell(0, 6, 'General Ledger', '', 1, 'C', false);
$pdf->Cell(0, 6, $datefromValue . ' - ' . $datetoValue, '', 1, 'C', false);

foreach ($result0 as $row0) {
    $account_code = $row0['account_code'];
    $pdf->Cell(0, 6, $row0['account_name'], '', 1, 'L', false);

    $pdf->Cell(0, 6, '', '', 1, 'L', false);
    $pdf->Cell(40, 6, 'Date', 'LRTB', 0, 'L', false);
    $pdf->Cell(50, 6, 'Particulars', 'LRTB', 0, 'L', false);
    $pdf->Cell(45, 6, 'Posting Reference', 'LRTB', 0, 'L', false);
    $pdf->Cell(30, 6, 'DR', 'LRTB', 0, 'L', false);
    $pdf->Cell(30, 6, 'CR', 'LRTB', 1, 'L', false); // Added a new line here

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

        // Output the date
        $pdf->Cell(40, $maxHeight, $row1['ledger_date'], 'LRB', 0, 'L', false);

        // MultiCell for the description
        $pdf->MultiCell(50, $maxHeight, $description, 'LRB', 'L', false);

        // Set the X position for the next cells (after MultiCell)
        $pdf->SetXY(100, $pdf->GetY() - $maxHeight); // Set back to the Y position before MultiCell

        // Output the journal voucher number
        $pdf->Cell(45, $maxHeight, $row1['journal_voucher_no'], 'LRB', 0, 'L', false);

        // Check if the debit or credit is greater and display accordingly
        if ($row1['debit'] > 0) {
            $pdf->Cell(30, $maxHeight, number_format($row1['debit'], 2), 'LRBT', 0, 'R', false);
            $pdf->Cell(30, $maxHeight, '', 'LRBT', 1, 'L', false);
            $total_debit += $row1['debit'];
        } else {
            $pdf->Cell(30, $maxHeight, '', 'LRBT', 0, 'L', false);
            $pdf->Cell(30, $maxHeight, number_format($row1['credit'], 2), 'LRBT', 1, 'R', false);
            $total_credit += $row1['credit'];
        }
    }

    // Totals and Balance Calculation
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(40, 6, 'Total Balance', 'TRBL', 0, 'L', false);
    $pdf->Cell(50, 6, '', 'TRB', 0, 'L', false);
    $pdf->Cell(45, 6, '', 'TRB', 0, 'L', false);

    $balance = $total_debit - $total_credit;

    if ($balance > 0) {
        $pdf->Cell(30, 6, number_format($balance, 2), 'TRB', 0, 'R', false); // Show balance in debit
        $pdf->Cell(30, 6, '', 'TRB', 1, 'L', false); // Leave credit empty
    } elseif ($balance < 0) {
        $pdf->Cell(30, 6, '', 'TRB', 0, 'L', false); // Leave debit empty
        $pdf->Cell(30, 6, number_format(abs($balance), 2), 'TRB', 1, 'R', false); // Show balance in credit
    } else {
        $pdf->Cell(30, 6, '0.00', 'TRB', 0, 'L', false); 
        $pdf->Cell(35, 6, '', 'TRB', 1, 'L', false); 
    }
    $pdf->AddPage();
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

// // Prepare to check for page break
// $maxY = 270; // Define the maximum Y position before the bottom margin (e.g., 297mm - 27mm)

// // Prepare By
// $pdf->Cell(50, 6, 'Prepared By:', '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, 'Noted By:', '', 1, 'l', false);

// // Check if there's enough space for the next content
// if ($pdf->GetY() > $maxY) {
//     $pdf->AddPage();
// }

// // Add spacing before the signatories
// $pdf->Ln(10); 

// $pdf->SetFont('Times', '', 12);
// $pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
// $pdf->Cell(100, 6, '', '', 0, 'l', false);
// $pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);

// // Check again if there's enough space for the position
// if ($pdf->GetY() > $maxY) {
//     $pdf->AddPage();
// }

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
$pdf->SetFont('Times', '', 12);
$pdf->Cell(50, 6, "$fname $mname $lname", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_fname $sig_mname $sig_lname", '', 1, 'l', false);

$pdf->Cell(50, 6, "$position", '', 0, 'l', false);
$pdf->Cell(100, 6, '', '', 0, 'l', false);
$pdf->Cell(50, 6, "$sig_position", '', 1, 'l', false);

$pdf->Output();
?>
