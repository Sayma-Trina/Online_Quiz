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
	

<script src="js/user.js"></script>	
<script src="js/general.js"></script>
<?php include('inc/container.php');?>
<div >  
	<h2>Online Exam System</h2>	
	<?php include('top_menus.php'); ?>
	<br>	
	<h4>User List</h4>
	<br>	
	<div> 	
		<div >
			<div >
				<div >
					<h3 ></h3>
				</div>
				<div >
					<button type="button" name="add" id="addUser" >Add New</button>
				</div>
			</div>
		</div>
		<table id="userListing" >
			<thead>
				<tr>						
					<th>Id</th>					
					<th>Name</th>					
					<th>Email</th>
					<th>Gender</th>						
					<th>Mobile</th>	
					<th>Role</th>
					<th></th>
					<th></th>
					<th></th>									
				</tr>
			</thead>
		</table>
	</div>
	
	<div id="userModal" >
		<div >
			<form method="post" >
				<div >
					<div >
						<button type="button" data-dismiss="modal">&times;</button>
						<h4 ><i class="fa fa-plus"></i> Add User</h4>
					</div>
					<div >
						<div >
							<label for="firstName" >First Name*</label>
							<input type="text"  id="firstName" name="firstName" placeholder="First name" required>			
						</div>
						
						<div >
							<label for="lastName" >Last Name*</label>
							<input type="text"  id="lastName" name="lastName" placeholder="last name" required>			
						</div>
						
						<div >
							<label for="username" >Email*</label>
							<input type="email"  id="email" name="email" placeholder="Email" required>			
						</div>
						
						<div >
							<label for="mobile" >Mobile*</label>
							<input type="text"  id="mobile" name="mobile" placeholder="mobile" required>			
						</div>
						
						<div >
							<label for="address" >Address*</label>
							<textarea id="address" name="address" placeholder="address" required></textarea>		
						</div>
						
						<div >
							<label for="status" >Role</label>				
							<select id="role" name="role" >
							<option value="admin">Admin</option>				
							<option value="user">User</option>	
							</select>						
						</div>	
						
						<div >
							<label for="gender" >Gender</label>				
							<select id="gender" name="gender" >
							<option value="Male">Male</option>				
							<option value="Female">Female</option>	
							</select>						
						</div>

						<div >
							<label for="username" >New Password</label>
							<input type="password"  id="newPassword" name="newPassword" placeholder="Password">			
						</div>											
						
					</div>
					<div >
						<input type="hidden" name="userId" id="userId" />
						<input type="hidden" name="action" id="action" value="" />
						<input type="submit" name="save" id="save"  value="Save" />
						<button type="button"  data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
	<div id="userDetails" >
		<div >    		
			<div >
				<div >
					<button type="button"  data-dismiss="modal">&times;</button>
					<h4 ><i class="fa fa-plus"></i> User Details</h4>
				</div>
				<div >
					<table id="" >
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
						<input type="submit" name="save" id="save" value="Save" />
						<button type="button"  data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
			
</div>
 <?php include('inc/footer.php');?>
