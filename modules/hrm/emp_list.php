<?php
include '../../config/db.php';
$conn = Database::connect();

$result = $conn->query("SELECT * FROM employees ORDER BY id DESC");
?>

<h2>Employee List</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>CTC</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $row['emp_code']; ?></td>
        <td><?php echo $row['emp_name']; ?></td>
        <td><?php echo $row['mobile']; ?></td>
        <td><?php echo $row['total_ctc']; ?></td>
        <td>
            <a href="emp_view.php?id=<?php echo $row['id']; ?>">View</a> | 
            <a href="emp_edit.php?id=<?php echo $row['id']; ?>">Edit</a>
        </td>
    </tr>
    <?php } ?>
</table>
