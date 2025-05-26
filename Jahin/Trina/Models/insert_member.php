<?php
include '../Models/Database.php';
$conn = (new Database())->getConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $created = date('Y-m-d H:i:s');
    $sql = "INSERT INTO user (first_name, last_name, gender, email, password, mobile, address, role, created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssssss', $first_name, $last_name, $gender, $email, $password, $mobile, $address, $role, $created);
    if ($stmt->execute()) {
        header('Location: ../View/user.php');
        exit();
    } else {
        echo 'Insert failed.';
    }
}
?>