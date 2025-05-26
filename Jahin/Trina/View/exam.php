<?php
// Must be first thing in the file
include_once '../Models/Database.php';
include_once '../Controllers/User.php';

// Set cookie before any output
$cookie_name = "exam_system";
$cookie_value = "user_preferences";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

// Then do other PHP processing
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<script>alert("Exam Type Saved Successfully!");</script>';
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if(!$user->loggedIn()) {
	header("Location: index.php");
}
include('../inc/header.php');
?>
<title>Online Exam System</title>
<link rel="stylesheet" href="../Assets/CSS/exam.css">
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/jquery.dataTables.min.js"></script>		
<link rel="stylesheet" href="css/jquery.dataTables.min.css" />
<script src="../Assets/js/exam.js"></script>	
<script src="../Assets/js/general.js"></script>
<?php include('../inc/container.php');?>
<div id="notification" class="notification-hidden"></div>

<div class="admin-container">
    <?php if(isset($_COOKIE[$cookie_name])): ?>
    <div class="cookie-alert success">
        <i class="fa fa-check-circle"></i>
        <div>
            <strong>Preferences Saved</strong><br>
            Your exam settings are stored for 30 days
        </div>
    </div>
    <?php else: ?>
    <div class="cookie-alert error">
        <i class="fa fa-exclamation-circle"></i>
        <div>
            <strong>Cookie Required</strong><br>
            Please enable cookies for full functionality
        </div>
    </div>
    <?php endif; ?>

    <div class="welcome-header">
        <h2 class="system-title">Online Exam System</h2>
        <div class="admin-info">
            <span class="welcome-msg">Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?></span>
            <?php include('top_menus.php'); ?>
        </div>
    </div>
 
    <!-- <?php include('top_menus.php'); ?> -->
    <br>
	<h4>Exam</h4>	
	<div> 	
		<div >
			<div >
				<div >
					<h3 ></h3>
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
						
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>

<div id="questionsModal" >
		<div >
			<form method="post" id="questionsForm">
				<div >
					<div >
					
						<h4 ><i class="fa fa-plus"></i> Edit questions</h4>
					</div>
					<div>
						
						<div >
							<div >
								<label >Question Title <span class="text-danger">*</span></label>
								<div >
									<input type="text" name="question_title" id="question_title" autocomplete="off"/>
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
									<input type="text" name="option_title_3" id="option_title_3" autocomplete="off" />
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
								<label >Answer <span>*</span></label>
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
						<input type="submit" name="save" id="save" value="Save Question" />
						
					</div>
				</div>
			</form>
		</div>
	</div>

</div> 

<div class="action-buttons" style="margin: 20px 0;">
    <button onclick="window.open('ajax/exam_ajax.php')" 
        style="background-color: #000000; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; margin-right: 10px;"
        onmouseover="this.style.backgroundColor='#333333'" 
        onmouseout="this.style.backgroundColor='#000000'">
        Exam Type set check
    </button>
</div>

<?php include('../inc/footer.php');?>
