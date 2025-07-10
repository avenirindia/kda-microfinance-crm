<?php
include '../../config/db.php';
require_once '../../pdf/tcpdf.php';

// নতুন PDF তৈরি
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// টাইটেল
$pdf->Write(0, 'Market Visit Report', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln(5);

// টেবিল হেডার তৈরি
$html = '<table border="1" cellpadding="5">
    <tr style="background-color:#f0f0f0;">
        <th>ID</th>
        <th>Branch ID</th>
        <th>Visit Date</th>
        <th>Place</th>
        <th>LSP Name</th>
        <th>Ref Code</th>
    </tr>';

// ডেটাবেস থেকে ডেটা আনা
$sql = "SELECT * FROM market_visits ORDER BY visit_date DESC";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $html .= '<tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['branch_id'].'</td>
            <td>'.$row['visit_date'].'</td>
            <td>'.$row['place'].'</td>
            <td>'.$row['lsp_name'].'</td>
            <td>'.$row['reference_code'].'</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="6" align="center">No data found.</td></tr>';
}

$html .= '</table>';

// PDF এ HTML টেবিল বসানো
$pdf->writeHTML($html, true, false, true, false, '');

// ফাইল দেখানো
$pdf->Output('MarketVisitReport.pdf', 'I');
?>
