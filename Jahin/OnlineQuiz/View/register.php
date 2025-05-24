<?php
include_once '../Models/Database.php';
include_once '../Controllers/User.php';

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
        echo "Registration successful.";
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
</head>
<body>
    <div > 
        <h2>Register</h2>
        <form method="post" action="" >
            <div >
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
    
            <div >
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name"  required>
            </div>
    
            <div >
                <label for="gender">Gender</label>
                <select id="gender" name="gender"  required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
    
            <div >
                <label for="email">Email</label>
                <input type="email" id="email" name="email"  required>
            </div>
    
            <div >
                <label for="password">Password</label>
                <input type="password" id="password" name="password"  required>
            </div>
    
            <div >
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile"  required>
            </div>
    
            <div >
                <label for="address">Address</label>
                <input type="text" id="address" name="address"  required>
            </div>
    
            <div >
                <label for="role">Role</label>
                <input type="text" id="role" name="role"  required>
            </div>
    
            <input type="hidden" id="created" name="created" value="<?php echo date('Y-m-d H:i:s'); ?>">
    
            <div >
                <button type="submit" >Register</button>
            </div>
        </form>
</body>
</html>