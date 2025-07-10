if(isset($_POST['add'])){
  $branch = $_POST['branch_name'];
  $address = $_POST['address'];
  $conn->query("INSERT INTO branches(branch_name, address) VALUES('$branch', '$address')");
  header("Location: list.php");
}
