<?php
include_once '../Models/Database.php';
include_once '../Controllers/User.php';
include_once '../Controllers/Exam.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if(!$user->loggedIn()) {
	header("Location: index.php");
}

$exam = new Exam($db);
if(!empty($_GET['exam_id'])) {
	$exam->exam_id = $_GET['exam_id'];
	$examDetails = $exam->getExamInfo();	
}

$exam->examProcessUpdate();
$examProcessDetails = $exam->getExamProcessDetails();

$remainingMinutes = '';
$examDateTime = $examProcessDetails['start_time'];
$duration = $examDetails['duration'] . ' minute';
$examEndTime = strtotime($examDateTime . '+' . $duration);
$examEndTime = date('Y-m-d H:i:s', $examEndTime);
$remainingMinutes = strtotime($examEndTime) - time();
$currentTime = date("Y-m-d") . ' ' . date("H:i:s", STRTOTIME(date('h:i:sa')));
include('inc/header.php');
?>
<title>Online Exam System with PHP & MySQL</title>
<script src="../Assets/js/jquery.dataTables.min.js"></script>
<script src="../Assets/js/dataTables.bootstrap.min.js"></script>		
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="css/TimeCircles.css" />
<script src="../Assets/js/TimeCircles.js"></script>
<script src="../Assets/js/user_exam.js"></script>	
<script src="../Assets/js/general.js"></script>
<?php include('../inc/container.php');?>
<div >  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>	
	<br>	
	<div id="processExamId" data-exam_id="<?php echo $examDetails['id']; ?>"> 	
<?php 
if($currentTime < $examEndTime) {
?>	
	<div >
		<div>			
			<div >
				<div id="single_question_area"></div>
			</div>
		</div>
		<br />
		<div id="question_navigation_area"></div>
	</div>
	<div >
		<br />
		<div >
			<div id="examTimer" data-timer="<?php echo $remainingMinutes; ?>" ></div>
		</div>
		<br />
		<div id="user_details_area"></div>		
	</div>
<?php } ?>	

<?php
if($currentTime >= $examEndTime) {	
	$examResult =  $exam->getExamResults();		
?>
	<div >
		<div >
			<div >
				<div >Online Exam Result</div>				
			</div>
		</div>
		<div >
			<div >
				<table >
					<tr>
						<th>Question</th>
						<th>Option 1</th>
						<th>Option 2</th>
						<th>Option 3</th>
						<th>Option 4</th>
						<th>Your Answer</th>
						<th>Answer</th>
						<th>Result</th>
						<th>Marks</th>
					</tr>
					<?php					
					foreach($examResult as $results) {						
						$examResults  = $exam->getQuestopnOptions($results["question_id"]);						
						$userAnswer = '';
						$orignalAnswer = '';
						$questionResult = '';
						if($results['marks'] == '0'){
							$questionResult = '<h4 >Not Attend</h4>';
						}
						if($results['marks'] > '0')	{
							$questionResult = '<h4 >Right</h4>';
						}
						if($results['marks'] < '0')	{
							$questionResult = '<h4 >Wrong</h4>';
						}
						echo '
						<tr>
							<td>'.$results['question'].'</td>';

						foreach($examResults as $questionOption){
							echo '<td>'.$questionOption["title"].'</td>';
							if($questionOption["option"] == $results['user_answer_option']) {
								$userAnswer = $questionOption['title'];
							}
							if($questionOption['option'] == $results['answer']){
								$orignalAnswer = $questionOption['title'];
							}
						}
						echo '
						<td>'.$userAnswer.'</td>
						<td>'.$orignalAnswer.'</td>
						<td>'.$questionResult.'</td>
						<td>'.$results["marks"].'</td>
					</tr>';
					}
					$marksResult = $exam->getExamTotalMarks();
					foreach($marksResult as $marks){
					?>
					<tr>
						<td colspan="8" align="right">Total Marks</td>
						<td align="right"><?php echo $marks["mark"]; ?></td>
					</tr>
					<?php	
					}
					?>
				</table>
			</div>
		</div>
	</div>
<?php
}
?>		
</div>
 <?php include('../inc/footer.php');?>
