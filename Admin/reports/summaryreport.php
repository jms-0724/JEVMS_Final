<?php
// Balance Sheet Report
session_start();
require('tcpdf/tcpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

$pdf = new TCPDF();
$pdf->SetTitle('Journal Summary Sheet');

// Disable the default header and footer
$pdf->setPrintHeader(false);



$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Times', 'B', 11);

// Set transparency for the watermark
$pdf->SetAlpha(0.3);

// Add the watermark image (adjust the path and dimensions as needed)
$pdf->Image('./img/bwd_logo2.png', 50, 70, 100, 100, '', '', '', false, 300, '', false, false, 0, false, false, false);

// Reset the alpha to full opacity
$pdf->SetAlpha(1);

$getValue = $_GET['date_to'];
$datetoday = date('Y/m/d');
$fiscal_id = $_SESSION['fiscal_id'];

$date = DateTime::createFromFormat('Y-m-d', $getValue);
$valueDate = $date->format('F, d, Y');
$valueDate2 = $date->format('F, Y');


$pdf->Cell(0, 6, 'BALAOAN WATER DISTRICT', '', 1, 'L', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, 'Balaoan, La Union', '', 1, 'L', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(0, 6, 'Summary for the month of ' . $valueDate2, '', 1, 'L', false);
$pdf->SetFont('Times', '', 12);
$pdf->Cell(0, 6, '', '', 1, 'C', false);


$fiscal_id = $_SESSION['fiscal_id'];
if  (isset($_GET['date_from']) && $_GET['date_to']){
    $datefrom = $_GET['date_from'];
    $dateto = $_GET['date_to'];
    
    $sqlfirst = $conn->prepare("
    SELECT 
        tbl_account_title.account_code AS account_code, 
        tbl_account_title.account_name AS account_name,
        tbl_journal_items.journal_adjustment AS journal_adjustment,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'debit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_debit,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'credit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_credit
    FROM 
        tbl_journal_items 
    INNER JOIN 
        tbl_journal_entry ON tbl_journal_items.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
    INNER JOIN 
        tbl_journal_category ON tbl_journal_entry.category_id = tbl_journal_category.category_id 
    INNER JOIN 
        tbl_account_title ON tbl_account_title.account_code = tbl_journal_items.account_code 
    WHERE 
        tbl_journal_entry.fiscal_id = :fiscal_id AND tbl_journal_entry.journal_date BETWEEN :fromDate AND :toDate
    GROUP BY 
        tbl_account_title.account_code
");
$sqlfirst->bindParam("fiscal_id", $fiscal_id, PDO::PARAM_INT);
$sqlfirst->bindParam("fromDate", $datefrom);
$sqlfirst->bindParam("toDate", $dateto);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll();

} else if (isset($_GET['date_from']) && $_GET['date_to'] && $_GET['category_id']){
    $datefrom = $_GET['date_from'];
    $dateto = $_GET['date_to'];
    $category_id = $_GET['category_id'];

    $sqlfirst = $conn->prepare("
    SELECT 
        tbl_account_title.account_code AS account_code, 
        tbl_account_title.account_name AS account_name,
        tbl_journal_items.journal_adjustment AS journal_adjustment,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'debit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_debit,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'credit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_credit
    FROM 
        tbl_journal_items 
    INNER JOIN 
        tbl_journal_entry ON tbl_journal_items.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
    INNER JOIN 
        tbl_journal_category ON tbl_journal_entry.category_id = tbl_journal_category.category_id 
    INNER JOIN 
        tbl_account_title ON tbl_account_title.account_code = tbl_journal_items.account_code 
    WHERE 
        tbl_journal_entry.fiscal_id = :fiscal_id AND tbl_journal_entry.journal_date BETWEEN :fromDate AND :toDate AND category_id = :category_id
    GROUP BY 
        tbl_account_title.account_code
");

$sqlfirst->bindParam("fiscal_id", $fiscal_id, PDO::PARAM_INT);
$sqlfirst->bindParam("fromDate", $datefrom);
$sqlfirst->bindParam("toDate", $dateto);
$sqlfirst->bindParam("category_id", $category_id);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll();
} else {
    $sqlfirst = $conn->prepare("
    SELECT 
        tbl_account_title.account_code AS account_code, 
        tbl_account_title.account_name AS account_name,
        tbl_journal_items.journal_adjustment AS journal_adjustment,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'debit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_debit,
        SUM(CASE 
            WHEN tbl_journal_items.journal_adjustment = 'credit' THEN tbl_journal_items.journal_amount 
            ELSE 0 
        END) AS total_credit
    FROM 
        tbl_journal_items 
    INNER JOIN 
        tbl_journal_entry ON tbl_journal_items.journal_voucher_id = tbl_journal_entry.journal_voucher_id 
    INNER JOIN 
        tbl_journal_category ON tbl_journal_entry.category_id = tbl_journal_category.category_id 
    INNER JOIN 
        tbl_account_title ON tbl_account_title.account_code = tbl_journal_items.account_code 
    WHERE 
        tbl_journal_entry.fiscal_id = :fiscal_id 
    GROUP BY 
        tbl_account_title.account_code
");
$sqlfirst->bindParam("fiscal_id", $fiscal_id, PDO::PARAM_INT);
$sqlfirst->execute();
$resultfirst = $sqlfirst->fetchAll();
}


$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(30, 10, 'Account Code', 'LTRB', 0, 'L', false);
$pdf->Cell(10, 10, '', 'LTRB', 0, 'L', false);
$pdf->Cell(80, 10, 'Account Name', 'LTRB', 0, 'L', false);

$pdf->Cell(30, 10, 'Debit', 'LTRB', 0, 'L', false);
$pdf->Cell(30, 10, 'Credit', 'LTRB', 1, 'L', false);

$pdf->SetFont('Times', '', 12);
$total_debit = 0;
$total_credit = 0;
foreach ($resultfirst as $rowfirst) {
    $descriptionHeight = $pdf->getStringHeight(80, $rowfirst['account_name']);

    $pdf->Cell(30, $descriptionHeight, $rowfirst['account_code'], 'LTRB', 0, 'L', false);
    $pdf->Cell(10, $descriptionHeight, '', 'LTRB', 0, 'L', false);

    // Store current X position before printing the MultiCell
    $xBeforeDescription = $pdf->GetX();
    $yBeforeDescription = $pdf->GetY();

    $x = $pdf->GetX(); // Get current X position
    $y = $pdf->GetY(); // Get current Y position
    // MultiCell for account_name with a width of 25
    $pdf->MultiCell(80, $descriptionHeight, $rowfirst['account_name'], 'LTRB', 'L');
    // Calculate the height of the MultiCell
    $cellHeight = $pdf->GetY() - $y;

    // After printing the MultiCell, reset X and adjust for the remaining cells
    $pdf->SetXY($xBeforeDescription + 80, $yBeforeDescription);

    if ($rowfirst['journal_adjustment'] === "Debit") {
        $pdf->Cell(30, $cellHeight, number_format($rowfirst['total_debit'], 2), 'LTRB', 0, 'R', false);
        $pdf->Cell(30, $cellHeight, '', 'LTRB', 1, 'L', false);
        $total_debit += $rowfirst['total_debit'];
    } else {
        $pdf->Cell(30, $cellHeight, '', 'LTRB', 0, 'L', false);
        $pdf->Cell(30, $cellHeight, number_format($rowfirst['total_credit'], 2), 'LTRB', 1, 'R', false);
        $total_credit += $rowfirst['total_credit'];
    }

}
$pdf->Cell(30, 8, '', '', 1, 'L', false);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(30, 6, 'Total', 'LTRB', 0, 'L', false);
$pdf->Cell(10, 6, '', 'LTRB', 0, 'L', false);
$pdf->Cell(80, 6, '', 'LTRB', 0, 'L', false);

$pdf->Cell(30, 6, number_format($total_debit,2), 'LTRB', 0, 'L', false);
// $pdf->Cell(5, 6, '', 'LTRB', 0, 'L', false);
$pdf->Cell(30, 6, number_format($total_credit,2), 'LTRB', 1, 'L', false);

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
$pdf->Output();

?>