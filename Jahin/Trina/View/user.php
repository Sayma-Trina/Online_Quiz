<?php
require_once '../Models/Database.php';
$conn = (new Database())->getConnection();
$sql = "SELECT id, first_name, last_name, gender, email, password, mobile, address, role, created FROM user";
$result = $conn->query($sql);
echo '<link rel="stylesheet" href="../Assets/CSS/user.css">';
echo '<h2 class="user-headline">USER INFORMATION</h2>';
echo '<div class="user-table-container">';
echo '<table class="user-table">';
echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Email</th><th>Password</th><th>Mobile</th><th>Address</th><th>Role</th><th>Created</th></tr></thead>';
echo '<tbody>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['first_name'] . '</td>';
        echo '<td>' . $row['last_name'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['password'] . '</td>';
        echo '<td>' . $row['mobile'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td>' . $row['created'] . '</td>';
        echo '</tr>';
    }
}
echo '</tbody>';
echo '</table></div>';
echo '<div class="action-bar"><button class="action-btn" onclick="document.getElementById(\'insertModal\').style.display=\'block\'">Insert Member</button><button class="action-btn" onclick="document.getElementById(\'deleteModal\').style.display=\'block\'">Delete Member</button><button class="action-btn" onclick="window.print()">Print Page</button><button class="action-btn" onclick="window.location.href=\'exam.php\'">Back</button></div>';
?>
<div id="insertModal" class="modal">
  <form class="modal-content" action="../Models/insert_member.php" method="post">
    <span onclick="document.getElementById('insertModal').style.display='none'" class="close">&times;</span>
    <h2>Insert Member</h2>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="gender" placeholder="Gender" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="mobile" placeholder="Mobile" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="role" placeholder="Role" required>
    <button type="submit">Insert</button>
  </form>
</div>
<div id="deleteModal" class="modal">
  <form class="modal-content" action="../Models/delete_member.php" method="post">
    <span onclick="document.getElementById('deleteModal').style.display='none'" class="close">&times;</span>
    <h2>Delete Member</h2>
    <input type="number" name="id" placeholder="User ID" required>
    <button type="submit">Delete</button>
  </form>
</div>
<script>
window.onclick = function(event) {
  if (event.target.className === 'modal') {
    event.target.style.display = 'none';
  }
}
</script>
<?php include('../inc/footer.php'); ?>
<link rel="stylesheet" href="../Assets/CSS/user.css">
<div class="user-table-container">
<table>
</table></div>


