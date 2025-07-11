<?php
include '../../config/db.php';

if(isset($_POST['add'])){
    $emp_name = $conn->real_escape_string($_POST['emp_name']);
    $mobile   = $conn->real_escape_string($_POST['mobile']);

    // Check duplicate
    $check = $conn->query("SELECT * FROM employees WHERE emp_name='$emp_name' AND mobile='$mobile'");
    if($check->num_rows > 0){
        echo "<div class='alert alert-danger'>❌ এই নাম ও মোবাইল নম্বর আগেই আছে!</div>";
    } else {
        $conn->query("INSERT INTO employees(emp_name, mobile) VALUES('$emp_name', '$mobile')");
        echo "<div class='alert alert-success'>✅ এমপ্লয়ি এড করা হলো!</div>";
    }
}
?>
<?php
include '../../config/db.php';

// Search query
$where = "";
if(isset($_GET['search'])){
    $term = $conn->real_escape_string($_GET['search']);
    $where = "WHERE emp_name LIKE '%$term%' OR mobile LIKE '%$term%'";
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
    <h2>Employee List</h2>

    <form method="get" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Mobile" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <tr class="table-primary">
            <th>#</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>

        <?php
        $i=1;
        $res = $conn->query("SELECT * FROM employees $where ORDER BY id DESC");
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                echo "<tr>
                    <td>".$i++."</td>
                    <td>{$row['emp_name']}</td>
                    <td>{$row['mobile']}</td>
                    <td>
                        <a href='edit_employee.php?id={$row['id']}' class='btn btn-sm btn-warning'>✏️ Edit</a>
                        <a href='delete_employee.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"ডিলিট করতে চান?\")'>🗑️ Delete</a>
                    </td>
                </tr>";
            }
        }else{
            echo "<tr><td colspan='4'>কোনো এমপ্লয়ি পাওয়া যায়নি!</td></tr>";
        }
        ?>
    </table>
</div>
