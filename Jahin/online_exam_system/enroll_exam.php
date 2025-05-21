<?php
include_once 'Models/Database.php';
include_once 'Controllers/User.php';
include_once 'Controllers/Exam.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$exam = new Exam($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>Online Exam System</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/user_exam.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div>  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<h4>Enroll To Exam</h4>
	<br>	
	<div> 		
	
	<div class="">
			<div class=""></div>
			<div class="">
				<select name="exam_list" id="exam_list" class="">
					<option value="">Select Exam</option>
					<?php echo $exam->getExamList(); ?>
				</select>
				<br />
				<span id="exam_details"></span>
			</div>
			<div class=""></div>
		</div>
		
	</div>
	
	
			
</div>
 <?php include('inc/footer.php');?>
