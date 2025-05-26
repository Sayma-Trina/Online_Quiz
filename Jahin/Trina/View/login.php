<?php 
include_once '../Models/Database.php';
include_once '../Controllers/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($user->loggedIn()) {	
	if(!empty($_SESSION["role"]) && $_SESSION["role"] == 'admin') {
		header("Location: exam.php");	
	} else if (!empty($_SESSION["role"]) && $_SESSION["role"] == 'user'){
		header("Location: view_exam.php");	
	}
}

$loginMessage = '';
if(!empty($_POST["login"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["loginType"]) && $_POST["loginType"]) {	
	$user->email = $_POST["email"];
	$user->password = $_POST["password"];	
	$user->loginType = $_POST["loginType"];
	
	// Temporary debug output
	error_log("Attempting ".$_POST["loginType"]." login with: ".$_POST["email"]);
	
	if($user->login()) {
		if($_SESSION["role"] == 'admin') {
			header("Location: exam.php");	
		} else if ($_SESSION["role"] == 'user'){
			header("Location: view_exam.php");	
		}		
	} else {
		$loginMessage = 'Invalid login! Please try again.';
	}
} else if (empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"])|| empty($_POST["loginType"])){
	$loginMessage = 'Enter email, pasword and select user type to login.';
}
?>  <!-- Add this closing tag -->
<?php include('../inc/header.php');?>
<title>Online Exam System with PHP & MySQL</title>
<link rel="stylesheet" href="../Assets/CSS/login.css">
<?php include('../inc/container.php');?>
<div > 
	<div >
		<h2>Online Exam System</h2>			
        <div class="login-panel">                    
		<div >
			<div>Log In</div>                        
		</div> 
		<div  >
			<?php if ($loginMessage != '') { ?>
				<div id="login-alert"><?php echo $loginMessage; ?></div>                            
			<?php } ?>
			<form id="loginform"  role="form" method="POST" action="">                                    
				<div >
					<span><i class="glyphicon glyphicon-user"></i></span>
					<input type="text"  id="email" name="email" value="<?php if(!empty($_POST["email"])) { echo $_POST["email"]; } ?>" placeholder="email" style="background:white;" required>                                        
				</div>                                
				<div >
					<span ><i class="glyphicon glyphicon-lock"></i></span>
					<input type="password"  id="password" name="password" value="<?php if(!empty($_POST["password"])) { echo $_POST["password"]; } ?>" placeholder="password" required>
				</div>	
				<label ><strong>User Type:</strong></label>
				<label >
				  <input type="radio" name="loginType" value="admin">Administrator
				</label>
				
				<label >
				  <input type="radio" name="loginType" value="user">User
				</label>
				
				<div >                               
					<div >
					  <input type="submit" name="login" value="Login" >                          
					</div>                        
				</div>                        
				<a href='register.php'>Register</a>
			</form>  
			
		</div>                     
	</div>  
	</div>       
    </div>        
		
<?php include('../inc/footer.php');?>
