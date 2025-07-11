<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include '../../config/db.php';

if(isset($_POST['add'])){
    $branch_name     = $conn->real_escape_string($_POST['branch_name']);
    $address         = $conn->real_escape_string($_POST['address']);
    $district        = $conn->real_escape_string($_POST['district']);
    $state           = $conn->real_escape_string($_POST['state']);
    $pin             = $conn->real_escape_string($_POST['pin']);
    $land_owner_name = $conn->real_escape_string($_POST['land_owner_name']);
    $land_owner_address = $conn->real_escape_string($_POST['land_owner_address']);
    $land_owner_mobile  = $conn->real_escape_string($_POST['land_owner_mobile']);
    $bank_name       = $conn->real_escape_string($_POST['bank_name']);
    $account_no      = $conn->real_escape_string($_POST['account_no']);
    $ifsc            = $conn->real_escape_string($_POST['ifsc']);
    $bank_branch     = $conn->real_escape_string($_POST['bank_branch']);
    $rent_amount     = $conn->real_escape_string($_POST['rent_amount']);
    $advance_amount  = $conn->real_escape_string($_POST['advance_amount']);
    $rent_date       = $conn->real_escape_string($_POST['rent_date']);
    $unit_price      = $conn->real_escape_string($_POST['unit_price']);
    $start_unit      = $conn->real_escape_string($_POST['start_unit']);

    // ফাইল আপলোড প্রোসেস
    $kyc_doc = $_FILES['kyc_doc']['name'];
    $rent_agreement = $_FILES['rent_agreement']['name'];

    move_uploaded_file($_FILES['kyc_doc']['tmp_name'], "../../uploads/$kyc_doc");
    move_uploaded_file($_FILES['rent_agreement']['tmp_name'], "../../uploads/$rent_agreement");

    $insert = "INSERT INTO branches 
    (branch_name, address, district, state, pin, land_owner_name, land_owner_address, land_owner_mobile,
    bank_name, account_no, ifsc, bank_branch, rent_amount, advance_amount, rent_date, unit_price, start_unit,
    kyc_doc, rent_agreement)
    VALUES
    ('$branch_name', '$address', '$district', '$state', '$pin', '$land_owner_name', '$land_owner_address', '$land_owner_mobile',
    '$bank_name', '$account_no', '$ifsc', '$bank_branch', '$rent_amount', '$advance_amount', '$rent_date', '$unit_price', '$start_unit',
    '$kyc_doc', '$rent_agreement')";

    if($conn->query($insert)){
        echo "<h3>✅ Branch Added Successfully</h3>";
    } else {
        echo "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html><h3>Location</h3>
<button type="button" onclick="getLocation()">📍 Detect Location</button><br><br>
Latitude: <input type="text" name="latitude" id="latitude" readonly><br>
Longitude: <input type="text" name="longitude" id="longitude" readonly><br>
Approx Address: <input type="text" name="approx_address" id="approx_address" readonly><br>
<div class="container mt-4">
    <h2 class="mb-4">Add New Branch</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">Branch Info</div>
            <div class="card-body">
                <div class="mb-2">
                    <label>Branch Name:</label>
                    <input type="text" class="form-control" name="branch_name" required>
                </div>
                <div class="mb-2">
                    <label>Address:</label>
                    <textarea class="form-control" name="address" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>District:</label>
                        <input type="text" class="form-control" name="district" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>State:</label>
                        <input type="text" class="form-control" name="state" required>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Pin Code:</label>
                        <input type="text" class="form-control" name="pin" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">Land Owner Details</div>
            <div class="card-body">
                <div class="mb-2">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="land_owner_name" required>
                </div>
                <div class="mb-2">
                    <label>Address:</label>
                    <textarea class="form-control" name="land_owner_address" required></textarea>
                </div>
                <div class="mb-2">
                    <label>Mobile No:</label>
                    <input type="text" class="form-control" name="land_owner_mobile" required>
                </div>
                <div class="mb-2">
                    <label>KYC Document:</label>
                    <input type="file" class="form-control" name="kyc_doc" required>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-info text-white">Bank Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Bank Name:</label>
                        <input type="text" class="form-control" name="bank_name" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Account No:</label>
                        <input type="text" class="form-control" name="account_no" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>IFSC Code:</label>
                        <input type="text" class="form-control" name="ifsc" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Bank Branch:</label>
                        <input type="text" class="form-control" name="bank_branch" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-warning">Land Details</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Rent Amount:</label>
                        <input type="text" class="form-control" name="rent_amount" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Advanced Amount:</label>
                        <input type="text" class="form-control" name="advance_amount" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Rent Date:</label>
                        <input type="date" class="form-control" name="rent_date" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Rent Agreement Upload:</label>
                        <input type="file" class="form-control" name="rent_agreement" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header bg-success text-white">Electricity</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Unit Price (₹):</label>
                        <input type="text" class="form-control" name="unit_price" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Starting Unit:</label>
                        <input type="text" class="form-control" name="start_unit" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="add" class="btn btn-primary">➕ Add Branch</button>
    </form>
</div>


<div class="card mb-3">
    <div class="card-header bg-danger text-white">Location</div>
    <div class="card-body">

        <button type="button" class="btn btn-outline-primary mb-3" onclick="getLocation()">📍 Detect Location</button>

        <div class="mb-3">
            <label>Latitude:</label>
            <input type="text" class="form-control" name="latitude" id="latitude" readonly>
        </div>

        <div class="mb-3">
            <label>Longitude:</label>
            <input type="text" class="form-control" name="longitude" id="longitude" readonly>
        </div>

        <div class="mb-3">
            <label>Approx Address:</label>
            <input type="text" class="form-control" name="approx_address" id="approx_address" readonly>
        </div>

    </div>
</div>
