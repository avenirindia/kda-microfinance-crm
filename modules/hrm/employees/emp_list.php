<?php
include '../../../config/db.php';

// সার্চ ফিল্টার
$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $result = $conn->query("SELECT * FROM employees WHERE emp_name LIKE '%$search%' OR mobile LIKE '%$search%' ORDER BY id DESC");
} else {
    $result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-4">
  <h2>Employee List</h2>

  <form method="get" class="mb-3 d-flex">
    <input type="text" name="search" class="form-control me-2" placeholder="Search by name or mobile" value="<?= $search ?>">
    <button type="submit" class="btn btn-primary">Search</button>
    <a href="emp_add.php" class="btn btn-success ms-2">➕ Add Employee</a>
  </form>

  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Net Salary</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['emp_name'] ?></td>
            <td><?= $row['mobile'] ?></td>
            <td>₹<?= $row['net_salary'] ?></td>
            <td>
              <a href="emp_view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">View</a>
              <a href="emp_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="emp_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
              <a href="offer_letter.php?id=<?= $row['id'] ?>" target="_blank" class="btn btn-sm btn-secondary">PDF</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="5">No employee found!</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
