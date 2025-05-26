<?php
include '../Models/Database.php';
$conn = (new Database())->getConnection(); // Establish the database connection
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header('Location: ../View/user.php');
        exit();
    } else {
        echo 'Delete failed.';
    }
}
?>