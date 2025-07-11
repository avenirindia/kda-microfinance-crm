<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../../../config/db.php';
?>
<?php include '../../../config/db.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Add New Employee</h2>

    <form action="emp_add_save.php" method="post" enctype="multipart/form-data">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Employee Info</div>
            <div class="card-body">
                <div class="mb-2">
                    <label>Employee Name:</label>
                    <input type="text" name="emp_name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Mobile No:</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Address:</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">KYC Documents Upload</div>
            <div class="card-body">
                <div class="mb-2">
                    <label>Aadhaar Upload:</label>
                    <input type="file" name="aadhaar_file" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>PAN Upload:</label>
                    <input type="file" name="pan_file" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Bank Passbook Upload:</label>
                    <input type="file" name="bank_file" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Qualification Certificate:</label>
                    <input type="file" name="qualification_file" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Passport Size Photo:</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-info text-white">CTC Breakup</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>ESI (%)</label>
                        <input type="text" name="esi" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>PF (%)</label>
                        <input type="text" name="pf" class="form-control">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Company Dev Fee (%)</label>
                        <input type="text" name="dev_fee" class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-warning">Transfer Info (if any)</div>
            <div class="card-body">
                <div class="mb-2">
                    <label>From Branch:</label>
                    <input type="text" name="from_branch" class="form-control">
                </div>
                <div class="mb-2">
                    <label>To Branch:</label>
                    <input type="text" name="to_branch" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Transfer Reason:</label>
                    <input type="text" name="transfer_reason" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Transfer Date:</label>
                    <input type="date" name="transfer_date" class="form-control">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">➕ Add Employee</button>
        <a href="emp_list.php" class="btn btn-secondary">📋 Employee List</a>
    </form>
</div>
