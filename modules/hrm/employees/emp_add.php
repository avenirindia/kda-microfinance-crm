<div class="card mb-3">
    <div class="card-header bg-success text-white">CTC Breakup</div>
    <div class="card-body">
        <div class="row">
            <!-- Payment Part -->
            <div class="col-md-6">
                <h5>Payment</h5>
                <div class="mb-2"><label>Basic Salary (₹):</label><input type="number" class="form-control" id="basic_salary" value="0"></div>
                <div class="mb-2"><label>HRA (₹):</label><input type="number" class="form-control" id="hra" value="0"></div>
                <div class="mb-2"><label>Conveyance (₹):</label><input type="number" class="form-control" id="conveyance" value="0"></div>
                <div class="mb-2"><label>Incentive (₹):</label><input type="number" class="form-control" id="incentive" value="0"></div>
                <div class="mb-2"><label>Bonus (₹):</label><input type="number" class="form-control" id="bonus" value="0"></div>
                <div class="mb-2"><label>Other Allowances (₹):</label><input type="number" class="form-control" id="other_allowances" value="0"></div>
                <div class="mb-2"><strong>Total Payment (₹):</strong><input type="number" class="form-control bg-light" id="total_payment" readonly></div>
            </div>

            <!-- Deduction Part -->
            <div class="col-md-6">
                <h5>Deductions</h5>
                <div class="mb-2"><label>ESI (₹):</label><input type="number" class="form-control" id="esi" value="0"></div>
                <div class="mb-2"><label>PF (₹):</label><input type="number" class="form-control" id="pf" value="0"></div>
                <div class="mb-2"><label>Company Dev Fee (₹):</label><input type="number" class="form-control" id="dev_fee" value="0"></div>
                <div class="mb-2"><label>TDS (₹):</label><input type="number" class="form-control" id="tds" value="0"></div>
                <div class="mb-2"><label>P.Tax (₹):</label><input type="number" class="form-control" id="ptax" value="0"></div>
                <div class="mb-2"><label>Others (EMI/Loan/Medical etc) (₹):</label><input type="number" class="form-control" id="others_deduction" value="0"></div>
                <div class="mb-2"><strong>Total Deduction (₹):</strong><input type="number" class="form-control bg-light" id="total_deduction" readonly></div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <strong class="fs-5">Net Salary (₹):</strong>
                <input type="number" class="form-control fs-5 bg-warning" id="net_salary" readonly>
            </div>
        </div>
    </div>
</div>
<script>
function calculateCTC() {
    let basic = parseFloat(document.getElementById('basic_salary').value) || 0;
    let hra = parseFloat(document.getElementById('hra').value) || 0;
    let conv = parseFloat(document.getElementById('conveyance').value) || 0;
    let incentive = parseFloat(document.getElementById('incentive').value) || 0;
    let bonus = parseFloat(document.getElementById('bonus').value) || 0;
    let other_allow = parseFloat(document.getElementById('other_allowances').value) || 0;

    let esi = parseFloat(document.getElementById('esi').value) || 0;
    let pf = parseFloat(document.getElementById('pf').value) || 0;
    let dev_fee = parseFloat(document.getElementById('dev_fee').value) || 0;
    let tds = parseFloat(document.getElementById('tds').value) || 0;
    let ptax = parseFloat(document.getElementById('ptax').value) || 0;
    let others = parseFloat(document.getElementById('others_deduction').value) || 0;

    let total_payment = basic + hra + conv + incentive + bonus + other_allow;
    let total_deduction = esi + pf + dev_fee + tds + ptax + others;
    let net_salary = total_payment - total_deduction;

    document.getElementById('total_payment').value = total_payment.toFixed(2);
    document.getElementById('total_deduction').value = total_deduction.toFixed(2);
    document.getElementById('net_salary').value = net_salary.toFixed(2);
}

document.querySelectorAll('input[type=number]').forEach(input => {
    input.addEventListener('input', calculateCTC);
});
</script>
