<?php
include_once '../Models/Database.php';
include_once '../Controllers/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('../inc/header.php');
?>
<title>Online Exam System</title>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>		
<link rel="stylesheet" href="css/jquery.dataTables.min.css" />
<script src="../Asset/js/exam.js"></script>	
<script src="../Asset/js/general.js"></script>
<?php include('../inc/container.php');?>
<div >  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>	
	<br>
	<h4>Exam</h4>	
	<div> 	
		<div >
			<div >
				<div >
					<h3 ></h3>
				</div>
				<div >
					<button type="button" id="addExam" title="Add Exam"><span ></span></button>
				</div>
			</div>
		</div>
		<table id="examListing" >
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Exam Title</th>					
					<th>Duration (Minute)</th>
					<th>Total Question</th>
					<th>R/Q Mark</th>
					<th>W/Q Mark</th>					
					<th>Status</th>	
					<th>Questions</th>	
					<th>Enroll Users</th>						
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="examModal" >
		<div >
			<form method="post" id="examForm">
				<div >
					<div >
						<button type="button"  data-dismiss="modal">&times;</button>
						<h4 ><i class="fa fa-plus"></i> Edit Exam</h4>
					</div>
					<div >
						<div >
							<label for="project" >Examm Title</label>
							<input type="text"  id="exam_title" name="exam_title" placeholder="Exam title" required>			
						</div>						
						
						<div >
							<label for="project" >Duration</label>
							<select name="exam_duration" id="exam_duration" >
	                				<option value="">Select</option>
									<option value="1">1 Minute</option>
									<option value="2">2 Minute</option>
									<option value="3">3 Minute</option>
									<option value="4">4 Minute</option>
	                				<option value="5">5 Minute</option>
	                				<option value="30">30 Minute</option>
	                				<option value="60">1 Hour</option>
	                				<option value="120">2 Hour</option>
	                				<option value="180">3 Hour</option>
	                			</select>	
						</div>
						
						<div >
							<label for="project" >Total Question</label>
							<select name="total_question" id="total_question" >
								<option value="">Select</option>
								<option value="1">1 Question</option>
								<option value="2">2 Question</option>
								<option value="3">3 Question</option>
								<option value="4">4 Question</option>
								<option value="5">5 Question</option>
								<option value="10">10 Question</option>
								<option value="25">25 Question</option>
								<option value="50">50 Question</option>
								<option value="100">100 Question</option>
								<option value="200">200 Question</option>
								<option value="300">300 Question</option>
							</select>		
						</div>
						
						<div >
							<label for="project" >Marks For Right Answer</label>
							<select name="marks_right_answer" id="marks_right_answer" >
								<option value="">Select</option>
								<option value="1">+1 Mark</option>
								<option value="2">+2 Mark</option>
								<option value="3">+3 Mark</option>
								<option value="4">+4 Mark</option>
								<option value="5">+5 Mark</option>
							</select>			
						</div>
						
						<div >
							<label for="project" >Marks For Wrong Answer</label>
							<select name="marks_wrong_answer" id="marks_wrong_answer" >
								<option value="">Select</option>
								<option value="1">-1 Mark</option>
								<option value="1.25">-1.25 Mark</option>
								<option value="1.50">-1.50 Mark</option>
								<option value="2">-2 Mark</option>
							</select>			
						</div>
						
						<div >
							<label for="status" >Status</label>
							<select name="status" id="status" >
								<option value="">Select</option>
								<option value="Created">Created</option>
								<option value="Pending">Pending</option>
								<option value="Started">Started</option>
								<option value="Completed">Completed</option>
							</select>			
						</div>
								
					</div>
					<div >
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save"  value="Save" />
						<button type="button"  data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>
 <?php include('../inc/footer.php');?>
