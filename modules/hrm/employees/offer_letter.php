<?php
require '../../../vendor/autoload.php';
use Dompdf\Dompdf;
include '../../../config/db.php';

$id = $_GET['id'];
$get = $conn->query("SELECT * FROM employees WHERE id='$id'");
$data = $get->fetch_assoc();

$html = '
<h2 style="text-align:center;">KDA Microfinance</h2>
<h3 style="text-align:center;">Offer Letter</h3>
<p>Employee Name: '.$data['emp_name'].'</p>
<p>Mobile: '.$data['mobile'].'</p>
<p>Email: '.$data['email'].'</p>
<p>Address: '.$data['address'].'</p>
<hr>
<h4>CTC Breakup</h4>
<p>Basic Salary: ₹'.$data['basic_salary'].'</p>
<p>HRA: ₹'.$data['hra'].'</p>
<p>Conveyance: ₹'.$data['conveyance'].'</p>
<p>Incentive: ₹'.$data['incentive'].'</p>
<p>Bonus: ₹'.$data['bonus'].'</p>
<p>Other Allowances: ₹'.$data['other_allowances'].'</p>
<p><strong>Total Payment: ₹'.$data['total_payment'].'</strong></p>
<hr>
<p>ESI: ₹'.$data['esi'].'</p>
<p>PF: ₹'.$data['pf'].'</p>
<p>Company Dev Fee: ₹'.$data['dev_fee'].'</p>
<p>TDS: ₹'.$data['tds'].'</p>
<p>P.Tax: ₹'.$data['ptax'].'</p>
<p>Others Deduction: ₹'.$data['others_deduction'].'</p>
<p><strong>Total Deduction: ₹'.$data['total_deduction'].'</strong></p>
<hr>
<h3>Net Salary: ₹'.$data['net_salary'].'</h3>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Offer_Letter_".$data['emp_name'].".pdf");
?>
