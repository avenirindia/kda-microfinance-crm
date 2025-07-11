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

<head>
    <title>Add New Branch</title>
</head>
<body>

<h2>Add New Branch</h2>

<form method="post" enctype="multipart/form-data">
    <h3>Branch Info</h3>
    Branch Name: <input type="text" name="branch_name" required><br>
    Address: <textarea name="address" required></textarea><br>
    District: <input type="text" name="district" required><br>
    State: <input type="text" name="state" required><br>
    Pin Code: <input type="text" name="pin" required><br>

    <h3>Land Owner Details</h3>
    Name: <input type="text" name="land_owner_name" required><br>
    Address: <textarea name="land_owner_address" required></textarea><br>
    Mobile No: <input type="text" name="land_owner_mobile" required><br>
    KYC Document: <input type="file" name="kyc_doc" required><br>

    <h3>Bank Details</h3>
    Bank Name: <input type="text" name="bank_name" required><br>
    Account No: <input type="text" name="account_no" required><br>
    IFSC Code: <input type="text" name="ifsc" required><br>
    Bank Branch: <input type="text" name="bank_branch" required><br>

    <h3>Land Details</h3>
    Rent Amount: <input type="text" name="rent_amount" required><br>
    Advanced Amount: <input type="text" name="advance_amount" required><br>
    Rent Date: <input type="date" name="rent_date" required><br>
    Rent Agreement Upload: <input type="file" name="rent_agreement" required><br>

    <h3>Electricity</h3>
    Unit Price: <input type="text" name="unit_price" required><br>
    Starting Unit: <input type="text" name="start_unit" required><br><br>

    <button type="submit" name="add">Add Branch</button>
</form>

</body>
</html>
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation not supported by your browser.");
    }
}

function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;

    // Address Fetch via Google Geocoding API
    var latlng = position.coords.latitude + "," + position.coords.longitude;
    var geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + latlng + "&key=YOUR_API_KEY";

    fetch(geocode_url)
        .then(response => response.json())
        .then(data => {
            if (data.status === "OK") {
                document.getElementById("approx_address").value = data.results[0].formatted_address;
            } else {
                document.getElementById("approx_address").value = "Not Found";
            }
        });
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Location permission denied.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location info unavailable.");
            break;
        case error.TIMEOUT:
            alert("Request timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Unknown error.");
            break;
    }
}
</script>

<!-- Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIV5ATUvb1UVaDw32lhTZqbn2v51qEMkU"></script>
