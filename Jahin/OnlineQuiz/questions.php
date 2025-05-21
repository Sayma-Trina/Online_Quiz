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
<script src="js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<script src="js/questions.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div >  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<div> 	
		<div >
			<div>
				<div >
					<h3 ></h3>
				</div>
				<div>
					<button type="button" id="addQuestions" class="btn btn-info" title="Add Questions"><span ></span></button>
				</div>
			</div>
		</div>
		<table id="questionsListing" data-exam-id="<?php echo $_GET['exam_id']; ?>" >
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Question</th>					
					<th>Right Option</th>					
					<th></th>
					<th></th>					
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="questionsModal" >
		<div >
			<form method="post" id="questionsForm">
				<div >
					<div>
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
									<input type="text" name="option_title_1" id="option_title_1" autocomplete="off" />
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 2 <span>*</span></label>
								<div class="col-md-8">
									<input type="text" name="option_title_2" id="option_title_2" autocomplete="off"/>
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 3 <span >*</span></label>
								<div >
									<input type="text" name="option_title_3" id="option_title_3" autocomplete="off"/>
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Option 4 <span >*</span></label>
								<div >
									<input type="text" name="option_title_4" id="option_title_4" autocomplete="off"  />
								</div>
							</div>
						</div>
						<div >
							<div >
								<label >Answer <span >*</span></label>
								<div >
									<select name="answer_option" id="answer_option" >
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
					<div class="modal-footer">
						<input type="hidden" name="id" id="id" />
						<input type="hidden" name="exam_id" id="exam_id" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save"  value="Save" />
						<button type="button"  data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>
 <?php include('inc/footer.php');?>
