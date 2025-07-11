<div class="card mb-4">
  <div class="card-header bg-success text-white">CTC Breakup</div>
  <div class="card-body">
    <div class="row">
      <!-- Payment Part -->
      <div class="col-md-6">
        <h5>Payment</h5>
        <div class="mb-2"><label>Basic Salary (₹):</label><input type="number" name="basic_salary" id="basic_salary" class="form-control" value="<?= $data['basic_salary'] ?? 0 ?>"></div>
        <div class="mb-2"><label>HRA (₹):</label><input type="number" name="hra" id="hra" class="form-control" value="<?= $data['hra'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Conveyance (₹):</label><input type="number" name="conveyance" id="conveyance" class="form-control" value="<?= $data['conveyance'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Incentive (₹):</label><input type="number" name="incentive" id="incentive" class="form-control" value="<?= $data['incentive'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Bonus (₹):</label><input type="number" name="bonus" id="bonus" class="form-control" value="<?= $data['bonus'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Other Allowances (₹):</label><input type="number" name="other_allowances" id="other_allowances" class="form-control" value="<?= $data['other_allowances'] ?? 0 ?>"></div>
        <div class="mb-2"><strong>Total Payment (₹):</strong><input type="number" class="form-control bg-light" id="total_payment" readonly></div>
      </div>

      <!-- Deduction Part -->
      <div class="col-md-6">
        <h5>Deductions</h5>
        <div class="mb-2"><label>ESI (₹):</label><input type="number" name="esi" id="esi" class="form-control" value="<?= $data['esi'] ?? 0 ?>"></div>
        <div class="mb-2"><label>PF (₹):</label><input type="number" name="pf" id="pf" class="form-control" value="<?= $data['pf'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Company Dev Fee (₹):</label><input type="number" name="dev_fee" id="dev_fee" class="form-control" value="<?= $data['dev_fee'] ?? 0 ?>"></div>
        <div class="mb-2"><label>TDS (₹):</label><input type="number" name="tds" id="tds" class="form-control" value="<?= $data['tds'] ?? 0 ?>"></div>
        <div class="mb-2"><label>P.Tax (₹):</label><input type="number" name="ptax" id="ptax" class="form-control" value="<?= $data['ptax'] ?? 0 ?>"></div>
        <div class="mb-2"><label>Others (₹):</label><input type="number" name="others_deduction" id="others_deduction" class="form-control" value="<?= $data['others_deduction'] ?? 0 ?>"></div>
        <div class="mb-2"><strong>Total Deduction (₹):</strong><input type="number" class="form-control bg-light" id="total_deduction" readonly></div>
      </div>
    </div>

    <!-- Net Salary -->
    <hr>
    <div class="row">
      <div class="col-md-4 offset-md-4">
        <strong class="fs-5">Net Salary (₹):</strong>
        <input type="number" class="form-control fs-5 bg-warning" name="net_salary" id="net_salary" readonly>
      </div>
    </div>
  </div>
</div>
