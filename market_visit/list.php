<?php
include '../../config/db.php';

// ডাটাবেস থেকে ডেটা নিয়ে আসা
$sql = "SELECT * FROM market_visits ORDER BY visit_date DESC";
$result = $conn->query($sql);
?>

<h2>Market Visit List</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr style="background-color: #ddd;">
        <th>ID</th>
        <th>Branch ID</th>
        <th>Visit Date</th>
        <th>Place</th>
        <th>LSP Name</th>
        <th>Reference Code</th>
    </tr>

<?php
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['branch_id']."</td>";
        echo "<td>".$row['visit_date']."</td>";
        echo "<td>".$row['place']."</td>";
        echo "<td>".$row['lsp_name']."</td>";
        echo "<td>".$row['reference_code']."</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' style='text-align:center;'>No data found.</td></tr>";
}
?>

</table>

<br>
<a href="add.php">➕ Add New Visit</a>
