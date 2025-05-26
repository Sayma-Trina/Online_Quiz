
	

// Keep the addUser click handler
	$('#addUser').click(function(){
		$('#userModal').modal('show');
		$('#userForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('addUser');
		$('#save').val('Save');
	});
	
	
	$(document).on('submit','#userForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"users_action.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#userForm')[0].reset();
				$('#userModal').modal('hide');				
				$('#save').attr('disabled', false);
				userRecords.ajax.reload();
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var userId = $(this).attr("id");		
		var action = "deleteUser";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"users_action.php",
				method:"POST",
				data:{userId:userId, action:action},
				success:function(data) {					
					userRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});

	// In your DataTables initialization, add this column configuration
	columns: [
	    // ... other column definitions ...
	    {
	        data: null,
	        render: function(data, type, row) {
	            return '<a href="../Controllers/deleteuser.php?id=' + row.Id + 
	                   '" class="btn btn-danger" onclick="return confirm(\'Delete this user?\')">Delete</a>';
	        }
	    }
	]
