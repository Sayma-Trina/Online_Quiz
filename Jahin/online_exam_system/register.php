<?php
include_once 'Models/Database.php';
include_once 'Controllers/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $created = date('Y-m-d H:i:s');

    $query = "INSERT INTO online_exam_user (first_name, last_name, gender, email, password, mobile, address, created, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssssssss', $firstName, $lastName, $gender, $email, $password, $mobile, $address, $created, $role);

    if($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>
    <div class="auth-container"> 
        <h2>Register</h2>
        <form method="post" action="" class="auth-form">
            <div class="auth-container">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
    
            <div class="auth-container">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name"  required>
            </div>
    
            <div class="auth-container">
                <label for="gender">Gender</label>
                <select id="gender" name="gender"  required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
    
            <div class="auth-container">
                <label for="email">Email</label>
                <input type="email" id="email" name="email"  required>
            </div>
    
            <div class="auth-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"  required>
            </div>
    
            <div class="auth-container">
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile"  required>
            </div>
    
            <div class="auth-container">
                <label for="address">Address</label>
                <input type="text" id="address" name="address"  required>
            </div>
    
            <div class="auth-container">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            </div>
    
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d H:i:s'); ?>">
    
            <div class="auth-container">
                <button type="submit" >Register</button>
            </div>
            <a href='index.html' class="auth-button">Go Back</a>
        </form>
</body>
</html>