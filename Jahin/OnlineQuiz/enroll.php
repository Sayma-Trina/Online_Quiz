<?php
include_once 'Models/Database.php';
include_once 'Controllers/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('inc/header.php');
?>
<title>Online Exam System with PHP & MySQL</title>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>		
<link rel="stylesheet" href="css/jquery.dataTables.min.css" />
<script src="js/enroll.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div >  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<h4>User List</h4>
	<br>	
	<div> 	
		
		<table id="examEnrollListing" data-exam-id="<?php echo $_GET['exam_id']; ?>" >
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Name</th>					
					<th>Email</th>
					<th>Gender</th>						
					<th>Mobile</th>	
					<th>Result</th>										
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="userDetails" >
		<div >    		
			<div class="">
				<div class="">
					<button type="button" class="" data-dismiss="modal">&times;</button>
					<h4 class=""><i class="fa fa-plus"></i> User Details</h4>
				</div>
				<div class="modal-body">
					<table id="" class="data-table">
						<thead>
							<tr>						
								<th>Id</th>					
								<th>Name</th>					
								<th>Email</th>
								<th>Gender</th>						
								<th>Mobile</th>	
								<th>Address</th>	
								<th>Created</th>														
							</tr>
						</thead>
						<tbody id="userList">							
						</tbody>
					</table>								
				</div>    				
			</div>    		
		</div>
	</div>	
	
	<div id="questionsModal" >
		<div >
			<form method="post" id="questionsForm">
				<div >
					<div >
						<button type="button"  data-dismiss="modal">&times;</button>
						<h4 ><i class="fa fa-plus"></i> Edit questions</h4>
					</div>
					<div >
						
						<div >
							<div >
								<label >Question Title <span class="text-danger">*</span></label>
								<div >
									<input type="text" name="question_title" id="question_title" autocomplete="off" />
								</div>
							</div>
						</div>
						
						<div >
							<div >
								<label >Option 1 <span class="text-danger">*</span></label>
								<div >
									<input type="text" name="option_title_1" id="option_title_1" autocomplete="off"  />
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 2 <span class="text-danger">*</span></label>
								<div >
									<input type="text" name="option_title_2" id="option_title_2" autocomplete="off"  />
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 3 <span class="text-danger">*</span></label>
								<div >
									<input type="text" name="option_title_3" id="option_title_3" autocomplete="off"  />
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 4 <span class="text-danger">*</span></label>
								<div>
									<input type="text" name="option_title_4" id="option_title_4" autocomplete="off" />
								</div>
							</div>
						</div>
						<div >
							<div>
								<label >Answer <span>*</span></label>
								<div class="">
									<select name="answer_option" id="answer_option" class="">
										<option value="">Select</option>
										<option value="1">1 Option</option>
										<option value="2">2 Option</option>
										<option value="3">3 Option</option>
										<option value="4">4 Option</option>
									</select>
								</div>
							</div>
						</div>					
								
					</div>
					<div class="">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="exam_id" id="exam_id" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save" class="" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>
 <?php include('inc/footer.php');?>
